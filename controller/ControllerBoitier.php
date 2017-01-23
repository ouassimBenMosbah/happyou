<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelAdmin.php';
require_once MODEL_PATH . 'ModelBoitier.php';
require_once MODEL_PATH . 'ModelQuestion.php';
require_once MODEL_PATH . 'ModelLieu.php';
require_once MODEL_PATH . 'ModelVote.php';

/*******************************************************************************
 *******************************************************************************
 *************** Ces fonctions sont utiles pour les boitiers *******************
 *******************************************************************************
 *******************************************************************************/ 
if(!empty($_SESSION['login']))
{
    switch ($action) {
        
        /*
        * @param aucun paramètre.
        *
        * @return nous redirige vers la page de création de nouveaux boitier.
        */
        case 'newBoitier':
            $view = "newBoitier";
            $pagetitle = "Ajouter un nouveau Boitier";
            break;
            
            
        /*
        * @param récupère la chaine de caractère du num de série du boitier.
        * @param récupère la chaine de caractère du lieu d'installation du boitier.
        * @param récupère la chaine de caractère de la question qui sera posé dans le boitier.
        *
        * @return vérifie si le lieu existe et si ce n'est pas le cas il est crée, même chose pour la question. On appelle la fonction pour créer un nouveau boitier avec la question et le lieu donné en paramètre et nous redirige vers la liste des boitiers.
        */
        case 'createBoitier':
            $nomBoitier = myGet('nomBoitier');
            $lieuInstallBoitier = myGet('nomLieu');
            $question = myGet('question');

            $data1 = array('question'=>$question);
            $quest_exist = ModelQuestion::verifQuestion($data1);
            if (count($quest_exist) == 0)
            {
                ModelQuestion::insertQuestion($data1);
                $quest_exist = ModelQuestion::verifQuestion($data1);
            }
            $id_question = $quest_exist[0]->id_question;

            $data2 = array('lieu'=>$lieuInstallBoitier);
            $lieu_exist = ModelLieu::verifLieu($data2);
            if (count($lieu_exist) == 0)
            {
                ModelLieu::insertLieu($data2);
                $lieu_exist = ModelLieu::verifLieu($data2);
            }
            $id_lieu = $lieu_exist[0]->id_lieu;

            $data = array("NomBoitier"=>$nomBoitier, "id_lieu"=>$id_lieu, 'id_question'=> $id_question);

            ModelBoitier::insertBoitier($data);

            $view = "listBoitier";
            $pagetitle = "Liste des boitiers";
            break;


        /*
        * @param récupère la chaine de caractère du num de série du boitier.
        *
        * @return nous redirige vers la page des détails du boitier donné en paramètre si il existe sinon retourne une page d'erreur.
        */
        case 'details':
            $num_serie = myGet('num');

            $data = array('num' => $num_serie);
            $isExist = ModelBoitier::verifBoitier($data);
            if (count($isExist) > 0)
            {
                $details_boitier = ModelBoitier::detailsBoitier($data);
                $view = "details";
                $pagetitle = "Détails du boitier " . $num_serie;
            }
            else
            {
                $view = "error";
                $pagetitle = "Erreur";
            }
        
            break;


        /*
        * @param récupère la chaine de caractère du num de série du boitier.
        * @param récupère la chaine de caractère du type d'opération à effectuer sur le boitier.
        * @param récupère la chaine de caractère de la valeur à changer (soit lieu soit question en fction de l'opération cochez).
        *
        * @return appelle la fonction pour la modification de la question/lieu du boitier et nous redirige vers la page des détails du boitier donné en paramètre.
        */
        case 'changement':
            $num_serie = myGet('num_serie_boitier');
            $type_chgt = myGet('ope');

            if ($type_chgt == "chgt_Q" && !empty(myGet('nomQuestion')))
            {
                $question = myGet('nomQuestion');
                $data1 = array('question'=>$question);
                $quest_exist = ModelQuestion::verifQuestion($data1);
                if (count($quest_exist) == 0)
                {
                    ModelQuestion::insertQuestion($data1);
                    $quest_exist = ModelQuestion::verifQuestion($data1);
                }
                $id_question = $quest_exist[0]->id_question;

                $data = array('id_question'=>$id_question, 'Num_serie_boitier'=>$num_serie);
                ModelBoitier::updateQuestion($data);
            }
            elseif ($type_chgt == "chgt_L" && !empty(myGet('nomLieu'))) 
            {
                $lieuInstallBoitier = myGet('nomLieu');
                $data2 = array('lieu'=>$lieuInstallBoitier);
                $lieu_exist = ModelLieu::verifLieu($data2);
                if (count($lieu_exist) == 0)
                {
                    ModelLieu::insertLieu($data2);
                    $lieu_exist = ModelLieu::verifLieu($data2);
                }
                $id_lieu = $lieu_exist[0]->id_lieu;

                $data = array('id_lieu'=>$id_lieu, 'Num_serie_boitier'=>$num_serie);
                ModelBoitier::updateLieu($data);
            }

            $data3 = array('num' => $num_serie);
            $details_boitier = ModelBoitier::detailsBoitier($data3);
            $view = "details";
            $pagetitle = "Détails du boitier " . $num_serie;
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