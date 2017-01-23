<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelAdmin.php';
require_once MODEL_PATH . 'ModelBoitier.php';
require_once MODEL_PATH . 'ModelQuestion.php';
require_once MODEL_PATH . 'ModelLieu.php';
require_once MODEL_PATH . 'ModelVote.php';

/*******************************************************************************
 *******************************************************************************
 ********* Ces fonctions sont utiles pour les questions des boitiers ***********
 *******************************************************************************
 *******************************************************************************/ 
if(!empty($_SESSION['login']))
{
    switch ($action) {
        
        /*
        * @param aucun paramètre.
        *
        * @return nous redirige vers la page de création de nouvelles questions.
        */
        case 'newQuestion':
            $view="newQuestion";
            $pagetitle = "Ajouter une nouvelle question";
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