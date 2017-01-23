
<?php if($view=='newBoitier')
    { 
?>   
    availableTagsLieu = [<?php echo $autocompleteLieu; ?>];
    
    $("#nom_lieu").autocomplete({
        source: availableTagsLieu
    });
    
    
    availableTagsQuestion = [<?php  echo $autocompleteQuestion; ?>];
      
      
    $("#question").autocomplete({
        source: availableTagsQuestion
    });

<?php }
?>


<?php if($view=='admin')
{
?>    

$(document).ready(function() {
    $('#tabAdmin').DataTable();
} );

<?php }
?>
   
   
<?php if($view=='listBoitier')
{
?>    

$(document).ready(function() {
  $('#tabListBoitier').DataTable( {
    "columnDefs": [
      {
        "targets": [0],
        "orderable": false
      }
    ],
    "order": [[1, "asc"]]
  });
} );

<?php }
?>
 

<?php if($view=='details')
{
?> 
  availableTagsLieu = [<?php echo $autocompleteLieu; ?>];
  $("#nomLieu").autocomplete({
      source: availableTagsLieu
  });

  availableTagsQuestion = [<?php  echo $autocompleteQuestion; ?>];      
  $("#nomQuestion").autocomplete({
    source: availableTagsQuestion
  });

  var tab_jour = new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
  var ladate = new Date();
  var numDay = ladate.getDay();

  $(function () {
    $('#container').highcharts({
      chart: {
        type: 'column',
        backgroundColor: 'lightgrey'
      },
      title: {
        text: 'Statistique des votes du boitier ' + '"<?php echo $num_serie;?>"' + ' des 7 derniers jours'
      },
      subtitle: {
        text: 'Pour plus de détails rendez-vous dans la rubrique résultats'
      },
      xAxis: {
        categories: [
          tab_jour[(numDay+7-6)%7],
          tab_jour[(numDay+7-5)%7],
          tab_jour[(numDay+7-4)%7],
          tab_jour[(numDay+7-3)%7],
          tab_jour[(numDay+7-2)%7],
          tab_jour[(numDay+7-1)%7],
          'Aujourd\'hui'
        ],
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Nombre de votes'
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      tooltip: {
        split: true,
        valueSuffix: ' votes'
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [{
        name: 'Satisfait',
        data: [<?php echo join(',', array_reverse($tab2)); ?>]
      }, {
        name: 'Moyennement satisfait',
        data: [<?php echo join(',', array_reverse($tab1)); ?>]

      }, {
        name: 'Insatisfait',
        data: [<?php echo join(',', array_reverse($tab0)); ?>]
      }]
    });
  });
<?php 
}
?>     
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
});
