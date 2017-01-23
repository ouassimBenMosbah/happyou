<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelAdmin.php';
require_once MODEL_PATH . 'ModelBoitier.php';
require_once MODEL_PATH . 'ModelQuestion.php';
require_once MODEL_PATH . 'ModelLieu.php';
require_once MODEL_PATH . 'ModelVote.php';

/*******************************************************************************
 *******************************************************************************
 *************** Ces fonctions sont utiles pour les erreurs *******************
 *******************************************************************************
 *******************************************************************************/ 

switch ($action) {
	/*
    * @param aucun paramètre.
    *
    * @return par défaut retourne la page d'erreur.
    */
	default:
		$view = "error";
		$pagetitle = "Erreur";
}

require VIEW_PATH . "view.php";