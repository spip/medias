<?php
/***************************************************************************\
 *  SPIP, Système de publication pour l'internet                           *
 *                                                                         *
 *  Copyright © avec tendresse depuis 2001                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Rivière, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribué sous licence GNU/GPL.     *
 *  Pour plus de détails voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

if (!defined('_BOUTON_MODE_IMAGE')) {
	define('_BOUTON_MODE_IMAGE', true);
}

function affiche_bouton_mode_image_portfolio($inclus) {
	if (!defined('_LEGACY_MODE_IMAGE_DOCUMENT') or _LEGACY_MODE_IMAGE_DOCUMENT === false) {
		return '';
	}
	if ($inclus === 'image' and _BOUTON_MODE_IMAGE) {
		return ' ';
	}
	return '';
}

include_spip('inc/documents'); // pour la fonction affiche_raccourci_doc
function medias_raccourcis_doc(
	$id_document,
	$titre,
	$descriptif,
	$inclus,
	$largeur,
	$hauteur,
	$mode,
	$vu,
	$media = null
) {
	$raccourci = '';
	$doc = 'doc';

	if (!defined('_LEGACY_MODE_IMAGE_DOCUMENT') or _LEGACY_MODE_IMAGE_DOCUMENT === false){
		// Affichage du raccourci <doc...> correspondant
		$raccourci =
			affiche_raccourci_doc($doc, $id_document, 'left')
			. affiche_raccourci_doc($doc, $id_document, 'center')
			. affiche_raccourci_doc($doc, $id_document, 'right');
	}
	else {
		// DEPRECATED
		// on le garde juste pour la version SPIP 3.3, activable par la constante _LEGACY_MODE_IMAGE_DOCUMENT
		if ($mode == 'image' and (strlen($descriptif . $titre) == 0)) {
			$doc = 'img';
		}

		// Affichage du raccourci <doc...> correspondant
		$raccourci =
			affiche_raccourci_doc($doc, $id_document, 'left')
			. affiche_raccourci_doc($doc, $id_document, 'center')
			. affiche_raccourci_doc($doc, $id_document, 'right');

		if ($mode == 'document'
			and ($inclus == 'embed' or $inclus == 'image')
			and (($largeur > 0 and $hauteur > 0)
				or in_array($media, array('video', 'audio')))
		) {
			$raccourci =
				'<span>' . _T('medias:info_inclusion_vignette') . '</span>'
				. $raccourci
				. '<span>' . _T('medias:info_inclusion_directe') . '</span>'
				. affiche_raccourci_doc('emb', $id_document, 'left')
				. affiche_raccourci_doc('emb', $id_document, 'center')
				. affiche_raccourci_doc('emb', $id_document, 'right');
		}
	}


	return "<div class='raccourcis'>" . $raccourci . '</div>';
}
