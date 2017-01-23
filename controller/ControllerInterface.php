<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelAdmin.php';
require_once MODEL_PATH . 'ModelBoitier.php';
require_once MODEL_PATH . 'ModelQuestion.php';
require_once MODEL_PATH . 'ModelLieu.php';
require_once MODEL_PATH . 'ModelVote.php';

/*******************************************************************************
 *******************************************************************************
 ***************** Ces fonctions sont utiles pour les fonctions ****************
 *********************** de l'interface avec l'utilisateur ********************* 
 *******************************************************************************
 *******************************************************************************/ 


switch ($action) {
    
    /*
    * @param aucun paramètre.
    *
    * @return nous redirige vers la page de connexion.
    */
    case "connect" :
        session_destroy();
        unset($_SESSION);
        $erreurIn = false;
        $view = "connect";
        $pagetitle = "Page de connexion";
       break;
    
   
    /*
    * @param récupère la chaine de caractères pour le login inscrit par l'utilisateur dans le champs du formulaire de connexion.
    * @param récupère la chaine de caractères pour le mot de passe inscrit par l'utilisateur dans le champs du formulaire de connexion.
    *
    * @return si les identifiants sont correctes on est dirigé vers la page de la liste des boitiers et si les identifiants sont incorrectes on reste sur la meme page.
    */
    case "connected" :
        
        if (is_null(myGet('login')) || is_null(myGet('mdp')) ) {
            $view      = "error";
            $pagetitle = "Erreur !";
            break;
        } 
        else {
            $data = array(
                "login" => myGet('login'),
                "mdp" => hash('sha256', myGet('mdp') . Conf::getSeed())
            );
            
            $tab_u = ModelAdmin::selectInfoConnect($data);
                
            // Chargement de la vue
            if (count($tab_u) == 0) {
                $erreurIn = true;
                $view = "connect";
                $pagetitle = "Page de connexion";
                break;
                    
            } 
            else 
            {
                
                session_name('Consultation des votes :)');
                $_SESSION['login'] = myGet('login');
                $_SESSION['admin'] = true;

                $view = "listBoitier";
                $pagetitle = "Page de la liste des boitiers";
                    
            }
             
        }
        break;
    
        
    /*
    * @param aucun paramètre.
    *
    * @return nous redirige vers la page de la liste des boitiers.
    */
    case 'home' :
        if(!empty($_SESSION['login']))
        {
            $view = "listBoitier";
            $pagetitle = "Page de la liste des boitiers";
        }
        else
        {
            $view = "error";
                $pagetitle = "Erreur";
        }
        break;

    
    /*
    * @param aucun paramètre.
    *
    * @return détruit la session et nous redirige vers la page de connexion.
    */
    case 'disconnect':
        session_destroy();
        unset($_SESSION);
        $erreurIn = false;
        $view = "connect";
        $pagetitle = "Page de connexion";
        break;

    /*
    * @param aucun paramètre.
    *
    * @return si l'utilisateur n'est pas connecté on affiche la page d'erreur.
    */
    default:
        $view = "error";
        $pagetitle = "Erreur";

}


require VIEW_PATH . "view.php";