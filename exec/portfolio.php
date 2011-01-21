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

if (!defined("_ECRIRE_INC_VERSION")) return;


include_spip('inc/presentation');

function exec_portfolio(){
	if (!autoriser('administrer','portfolio',0)) {
		include_spip('inc/minipres');
		echo minipres();
		exit;
	}

	if (defined('_AJAX') AND _AJAX){
		$contexte = array_merge(array('editable'=>0),$_GET);
		$res = /*formulaire_recherche('portfolio').*/recuperer_fond('prive/galerie',$contexte);

		include_spip('inc/actions');
		ajax_retour($res);
		return;
	}
	
	$commencer_page = charger_fonction('commencer_page','inc');
	echo $commencer_page(_T('medias:documents'));
	
	echo gros_titre(_T('medias:documents'),'',false);
	echo debut_grand_cadre(true);
	
	echo formulaire_recherche('portfolio');
	echo recuperer_fond('prive/galerie',$_GET);

	echo fin_grand_cadre(true),fin_page();
}

?>