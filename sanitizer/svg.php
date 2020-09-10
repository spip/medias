<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2020                                                *
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
 * Nettoyer et normaliser un svg, et enlever ses scripts si nécessaire
 *
 * cf http://www.slideshare.net/x00mario/the-image-that-called-me
 * http://heideri.ch/svgpurifier/SVGPurifier/index.php
 *
 * @param string $file
 * @return array Tableau (largeur, hauteur)
 */
function sanitizer_svg_dist($file) {

	include_spip('inc/svg');
	if ($svg = svg_charger($file)) {

		// forcer une viewBox et width+height en px
		$svg = svg_force_viewBox_px($svg, true);

		// Securite si pas autorise : virer les scripts et les references externes
		// sauf si on est en mode javascript 'ok' (1), cf. inc_version
		if ($GLOBALS['filtrer_javascript'] < 1
			// qu'on soit admin ou non, on sanitize les SVGs car rien ne dit qu'un admin sait que ca contient du JS
		  // and !autoriser('televerser', 'script')
		) {
			spip_log("sanitization SVG $file", "svg");

			include_spip('lib/svg-sanitizer/src/Sanitizer');
			include_spip('lib/svg-sanitizer/src/data/AttributeInterface');
			include_spip('lib/svg-sanitizer/src/data/AllowedAttributes');
			include_spip('lib/svg-sanitizer/src/data/TagInterface');
			include_spip('lib/svg-sanitizer/src/data/AllowedTags');

			// sanitization can need multiples call
			$maxiter = 10;
			do {
				$size = strlen($svg);
				$sanitizer = new Sanitizer();
				$sanitizer->setXMLOptions(0); // garder les balises vide en ecriture raccourcie

				// Pass it to the sanitizer and get it back clean
				$svg = $sanitizer->sanitize($svg);

				// loger les sanitization
				$trace = "";
				foreach ($sanitizer->getXmlIssues() as $issue) {
					$trace .= $issue['message'] . " L".$issue['line']."\n";
				}
				if ($trace) {
					spip_log($trace, "svg" . _LOG_DEBUG);
				}
			} while (strlen($svg) !== $size and $maxiter-->0);
		}

		ecrire_fichier($file, $svg);
		clearstatcache();
		return true;
	}

	// pas de svg valide
	return false;
}