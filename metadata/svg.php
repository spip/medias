<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2019                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Informations meta d'un SVG
 *
 * @package SPIP\Medias\Metadata
 **/

use enshrined\svgSanitize\Sanitizer;

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}
include_spip('inc/autoriser');

/**
 * Déterminer les dimensions d'un svg, et enlever ses scripts si nécessaire
 *
 * On utilise safehtml qui n'est pas apropriée pour ça en attendant mieux
 * cf http://www.slideshare.net/x00mario/the-image-that-called-me
 * http://heideri.ch/svgpurifier/SVGPurifier/index.php
 *
 * @param string $file
 * @return array Tableau (largeur, hauteur)
 */
function metadata_svg_dist($file) {

	// Securite si pas autorise : virer les scripts et les references externes
	// sauf si on est en mode javascript 'ok' (1), cf. inc_version
	if ($GLOBALS['filtrer_javascript'] < 1
		// qu'on soit admin ou non, on sanitize les SVGs car rien ne dit qu'un admin sait que ca contient du JS
	  // and !autoriser('televerser', 'script')
	) {
		spip_log("sanitization SVG $file", "medias");

		include_spip('lib/svg-sanitizer/src/Sanitizer');
		include_spip('lib/svg-sanitizer/src/data/AttributeInterface');
		include_spip('lib/svg-sanitizer/src/data/AllowedAttributes');
		include_spip('lib/svg-sanitizer/src/data/TagInterface');
		include_spip('lib/svg-sanitizer/src/data/AllowedTags');

		$sanitizer = new Sanitizer();
		$svg = file_get_contents($file);

		// Pass it to the sanitizer and get it back clean
		$clean_svg = $sanitizer->sanitize($svg);
		ecrire_fichier($file, $clean_svg);
	}

	$metadata = charger_fonction('image', 'metadata');
	return $metadata($file);
}
