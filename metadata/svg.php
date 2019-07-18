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
	$meta = array();

	// Securite si pas autorise : virer les scripts et les references externes
	// sauf si on est en mode javascript 'ok' (1), cf. inc_version
	if ($GLOBALS['filtrer_javascript'] < 1
		and !autoriser('televerser', 'script')
	) {
		include_spip('inc/texte');
		$texte = spip_file_get_contents($file);
		$new = trim(safehtml($texte));
		// petit bug safehtml
		if (substr($new, 0, 2) == ']>') {
			$new = ltrim(substr($new, 2));
		}
		if ($new != $texte) {
			ecrire_fichier($file, $new);
		}
	}

	$metadata = charger_fonction('image', 'metadata');
	return $metadata($file);
}
