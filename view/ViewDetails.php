<?php
$tab_lieu = ModelLieu::selectLieux();
$autocompleteLieu = "";
foreach ($tab_lieu as $tl) {                                              
    $nomL = $tl->nom_lieu;
    $autocompleteLieu .='"';
    $autocompleteLieu .= "$nomL" ; 
    $autocompleteLieu .='",';
   
}

$tab_question = ModelQuestion::selectQuestions();
$autocompleteQuestion = "";
foreach ($tab_question as $tq) {
    $nomQ = $tq->nom_question;
    $autocompleteQuestion .='"';
    $autocompleteQuestion .= "$nomQ" ; 
    $autocompleteQuestion .='",';
   
}

/********** Traitement des différents champs de la page *********/
foreach ($details_boitier as $db) {
    $num_serie = $db->Num_serie_boitier;
    $date_install = $db->Date_install;
    $lieu_actuel = $db->nom_lieu;
    $question = $db->question;
    $id_question = $db->id_question;
    $id_lieu = $db->id_lieu;
}

/****Remplissage tabH****/
$tabH0 = array();
$tabH1 = array();
$tabH2 = array();
for($i = 0; $i < 12; $i++)
{
    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>0, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesH($data);
    $tabH0[] = $tab_votes[0]->avis;
    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>1, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesH($data);
    $tabH1[] = $tab_votes[0]->avis;

    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>2, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesH($data);
    $tabH2[] = $tab_votes[0]->avis;
}

/****Remplissage tabJ****/
$tabJ0 = array();
$tabJ1 = array();
$tabJ2 = array();
for($i = 0; $i < 10; $i++)
{
    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>0, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesJ($data);
    $tabJ0[] = $tab_votes[0]->avis;
    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>1, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesJ($data);
    $tabJ1[] = $tab_votes[0]->avis;

    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>2, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesJ($data);
    $tabJ2[] = $tab_votes[0]->avis;
}
/****Remplissage tabM****/
$tabM0 = array();
$tabM1 = array();
$tabM2 = array();
for($i = 0; $i < 12; $i++)
{
    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>0, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesM($data);
    $tabM0[] = $tab_votes[0]->avis;
    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>1, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesM($data);
    $tabM1[] = $tab_votes[0]->avis;

    $data = array('num_serie'=>$num_serie, 'int'=>$i, 'smiley'=>2, 'id_question'=>$id_question, 'id_lieu'=>$id_lieu);
    $tab_votes = ModelVote::countVotesM($data);
    $tabM2[] = $tab_votes[0]->avis;
}


?>

<div class="col-md-12 background-auto">
    
    <div class="col-md-6 col-md-offset-1">

        <div class="contenutitreDesc">
            <div class="col-md-7 titreDesc">
                <?php echo $num_serie; ?>
                <hr>
            </div>
        </div>
        <div class="col-md-12 contenerDes">
            <div class="libDesc">Date d'installation du boitier :</div>
            <div class="contenuDesc"><?php echo $date_install; ?></div>
        </div>
        <div class="col-md-12 contenerDes">
            <div class="libDesc">Lieu actuel :</div>
            <div class="contenuDesc"><?php echo $lieu_actuel; ?></div>
        </div>
        <div class="col-md-12 contenerDes">
            <div class="libDesc">Question actuel :</div>
            <div class="contenuDesc"><?php echo $question; ?></div>
        </div>
    </div>

    <div class="col-md-5">
        <form action='index.php' method='post' class="form-res">
            <input type="hidden" value="changement" name='action' >
                <input type="hidden" value="boitier" name='controller' >
                <input type="hidden" value="<?php echo $num_serie?>" name="num_serie_boitier">
                <div id='titleChgts'>
                    Changez le lieu du boitier :
                </div>
                <div>
                    <div class="group-details"> 
                        <input type="text" name='nomLieu' id='nomLieu' value=''>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                </div>
                <div id='titleChgts'>
                    Changez la question posé par le boitier :
                </div>
                <div>
                    <div class="group-details"> 
                        <input type="text" name='nomQuestion' id='nomQuestion' value=''>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                </div>
                <div class='titleChgt'>
                    Choisissez l'opération que vous voulez exécuter:
                </div>
                <div class="col-md-12" id='contenerOpe'>
                    <div class="col-md-12 contrad">
                        <input type='radio' name='ope' id="lieuRadio" value="chgt_L" checked=""/>
                        <label>Changez le lieu du boitier</label>
                    </div>
                    <div class="col-md-12 contrad" >
                        <input type='radio' name='ope' id="questRadio" value="chgt_Q"/>
                        <label>Changez la question posé par le boitier</label>
                    </div>
                </div>                
                <div class="col-md-3 col-md-offset-1">
                    <button type='submit' class="button-form" id="button-res">Modifier</button>
                </div>
        </form>
    </div>
</div>

<div id="contener-res">
    <div class="col-xs-12">
        <div id="chart-J" class="chart col-md-6 col-xs-12"></div>
        <div id="pie-J" class="pie col-md-6 col-xs-12"></div>
    </div>

    <div class="col-xs-12">
        <div id="chart-M" class="chart col-md-6 col-xs-12"></div>
        <div id="pie-M" class="pie col-md-6 col-xs-12"></div>
    </div>

    <div class="col-xs-12">
        <div id="chart-H" class="chart col-md-6 col-xs-12"></div>
        <div id="pie-H" class="pie col-md-6 col-xs-12"></div>
    </div>

    <div class="zoom-button col-xs-12">
        <button class="button-zoom" id="showh">rapport horaire</button>
        <button class="button-zoom" id="showj">rapport journalier</button>
        <button class="button-zoom" id="showm">rapport mensuel</button>
    </div>
</div>