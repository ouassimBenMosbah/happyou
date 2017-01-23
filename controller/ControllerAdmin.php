<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelAdmin.php';
require_once MODEL_PATH . 'ModelBoitier.php';
require_once MODEL_PATH . 'ModelQuestion.php';
require_once MODEL_PATH . 'ModelLieu.php';
require_once MODEL_PATH . 'ModelVote.php';

/*******************************************************************************
 *******************************************************************************
 ***************** Ces fonctions sont utiles pour les admin ********************
 *******************************************************************************
 *******************************************************************************/ 
if(!empty($_SESSION['login']))
{
    switch ($action) {
            
        /*
        * @param aucun paramètre.
        *
        * @return nous redirige vers la page de modification des log de l'admin.
        */
        case 'modifProfil':
            $change_success = false;
            $view = "modifAdmin";
            $pagetitle = "Modifer vos paramètres de connexion";
            break;
        

        /*
        * @param récupère l'int de l'identifiant de l'admin a modifier.
        * @param récupère la chaine de caractère du login de l'admin.
        * @param récupère la chaine de caractère du mot de passe de l'admin.
        *
        * @return appelle la fonction de modification des log de l'admin en cryptant son mdp.
        */   
        case 'modifiedAdmin':
            
            $login= myGet ('login');
            
            $data = array('login'=>$_SESSION['login']);
            $res_id = ModelAdmin::selectIdAdmin($data);
            $id = intval($res_id[0]->id);
            
            $mdp = hash('sha256', myGet('mdp') . Conf::getSeed());
            
            $data2 = array("idAdmin"=>$id, 'login'=>$login, 'mdp'=>$mdp);
            ModelAdmin::modifAdmin($data2);

            $change_success = true;
            $view = "modifAdmin";
            $pagetitle = "Modifer vos paramètres de connexion";
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