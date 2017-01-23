<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelAdmin.php';
require_once MODEL_PATH . 'ModelBoitier.php';
require_once MODEL_PATH . 'ModelQuestion.php';
require_once MODEL_PATH . 'ModelLieu.php';
require_once MODEL_PATH . 'ModelVote.php';

/*******************************************************************************
 *******************************************************************************
 ***************** Ces fonctions sont utiles pour les votes ******************
 *******************************************************************************
 *******************************************************************************/ 
if(!empty($_SESSION['login']))
{            
    switch ($action) {

        /*
        * @param récupère la chaine de caractère du num de série du boitier.
        * @param récupère la chaine de caractère du lieu du vote.
        * @param récupère la chaine de caractère de la question posée lors du vote.
        * @param récupère le moment (datetime) du vote.
        * @param récupère l'entier correspondant au vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
        *
        * @return appelle la fonction pour créer un insérer un vote et nous redirige vers la liste des boitiers.
        */
        case 'insertVote':
        	$num_serie_boitier = myGet('num');
        	$data = array('num'=>$num_serie_boitier);
        	
        	$tab_info = ModelBoitier::detailsBoitier($data);
        	$lieu = $tab_info[0]->id_lieu;
    		$question = $tab_info[0]->id_question;
    		$date = date('Y-m-d H:i:s');

    		
    		$vote = myGet('bouton');
    		$data2 = array('vote'=>$vote, 'num'=>$num_serie_boitier, 'id_lieu'=>$lieu, 'id_question'=>$question, 'date'=>$date);
    		ModelVote::insertVote($data2);

            $view = "listBoitier";
            $pagetitle = "Liste des boitiers";
            break;

        /*
        * @param aucun paramètre.
        *
        * @return retourne la page du tableau de bord des résultats.
        */
        case 'resultatVote':

            $view = "resultatVote";
            $pagetitle = "Tableau de bord des résultats";
            break;

        /*
        * @param aucun paramètre.
        *
        * @return par défaut retourne la page d'erreur.
        */
        default:
            $view = "error";
            $pagetitle = "Erreur";
    }
}
else
{
    /*
    * @param aucun paramètre.
    *
    * @return si l'utilisateur n'est pas connecté on affiche la page d'erreur.
    */
    $view = "error";
        $pagetitle = "Erreur";
}
require VIEW_PATH . "view.php";