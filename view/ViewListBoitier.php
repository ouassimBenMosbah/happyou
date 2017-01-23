 <?php
$tab_boitier = ModelBoitier::selectBoitier();
$nb_vote_par_boitier = ModelVote::countVotesThisWeek();
$nb_2_last_week = ModelVote::countVotes2LastWeek();
$nb_vote_last_week = ModelVote::countVotesLastWeek();

function list_boitier($tb, $nvpb, $n2lw, $nvlw) {
    $tmp = array();
    $tmp1 = array();
    for ($i=0; $i < count($tb); $i++) {
        $taux = 0;
        $variation = 0;
        $num = $tb[$i]->Num_serie_boitier;

        $lieu = $tb[$i]->lieu;
        $nb_satisfait = $tb[$i]->nb_satisfait;
        $nb_vote = $nvpb[$i]->nb_vote;
        $class_variation = '';
        if ($nb_vote == 0)
        {
            $taux = 'Nan';
            $variation = 'Nan';
        }
        else
        {
            $taux = number_format((float)(($nb_satisfait / $nb_vote) * 100), 1, '.', '');
            $nb_satisfait_lw = $n2lw[$i]->nb_satisfait;
            $nb_vote_lw = $nvlw[$i]->nb_vote;
            if ($nb_vote_lw == 0)
            {
                $variation = 'Nan';
            }
            else
            {
                $variation = number_format((float)(($nb_satisfait_lw / $nb_vote_lw) * 100), 1, '.', '');
                $variation = number_format((float)($taux - $variation), 1, '.', '');
                if ($variation > 0)
                {
                    $class_variation = 'class = "fa fa-sort-asc" style="color:green"';
                }
                elseif ($variation == 0) 
                {
                    $class_variation = 'class = "fa fa-sort-asc" style="color:green"';
                }
                else
                {
                    $class_variation = 'class = "fa fa-sort-desc" style="color:red"';
                }
            }
        }


        // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
        echo <<<EOT
        <tr> 
            <td><a class="ico-lien ico-res" href="boitier-details-$num"><i class="fa fa-plus"></i></a></td>
            <td>$num</td>
            <td>$lieu</td>
            <td>$taux</td>
            <td $class_variation> $variation</td>
            <td>$nb_vote votes</td>
        </tr>
EOT;
    }
   
}

?> 
<div class="col-lg-12 background-auto">
    
    <div class="col-lg-10 col-lg-offset-1 list-tab">
        <div class="table-responsive">
            <table id="tabListBoitier" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
        
                    <tr>
                        <th>Modifiez</th>
                        <th>Numéro de série</th>
                        <th>Lieu</th>
                        <th>Taux satisf. <br/>(en %)</th>
                        <th>Progression <br/> (en pts)</th>
                        <th>votes</th>
                    </tr>
                </thead>
					
                <tbody>
                    <?php list_boitier($tab_boitier, $nb_vote_par_boitier, $nb_2_last_week, $nb_vote_last_week); ?>
                </tbody>
            </table>
            
           
        </div>
    </div>
    
    
</div>
