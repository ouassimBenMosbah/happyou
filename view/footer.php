            </div>
        </div>
    </div>    
</div>   
        <script src="assets/js/jquerry/jquery.js"></script>
        <script type="text/javascript" src="assets/js/jquerry/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/css/bootstrap-3.3.4/js/bootstrap.min.js"></script>
        <script src="assets/css/bootstrap-3.3.4/js/star-rating.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="assets/css/bootstrap-3.3.4/jquery.dataTables.min.js"></script>
	      <script type="text/javascript" language="javascript" src="assets/css/bootstrap-3.3.4/dataTables.bootstrap.min.js"></script>
        <script src="assets/css/datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/css/datepicker/locales/bootstrap-datepicker.fr.min.js"></script>
        <script src="assets/js/highcharts.js"></script>
        <script src="assets/js/highcharts-more.js"></script>
        <script src="assets/js/exporting.js"></script>
        
<script>

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
   
  /*-------------------------------------------------------------------------------------------------------------------*/
  <?php if($view=='details')
  {
  ?>
    Array.prototype.sum = function() {
    return this.reduce(function(a,b){return a+b;});
    } 

    var tab_jour = Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    var tab_mois = Array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    availableTagsLieu = [<?php echo $autocompleteLieu; ?>];
      
      $("#nomLieu").autocomplete({
          source: availableTagsLieu
      });
      
      
      availableTagsQuestion = [<?php  echo $autocompleteQuestion; ?>];
        
        
      $("#nomQuestion").autocomplete({
          source: availableTagsQuestion
      });

      var ladate = new Date();
      var numDay = ladate.getDay();
      var numMois = ladate.getMonth();
      var numH = ladate.getHours();
  /*-------------------------------------------------------------------------------------------------------------------*/
      $(function () {
        $('#chart-M').highcharts({
            title: {
                text: 'Statistique des votes du boitier ' + '"<?php echo $num_serie;?>"' + ' de la dernière année'
            },
            subtitle: {
                text: 'Pour plus de détails rendez-vous dans la rubrique résultats'
            },
            xAxis: {
                categories: [
                    tab_mois[(numMois+12-11)%12],
                    tab_mois[(numMois+12-10)%12],
                    tab_mois[(numMois+12-9)%12],
                    tab_mois[(numMois+12-8)%12],
                    tab_mois[(numMois+12-7)%12],
                    tab_mois[(numMois+12-6)%12],
                    tab_mois[(numMois+12-5)%12],
                    tab_mois[(numMois+12-4)%12],
                    tab_mois[(numMois+12-3)%12],
                    tab_mois[(numMois+12-2)%12],
                    tab_mois[(numMois+12-1)%12],
                    tab_mois[(numMois+12-0)%12]
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
                    pointPadding: 0.1,
                    borderWidth: 1
                }
            },
            chart: {
              type: 'column',
              backgroundColor: "white",
              zoomType: 'x'
            },
            series: [{
              name: 'Satisfait',
              data: [<?php echo join(',', array_reverse($tabM2)); ?>],
              color: '#11B206'

            }, {
              name: 'Moyennement satisfait',
              data: [<?php echo join(',', array_reverse($tabM1)); ?>],
              color: '#EDED41'

            }, {
              name: 'Insatisfait',
              data: [<?php echo join(',', array_reverse($tabM0)); ?>],
              color: '#ff0000'
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
        $('#chart-J').highcharts({
            title: {
                text: 'Statistique des votes du boitier ' + '"<?php echo $num_serie;?>"' + ' des 10 derniers jours'
            },
            subtitle: {
                text: 'Pour plus de détails rendez-vous dans la rubrique résultats'
            },
            xAxis: {
                categories: [
                    tab_jour[(numDay+7-2)%7],
                    tab_jour[(numDay+7-1)%7],
                    tab_jour[(numDay+7-0)%7],
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
                    pointPadding: 0.1,
                    borderWidth: 1
                }
            },
            chart: {
              type: 'column',
              backgroundColor: "white",
              zoomType: 'x'
            },
            series: [{
              name: 'Satisfait',
              data: [<?php echo join(',', array_reverse($tabJ2)); ?>],
              color: '#11B206'

            }, {
              name: 'Moyennement satisfait',
              data: [<?php echo join(',', array_reverse($tabJ1)); ?>],
              color: '#EDED41'

            }, {
              name: 'Insatisfait',
              data: [<?php echo join(',', array_reverse($tabJ0)); ?>],
              color: '#ff0000'
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
          $('#chart-H').highcharts({
            title: {
                text: 'Statistique des votes du boitier ' + '"<?php echo $num_serie;?>"' + ' des 12 dernières heures'
            },
            subtitle: {
                text: 'Pour plus de détails rendez-vous dans la rubrique résultats'
            },
            xAxis: {
                categories: [
                    ((numH+24-11)%24).toString() + 'h',
                    ((numH+24-10)%24).toString() + 'h',
                    ((numH+24-9)%24).toString() + 'h',
                    ((numH+24-8)%24).toString() + 'h',
                    ((numH+24-7)%24).toString() + 'h',
                    ((numH+24-6)%24).toString() + 'h',
                    ((numH+24-5)%24).toString() + 'h',
                    ((numH+24-4)%24).toString() + 'h',
                    ((numH+24-3)%24).toString() + 'h',
                    ((numH+24-2)%24).toString() + 'h',
                    ((numH+24-1)%24).toString() + 'h',
                    ((numH+24-0)%24).toString() + 'h'
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
                    pointPadding: 0.1,
                    borderWidth: 1
                }
            },
            chart: {
              type: 'column',
              backgroundColor: "white",
              zoomType: 'x'
            },
            series: [{
              name: 'Satisfait',
              data: [<?php echo join(',', array_reverse($tabH2)); ?>],
              color: '#11B206'

            }, {
              name: 'Moyennement satisfait',
              data: [<?php echo join(',', array_reverse($tabH1)); ?>],
              color: '#EDED41'

            }, {
              name: 'Insatisfait',
              data: [<?php echo join(',', array_reverse($tabH0)); ?>],
              color: '#ff0000'
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
          $('#pie-M').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Diagramme circulaire'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      },
                      connectorColor: 'silver'
                  }
              }
          },
          series: [{
              name: 'Votes',
              data: [
                  { name: 'Insatisfait', y: [<?php echo join(',', array_reverse($tabM0)); ?>].sum(),
                    color: '#ff0000'},
                    { name: 'Moyennement', y: [<?php echo join(',', array_reverse($tabM1)); ?>].sum(),
                    color: '#EDED41' },
                  {
                      name: 'Satisfait',
                      y: [<?php echo join(',', array_reverse($tabM2)); ?>].sum(),
                      sliced: true,
                      selected: true,
                      color: '#11B206'
                  }
              ]
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
          $('#pie-J').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Diagramme circulaire'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      },
                      connectorColor: 'silver'
                  }
              }
          },
          series: [{
              name: 'Votes',
              data: [
                  { name: 'Insatisfait', y: [<?php echo join(',', array_reverse($tabJ0)); ?>].sum(),
                    color: '#ff0000'},
                    { name: 'Moyennement', y: [<?php echo join(',', array_reverse($tabJ1)); ?>].sum(),
                    color: '#EDED41' },
                  {
                      name: 'Satisfait',
                      y: [<?php echo join(',', array_reverse($tabJ2)); ?>].sum(),
                      sliced: true,
                      selected: true,
                      color: '#11B206'
                  }
              ]
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
          $('#pie-H').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Diagramme circulaire'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      },
                      connectorColor: 'silver'
                  }
              }
          },
          series: [{
              name: 'Votes',
              data: [
                  { name: 'Insatisfait', y: [<?php echo join(',', array_reverse($tabH0)); ?>].sum(),
                    color: '#ff0000'},
                    { name: 'Moyennement', y: [<?php echo join(',', array_reverse($tabH1)); ?>].sum(),
                    color: '#EDED41' },
                  {
                      name: 'Satisfait',
                      y: [<?php echo join(',', array_reverse($tabH2)); ?>].sum(),
                      sliced: true,
                      selected: true,
                      color: '#11B206'
                  }
              ]
            }]
          });

        });
  /*-------------------------------------------------------------------------------------------------------------------*/
        $(document).ready(function(){
          $("#showm").click(function(){
              $("#chart-J").hide();
              $("#chart-H").hide();
              $("#chart-M").show();
              $("#pie-J").hide();
              $("#pie-H").hide();
              $("#pie-M").show();
              window.scrollTo(0,document.body.scrollHeight);
          });
          $("#showj").click(function(){
              $("#chart-J").show();
              $("#chart-H").hide();
              $("#chart-M").hide();
              $("#pie-J").show();
              $("#pie-H").hide();
              $("#pie-M").hide();
              window.scrollTo(0,document.body.scrollHeight);
          });
          $("#showh").click(function(){
              $("#chart-J").hide();
              $("#chart-H").show();
              $("#chart-M").hide();
              $("#pie-H").show();
              $("#pie-J").hide();
              $("#pie-M").hide();
              window.scrollTo(0,document.body.scrollHeight);
          });
        });

  <?php 
  }
  ?>
  /*-------------------------------------------------------------------------------------------------------------------*/
  <?php if($view=='resultatVote')
  {
  ?>
    Array.prototype.sum = function() {
    return this.reduce(function(a,b){return a+b;});
    }

    var tab_jour = Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    var tab_mois = Array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    var ladate = new Date();
    var numDay = ladate.getDay();
    var numMois = ladate.getMonth();
    var numH = ladate.getHours();
  /*-------------------------------------------------------------------------------------------------------------------*/
    $(function () {
      $('#chart-M-glob').highcharts({
            title: {
                text: 'Statistique des votes de la dernière année'
            },
            xAxis: {
                categories: [
                    tab_mois[(numMois+12-11)%12],
                    tab_mois[(numMois+12-10)%12],
                    tab_mois[(numMois+12-9)%12],
                    tab_mois[(numMois+12-8)%12],
                    tab_mois[(numMois+12-7)%12],
                    tab_mois[(numMois+12-6)%12],
                    tab_mois[(numMois+12-5)%12],
                    tab_mois[(numMois+12-4)%12],
                    tab_mois[(numMois+12-3)%12],
                    tab_mois[(numMois+12-2)%12],
                    tab_mois[(numMois+12-1)%12],
                    tab_mois[(numMois+12-0)%12]
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
                    pointPadding: 0.1,
                    borderWidth: 1
                }
            },
            chart: {
              type: 'column',
              backgroundColor: "white",
              zoomType: 'x'
            },
            series: [{
              name: 'Satisfait',
              data: [<?php echo join(',', array_reverse($tabM2)); ?>],
              color: '#11B206'

            }, {
              name: 'Moyennement satisfait',
              data: [<?php echo join(',', array_reverse($tabM1)); ?>],
              color: '#EDED41'

            }, {
              name: 'Insatisfait',
              data: [<?php echo join(',', array_reverse($tabM0)); ?>],
              color: '#ff0000'
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
        $('#chart-J-glob').highcharts({
            title: {
                text: 'Statistique des votes des boitiers des 10 derniers jours'
            },
            xAxis: {
                categories: [
                    tab_jour[(numDay+7-2)%7],
                    tab_jour[(numDay+7-1)%7],
                    tab_jour[(numDay+7-0)%7],
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
                    pointPadding: 0.1,
                    borderWidth: 1
                }
            },
            chart: {
              type: 'column',
              backgroundColor: "white",
              zoomType: 'x'
            },
            series: [{
              name: 'Satisfait',
              data: [<?php echo join(',', array_reverse($tabJ2)); ?>],
              color: '#11B206'

            }, {
              name: 'Moyennement satisfait',
              data: [<?php echo join(',', array_reverse($tabJ1)); ?>],
              color: '#EDED41'

            }, {
              name: 'Insatisfait',
              data: [<?php echo join(',', array_reverse($tabJ0)); ?>],
              color: '#ff0000'
            }]
          });

  /*-------------------------------------------------------------------------------------------------------------------*/
          $('#chart-H-glob').highcharts({
            title: {
                text: 'Statistique des votes des boitiers des 12 dernières heures'
            },
            xAxis: {
                categories: [
                    ((numH+24-11)%24).toString() + 'h',
                    ((numH+24-10)%24).toString() + 'h',
                    ((numH+24-9)%24).toString() + 'h',
                    ((numH+24-8)%24).toString() + 'h',
                    ((numH+24-7)%24).toString() + 'h',
                    ((numH+24-6)%24).toString() + 'h',
                    ((numH+24-5)%24).toString() + 'h',
                    ((numH+24-4)%24).toString() + 'h',
                    ((numH+24-3)%24).toString() + 'h',
                    ((numH+24-2)%24).toString() + 'h',
                    ((numH+24-1)%24).toString() + 'h',
                    ((numH+24-0)%24).toString() + 'h'
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
                    pointPadding: 0.1,
                    borderWidth: 1
                }
            },
            chart: {
              type: 'column',
              backgroundColor: "white",
              zoomType: 'x'
            },
            series: [{
              name: 'Satisfait',
              data: [<?php echo join(',', array_reverse($tabH2)); ?>],
              color: '#11B206'

            }, {
              name: 'Moyennement satisfait',
              data: [<?php echo join(',', array_reverse($tabH1)); ?>],
              color: '#EDED41'

            }, {
              name: 'Insatisfait',
              data: [<?php echo join(',', array_reverse($tabH0)); ?>],
              color: '#ff0000'
            }]
          });
  /*-------------------------------------------------------------------------------------------------------------------*/
        Highcharts.chart('top-satisf', {
          chart: {
              type: 'bar'
          },
          title: {
              text: 'Classement des boitiers par taux de satisfaction'
          },
          xAxis: {
              categories: [<?php echo join(',', $boitier_top_satisf); ?>],
              title: {
                  text: null
              }
          },
          yAxis: {
              min: 0,
              title: {
                  text: '% satisfaction',
                  align: 'high'
              },
              labels: {
                  overflow: 'justify'
              }
          },
          tooltip: {
              valueSuffix: ' % des votes'
          },
          plotOptions: {
              bar: {
                  dataLabels: {
                      enabled: true
                  },
                  colorByPoint: true
              }
          },
          colors: [
            '#008000', 
            '#006600', 
            '#004700', 
            '#003800', 
            '#002700'
          ],
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'top',
              x: -40,
              y: 80,
              floating: true,
              borderWidth: 1,
              backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              shadow: true
          },
          credits: {
              enabled: false
          },
          series: [{
            showInLegend: false, 
              name: 'Satisfaction',
              data: [<?php echo join(',', $nb_top_satisf); ?>]
          }]
      });
  /*-------------------------------------------------------------------------------------------------------------------*/
        Highcharts.chart('top-insatisf', {
          chart: {
              type: 'bar'
          },
          title: {
              text: 'Classement des boitiers par taux d\'insatisfaction'
          },
          xAxis: {
              categories: [<?php echo join(',', $boitier_top_insatisf); ?>],
              title: {
                  text: null
              }
          },
          yAxis: {
              min: 0,
              title: {
                  text: '% insatisfaction',
                  align: 'high'
              },
              labels: {
                  overflow: 'justify'
              }
          },
          tooltip: {
              valueSuffix: ' % des votes'
          },
          colors: [
            '#FF0000', 
            '#B70000', 
            '#920000', 
            '#740000', 
            '#5C0000'
          ],
          plotOptions: {
              bar: {
                  dataLabels: {
                      enabled: true
                  },
                  colorByPoint: true
              },
              series:{
                allowPointSelect: false
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'top',
              x: -40,
              y: 80,
              floating: true,
              borderWidth: 1,
              backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
              shadow: true
          },
          credits: {
              enabled: false
          },
          series: [{
            showInLegend: false, 
              name: 'Insatisfaction',
              data: [<?php echo join(',', $nb_top_insatisf); ?>]
          }]
      });
  /*-------------------------------------------------------------------------------------------------------------------*/

        Highcharts.chart('jauge-global', {

          chart: {
              type: 'gauge',
              plotBackgroundColor: null,
              plotBackgroundImage: null,
              plotBorderWidth: 0,
              plotShadow: false
          },

          title: {
              text: 'Jauge de satisfaction globale'
          },
          subtitle: {
              text: 'Pour le dernier mois'
          },
          pane: {
              startAngle: -150,
              endAngle: 150,
              background: [{
                  backgroundColor: {
                      linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                      stops: [
                          [0, '#FFF'],
                          [1, '#333']
                      ]
                  },
                  borderWidth: 0,
                  outerRadius: '109%'
              }, {
                  backgroundColor: {
                      linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                      stops: [
                          [0, '#333'],
                          [1, '#FFF']
                      ]
                  },
                  borderWidth: 1,
                  outerRadius: '107%'
              }, {
                  // default background
              }, {
                  backgroundColor: '#DDD',
                  borderWidth: 0,
                  outerRadius: '105%',
                  innerRadius: '103%'
              }]
          },

          // the value axis
          yAxis: {
              min: 0,
              max: 100,

              minorTickInterval: 'auto',
              minorTickWidth: 1,
              minorTickLength: 10,
              minorTickPosition: 'inside',
              minorTickColor: '#666',

              tickPixelInterval: 30,
              tickWidth: 2,
              tickPosition: 'inside',
              tickLength: 10,
              tickColor: '#666',
              labels: {
                  step: 2,
                  rotation: 'auto'
              },
              title: {
                  text: '%'
              },
              plotBands: [{
                  from: 0,
                  to: 25,
                  color: '#DF5353' // red
              }, {
                  from: 25,
                  to: 60,
                  color: '#DDDF0D' // yellow
              }, {
                  from: 60,
                  to: 100,
                  color: '#55BF3B' // green
              }]
          },

          series: [{
              name: 'Taux de satisfaction',
              data: [<?php 
              if($nb_total[0]!=0){
                echo number_format((float)(($nb_satisfait[0] / $nb_total[0]) * 100), 2, '.', '');
              }
              else{
                echo '0';
              }?>
              ],
              color: 'green',
              tooltip: {
                  valueSuffix: ' %'
              }
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

</script>
  </body>    
</html>