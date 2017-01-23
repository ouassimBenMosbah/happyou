<?php
$tab_lieu = ModelLieu::selectLieux();
$autocompleteLieu = "";
foreach ($tab_lieu as $tl)
{                                              
    $nomL = $tl->nom_lieu;
    $autocompleteLieu .='"';
    $autocompleteLieu .= "$nomL" ; 
    $autocompleteLieu .='",';
   
}

$tab_question = ModelQuestion::selectQuestions();
$autocompleteQuestion = "";
foreach ($tab_question as $tq)
{
    $nomQ = $tq->nom_question;
    $autocompleteQuestion .='"';
    $autocompleteQuestion .= "$nomQ" ; 
    $autocompleteQuestion .='",';
   
}
?>


<div class="col-md-12 background-auto" id="fondnewBoitier">

    <div class="col-xs-offset-3 col-xs-6" id="contenerformnewBoitier">
        <div class="header-form">Nouveau boitier</div>

        <form action='index.php' method='post' enctype="multipart/form-data">
        
            <input type="hidden" value="createBoitier" name='action'>
            <input type="hidden" value="boitier" name='controller'>

            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">
                <div class="group">   
                    <input type="text" name='nomBoitier' value='' required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Num série du boitier</label>
                </div>
            </div>


            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">
                <div class="group">   
                    <input type="text" name='nomLieu' id='nom_lieu' value='' required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Lieu d'installation</label>
                </div>
            </div>

            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">
                <div class="group">   
                    <input type="text" name='question' id='question' value='' required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Question posée</label>
                </div>
            </div> 

            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">   
            <button type='submit' class="button-form" id="buttonnewBoitier">Ajouter</button>
            </div>

        </form>
    </div>
</div>
