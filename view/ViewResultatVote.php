<?php
/* Remplissage chart-H-glob*/
$tabH0 = array();
$tabH1 = array();
$tabH2 = array();
for($i = 0; $i < 12; $i++)
{
    $data = array('smiley'=>0, 'int'=>$i);
    $tab_votes = ModelVote::countVotesHGlob($data);
    $tabH0[] = $tab_votes[0]->avis;
    $data = array('smiley'=>1, 'int'=>$i);
    $tab_votes = ModelVote::countVotesHGlob($data);
    $tabH1[] = $tab_votes[0]->avis;

    $data = array('smiley'=>2, 'int'=>$i);
    $tab_votes = ModelVote::countVotesHGlob($data);
    $tabH2[] = $tab_votes[0]->avis;
}


/* Remplissage chart-J-glob*/
$tabJ0 = array();
$tabJ1 = array();
$tabJ2 = array();
for($i = 0; $i < 10; $i++)
{
    $data = array('smiley'=>0, 'int'=>$i);
    $tab_votes = ModelVote::countVotesJGlob($data);
    $tabJ0[] = $tab_votes[0]->avis;
    $data = array('smiley'=>1, 'int'=>$i);
    $tab_votes = ModelVote::countVotesJGlob($data);
    $tabJ1[] = $tab_votes[0]->avis;

    $data = array('smiley'=>2, 'int'=>$i);
    $tab_votes = ModelVote::countVotesJGlob($data);
    $tabJ2[] = $tab_votes[0]->avis;
}


/* Remplissage chart-M-glob*/
$tabM0 = array();
$tabM1 = array();
$tabM2 = array();
for($i = 0; $i < 12; $i++)
{
  	$data = array('smiley'=>0, 'int'=>$i);
    $tab_votes = ModelVote::countVotesMGlob($data);
    $tabM0[] = $tab_votes[0]->avis;
    $data = array('smiley'=>1, 'int'=>$i);
    $tab_votes = ModelVote::countVotesMGlob($data);
    $tabM1[] = $tab_votes[0]->avis;

    $data = array('smiley'=>2, 'int'=>$i);
    $tab_votes = ModelVote::countVotesMGlob($data);
    $tabM2[] = $tab_votes[0]->avis;
}

/* Remplissage top-satisf*/
$boitier_top_satisf2 = array();
$nb_top_satisf2 =array();
$data =  ModelVote::top5satisf();
for($i = 0; $i < count($data); $i++){
    $nb_votes_tot = 0;
    $id_lieu = $data[$i]->id_lieu;
    $lieu = $data[$i]->lieu;
    $boitier = $data[$i]->boitier;
    $boitier_top_satisf2[] = "'" . $boitier . ' (' . $lieu . ")'";
    $data2 = array('id_lieu'=>$id_lieu, 'num_serie_boitier'=>$boitier);
    $nb_votes_tot = ModelVote::top5total($data2);
    $nb_top_satisf2[] = number_format(($data[$i]->avis / $nb_votes_tot[0]->avis_tot) * 100, 2);
}
$boitier_top_satisf = array();
$nb_top_satisf = array();
$tmp = count($nb_top_satisf2);
for ($i=0; $i < $tmp && $i < 5; $i++) { 
    $key = array_search(max($nb_top_satisf2), $nb_top_satisf2);
    $boitier_top_satisf[] = $boitier_top_satisf2[$key];
    $nb_top_satisf[] = $nb_top_satisf2[$key];
    unset($boitier_top_satisf2[$key]);
    unset($nb_top_satisf2[$key]);
}

/* Remplissage top-insatisf*/
$boitier_top_insatisf2 = array();
$nb_top_insatisf2 =array();
$data = array();
$data =  ModelVote::top5insatisf();
for($i = 0; $i < count($data); $i++){
    $nb_votes_tot = 0;
    $id_lieu = $data[$i]->id_lieu;
    $lieu = $data[$i]->lieu;
    $boitier = $data[$i]->boitier;
    $boitier_top_insatisf2[] = "'" . $boitier . ' (' . $lieu . ")'";
    $data2 = array('id_lieu'=>$id_lieu, 'num_serie_boitier'=>$boitier);
    $nb_votes_tot = ModelVote::top5total($data2);
    $nb_top_insatisf2[] = number_format(($data[$i]->avis / $nb_votes_tot[0]->avis_tot) * 100, 2);
}
$boitier_top_insatisf = array();
$nb_top_insatisf = array();
$tmp = count($nb_top_insatisf2);
for ($i=0; $i < $tmp && $i < 5; $i++) { 
    $key = array_search(max($nb_top_insatisf2), $nb_top_insatisf2);
    $boitier_top_insatisf[] = $boitier_top_insatisf2[$key];
    $nb_top_insatisf[] = $nb_top_insatisf2[$key];
    unset($boitier_top_insatisf2[$key]);
    unset($nb_top_insatisf2[$key]);
}


/* Remplissage jauge-global*/
$nb_satisfait = array();
$nb_total = array();
$data = Modelvote::countSatisfactionMensuel();
$nb_satisfait[] = $data[0]->satisfaction;
$data = Modelvote::countVotesMensuel();
$nb_total[] = $data[0]->satisfaction;


?>

<div class = "col-lg-12">
	<div id="chart-H-glob" class="col-lg-4 col-md-6 col-sm-12 chart-glob"></div>
	<div id="chart-J-glob" class="col-lg-4 col-md-6 col-sm-12 chart-glob"></div>
	<div id="chart-M-glob" class="col-lg-4 col-md-6 col-sm-12 chart-glob"></div>
	<div id="top-satisf" class="col-lg-4 col-md-6 col-sm-12 chart-glob"></div>
	<div id="top-insatisf" class="col-lg-4 col-md-6 col-sm-12 chart-glob"></div>
	<div id="jauge-global" class="col-lg-4 col-md-6 col-sm-12 chart-glob"></div>
</div>