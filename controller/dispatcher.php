<?php

define('MODEL_PATH', ROOT . DS . 'model' . DS);
define('VIEW_PATH', ROOT . DS . 'view' . DS);

function myGet($var)
{
    if (isSet($_GET[$var]))
    {
        return $_GET[$var];
    }
    else if (isSet($_POST[$var]))
    {
        return $_POST[$var];
    }
    else
    {
        return NULL;
    }
}

        session_start();



if (!is_null(myGet('controller')))
    $controller = myGet('controller'); //recupere le controlleur passe dans l'url
else
    $controller = "interface";



if (!is_null(myGet('action')))
    $action = myGet('action');    //recupere l'action  passee dans l'url
else
    $action = "connect";


switch ($controller) {
    case "admin":
        require_once "ControllerAdmin.php";
        break;
    
    case "interface":
        require_once "ControllerInterface.php";
        break;
    
    case "boitier":
        require_once "ControllerBoitier.php";
        break;

    case "question":
        require_once "ControllerQuestion.php";
        break;

    case "lieu":
        require_once "ControllerLieu.php";
        break;

    case "vote":
        require_once "ControllerVote.php";
        break;

    default:
        require_once "ControllerErreur.php";
        break;
}
?>