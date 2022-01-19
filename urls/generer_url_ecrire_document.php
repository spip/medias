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


/**
 * Generer l'url d'un document dans l'espace prive,
 * fonction du statut du document
 *
 * @param int $id
 * @param string $args
 * @param string $ancre
 * @param string $public
 * @param string $connect
 * @return string
 */
function urls_generer_url_ecrire_document_dist($id, $args = '', $ancre = '', $public = null, $connect = '') {
	include_spip('inc/documents');

	return generer_url_document_dist($id);
}
