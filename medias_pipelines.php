<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


if (!defined('_ECRIRE_INC_VERSION')) return;

function medias_detecter_fond_par_defaut($fond){
	// traiter le cas pathologique d'un upload de document ayant echoue
	// car trop gros
	if (empty($_GET) AND empty($_POST) AND empty($_FILES)
	AND isset($_SERVER["CONTENT_LENGTH"])
	AND strstr($_SERVER["CONTENT_TYPE"], "multipart/form-data;")) {
		include_spip('inc/getdocument');
		erreur_upload_trop_gros();
	}
  return $fond;
}

function medias_post_insertion($flux){

	$objet = objet_type($flux['args']['table']);
	if (in_array($objet,array('article','rubrique'))
	  AND $id_auteur = intval($GLOBALS['visiteur_session']['id_auteur'])){

		# cf. GROS HACK ecrire/inc/getdocument
		# rattrapper les documents associes a cet objet nouveau
		# ils ont un id = 0-id_auteur
		$id_objet = $flux['args']['id_objet'];
		# utiliser l'api editer_lien pour les appels aux pipeline edition_lien
		include_spip('action/editer_liens');
		$liens = objet_trouver_liens(array('document'=>'*'),array($objet=>0-$id_auteur));
		foreach($liens as $lien){
			objet_associer(array('document'=>$lien['document']),array($objet=>$id_objet),$lien);
		}
		// un simple delete pour supprimer les liens temporaires
		sql_delete("spip_documents_liens", array("id_objet = ".(0-$id_auteur),"objet=".sql_quote($objet)));
	}

  return $flux;
}

function medias_configurer_liste_metas($config){
	$config['documents_objets'] = '';
	$config['documents_date'] = 'non';
	return $config;
}


function medias_post_edition($flux){
	// si on ajoute un document, mettre son statut a jour
	if($flux['args']['operation']=='ajouter_document'){
		include_spip('action/editer_document');
		// mettre a jour le statut si necessaire
		document_instituer($flux['args']['id_objet']);
	}
	// si on institue un objet, mettre ses documents lies a jour
	elseif ($flux['args']['table']!=='spip_documents'){
		$type = isset($flux['args']['type'])?$flux['args']['type']:objet_type($flux['args']['table']);
		// verifier d'abord les doublons !
		include_spip('inc/autoriser');
		if (autoriser('autoassocierdocument',$type,$flux['args']['id_objet'])){
			$table_objet = isset($flux['args']['table_objet'])?$flux['args']['table_objet']:table_objet($flux['args']['table'],$flux['args']['serveur']);
			$marquer_doublons_doc = charger_fonction('marquer_doublons_doc','inc');
			$marquer_doublons_doc($flux['data'],$flux['args']['id_objet'],$type,id_table_objet($type, $flux['args']['serveur']),$table_objet,$flux['args']['table'], '', $flux['args']['serveur']);
		}

		if($flux['args']['operation']=='instituer' OR isset($flux['data']['statut'])){
			include_spip('base/abstract_sql');
			$id = $flux['args']['id_objet'];
			$docs = array_map('reset',sql_allfetsel('id_document','spip_documents_liens','id_objet='.intval($id).' AND objet='.sql_quote($type)));
			include_spip('action/editer_document');
			foreach($docs as $id_document)
				// mettre a jour le statut si necessaire
				document_instituer($id_document);
		}
	}
	else {
		if ($flux['args']['table']!=='spip_documents'){
			// verifier les doublons !
			$marquer_doublons_doc = charger_fonction('marquer_doublons_doc','inc');
			$marquer_doublons_doc($flux['data'],$flux['args']['id_objet'],$flux['args']['type'],id_table_objet($flux['args']['type'], $flux['args']['serveur']),$flux['args']['table_objet'],$flux['args']['spip_table_objet'], '', $flux['args']['serveur']);
		}
	}
	return $flux;
}

/**
 * Pipeline afficher_complement_objet
 * afficher le portfolio et ajout de document sur les fiches objet
 * sur lesquelles les medias ont ete activees
 * Pour les articles, on ajoute toujours !
 * 
 * @param  $flux
 * @return
 */
function medias_afficher_complement_objet($flux){
	if ($type=$flux['args']['type']
		AND $id=intval($flux['args']['id'])
	  AND (autoriser('joindredocument',$type,$id))) {
		$documenter_objet = charger_fonction('documenter_objet','inc');
		$flux['data'] .= $documenter_objet($id,$type);
	}
	return $flux['data'];
}

function medias_affiche_gauche($flux){
	if ($en_cours = trouver_objet_exec($flux['args']['exec'])
		AND $en_cours['edition']!==false // page edition uniquement
		AND $type = $en_cours['type']
		AND $id_table_objet = $en_cours['id_table_objet']
		AND ($id = intval($flux['args'][$id_table_objet]) OR $id = 0-$GLOBALS['visiteur_session']['id_auteur'])
	  AND autoriser('joindredocument',$type,$id)){
		$flux['data'] .= recuperer_fond('prive/objets/editer/colonne_document',array('objet'=>$type,'id_objet'=>$id));
	}

	return $flux;
}

function medias_document_desc_actions($flux){
	return $flux;
}

function medias_editer_document_actions($flux){
	return $flux;
}


/**
 * Compter les documents dans un objet
 *
 * @param array $flux
 * @return array
 */
function medias_objet_compte_enfants($flux){
	if ($objet = $flux['args']['objet']
	  AND $id=intval($flux['args']['id_objet'])) {
		// juste les publies ?
		if (array_key_exists('statut', $flux['args']) and ($flux['args']['statut'] == 'publie')) {
			$flux['data']['document'] = sql_countsel('spip_documents AS D JOIN spip_documents_liens AS L ON D.id_document=L.id_document', "L.objet=".sql_quote($objet)."AND L.id_objet=".intval($id)." AND (D.statut='publie')");
		} else {
			$flux['data']['document'] = sql_countsel('spip_documents AS D JOIN spip_documents_liens AS L ON D.id_document=L.id_document', "L.objet=".sql_quote($objet)."AND L.id_objet=".intval($id)." AND (D.statut='publie' OR D.statut='prepa')");
		}
	}
	return $flux;
}
