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
 * Gestion des modes de documents
 *
 * @package SPIP\Medias\Modes
 */
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Determiner le statut automatique d'un document
 * @param int $id_document
 * @param string $statut_ancien
 * @param string $date_publication_ancienne
 * @return array|false
 */
function inc_determiner_statut_document($id_document, $statut_ancien, $date_publication_ancienne) {

	$statut = 'prepa';

	$trouver_table = charger_fonction('trouver_table', 'base');
	$res = sql_select(
		'id_objet,objet',
		'spip_documents_liens',
		"objet!='document' AND id_document=" . intval($id_document)
	);

	// On aura 19 jours 3h14 et 7 secondes pour corriger en 2038 (limitation de la représentation POSIX du temps sur les 32 bits)
	$date_publication = strtotime('2038-01-01 00:00:00');
	include_spip('base/objets');
	while ($row = sql_fetch($res)) {
		if (
			// cas particulier des rubriques qui sont publiees des qu'elles contiennent un document !
			$row['objet'] == 'rubrique'
			// ou si objet publie selon sa declaration
			or objet_test_si_publie($row['objet'], $row['id_objet'])
		) {
			$statut = 'publie';
			$date_publication = 0;
			continue;
		} // si pas publie, et article, il faut checker la date de post-publi eventuelle
		elseif ($row['objet'] == 'article'
			and $row2 = sql_fetsel(
				'date',
				'spip_articles',
				'id_article=' . intval($row['id_objet']) . " AND statut='publie'"
			)
		) {
			$statut = 'publie';
			$date_publication = min($date_publication, strtotime($row2['date']));
		}
	}

	$date_publication = date('Y-m-d H:i:s', $date_publication);
	if ($statut == 'publie' and $statut_ancien == 'publie' and $date_publication == $date_publication_ancienne) {
		return false;
	}
	if ($statut != 'publie' and $statut_ancien != 'publie' and $statut_ancien != '0') {
		return false;
	}

	$champs = [];
	if ($statut !== $statut_ancien) {
		$champs['statut'] = $statut;
	}
	if ($date_publication !== $date_publication_ancienne) {
		$champs['date_publication'] = $date_publication;
	}

	return $champs;
}
