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

/**
 * Gestion des vignettes de types de fichier
 *
 * @package SPIP\Medias\Vignette
 **/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Verifier si le fichier respecte les contraintes de tailles
 *
 * @param  array $infos
 * @param  bool $is_logo
 * @return bool|mixed|string
 */
function inc_verifier_taille_document_acceptable_dist(&$infos, $is_logo = false) {

	// si ce n'est pas une image
	if (!$infos['type_image']) {
		if (defined('_DOC_MAX_SIZE') and _DOC_MAX_SIZE > 0 and $infos['taille'] > _DOC_MAX_SIZE * 1024) {
			return _T(
				'medias:info_doc_max_poids',
				array(
					'maxi' => taille_en_octets(_DOC_MAX_SIZE * 1024),
					'actuel' => taille_en_octets($infos['taille'])
				)
			);
		}
	} // si c'est une image
	else {
		if ((defined('_IMG_MAX_WIDTH') and _IMG_MAX_WIDTH and $infos['largeur'] > _IMG_MAX_WIDTH)
			or (defined('_IMG_MAX_HEIGHT') and _IMG_MAX_HEIGHT and $infos['hauteur'] > _IMG_MAX_HEIGHT)
		) {
			$max_width = (defined('_IMG_MAX_WIDTH') and _IMG_MAX_WIDTH) ? _IMG_MAX_WIDTH : '*';
			$max_height = (defined('_IMG_MAX_HEIGHT') and _IMG_MAX_HEIGHT) ? _IMG_MAX_HEIGHT : '*';

			// pas la peine d'embeter le redacteur avec ca si on a active le calcul des miniatures
			// on met directement a la taille maxi a la volee
			if (isset($GLOBALS['meta']['creer_preview']) and $GLOBALS['meta']['creer_preview'] == 'oui') {
				include_spip('inc/filtres');
				$img = filtrer('image_reduire', $infos['fichier'], $max_width, $max_height);
				$img = extraire_attribut($img, 'src');
				$img = supprimer_timestamp($img);
				if (@file_exists($img) and $img !== $infos['fichier']) {
					spip_unlink($infos['fichier']);
					@rename($img, $infos['fichier']);
					list($h, $w) = taille_image($infos['fichier'], true);
					$infos['largeur'] = $w;
					$infos['hauteur'] = $h;
					$infos['taille'] = @filesize($infos['fichier']);
				}
			}

			if ((defined('_IMG_MAX_WIDTH') and _IMG_MAX_WIDTH and $infos['largeur'] > _IMG_MAX_WIDTH)
				or (defined('_IMG_MAX_HEIGHT') and _IMG_MAX_HEIGHT and $infos['hauteur'] > _IMG_MAX_HEIGHT)
			) {
				return _T(
					'medias:info_image_max_taille',
					array(
						'maxi' =>
							_T(
								'info_largeur_vignette',
								array(
									'largeur_vignette' => $max_width,
									'hauteur_vignette' => $max_height
								)
							),
						'actuel' =>
							_T(
								'info_largeur_vignette',
								array(
									'largeur_vignette' => $infos['largeur'],
									'hauteur_vignette' => $infos['hauteur']
								)
							)
					)
				);
			}
		}

		if (defined('_IMG_MAX_SIZE') and _IMG_MAX_SIZE > 0 and $infos['taille'] > _IMG_MAX_SIZE * 1024) {
			return _T(
				'medias:info_image_max_poids',
				array(
					'maxi' => taille_en_octets(_IMG_MAX_SIZE * 1024),
					'actuel' => taille_en_octets($infos['taille'])
				)
			);
		}
	}

	return true;
}
