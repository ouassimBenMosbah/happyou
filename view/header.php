<html>
   <head>
        <title><?php echo $pagetitle; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
         <link href="assets/css/bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="assets/js/jquerry/jquery-ui.css">
         <link rel="stylesheet" href="assets/js/jquerry/jquery-ui.theme.css">
         <link rel="stylesheet" href="assets/js/jquerry/jquery-ui.structure.css">
         <link rel="stylesheet" href="assets/css/font-awesome-4.4.0/css/font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-3.3.4/dataTables.bootstrap.min.css">
         <link rel="icon" type="image/png" href="assets/img/favicon.jpg" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg" /><![endif]-->

         
    </head>
    <body>
        
      <div id="wrapper">
            
        <div id="sidebar-wrapper">
      
            <ul class="sidebar-nav">
                <li class="sidebar-title">
                        Menu
                </li>
                
                <?php
                if(!empty($_SESSION['login']))
                {
                            
                ?>
                    <li>
                        <a href="interface-home"><i class='fa fa-cubes'></i>Liste des boitiers</a>
                    </li>
                <?php
                            
                }
                ?>

                <?php   
                if(!empty($_SESSION['login']))
                {
                ?>
                    <li>
                        <a href="admin-modifProfil"><i class='fa fa-user'></i>Modifier son profil</a>
                    </li>
                <?php
                }
                ?>
                
                <?php   
                if(!empty($_SESSION['login']))
                {
                ?>
                    <li>
                        <a href="boitier-newBoitier"><i class='fa fa-cube'></i>Ajouter un boitier</a>
                    </li>
                <?php
                }
                ?>

                <?php   
                if(!empty($_SESSION['login']))
                {
                ?>
                    <li>
                        <a href="vote-resultatVote"><i class='fa fa-bar-chart'></i>Résultats</a>
                    </li>
                <?php
                }
                ?>
                
            </ul>
        </div>
          
    
        <div class="col-lg-12 bannier_menu">

            <div class="col-md-3 col-xs-6 col-header contener-login">
                <?php
                        if(!empty($_SESSION['login']))
                        {
                ?>
                    <a  class="linkSite" id="menu-toggle" href="#"><i class="fa fa-navicon" id='ico-menu'></i></a>
                <?php
                        }
                ?>
                
                <?php if(!empty($_SESSION['login']))
                        {
                            echo 'Bonjour, '.$_SESSION['login'];
                        }
                ?>
               
            </div>

            <div  class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-4 col-sm-4 col-xs-12 col-header hidden-sm hidden-xs">
                <?php if(!empty($_SESSION['login']))
                    {
                ?>
                        <a href='interface-home'>
                 <?php
                    }
                    else
                    {
                ?>
                        <a href='/boitier'>
                <?php
                    }
                ?>
                    <div id="logo-contener"></div>
                
                </a>
            </div>
            
            <div class="col-lg-4 col-md-4 col-xs-6 col-header contener-disconnect">
                
                <?php if(!empty($_SESSION['login']))
                        {
                ?>
                <a class="linkSite" href='interface-disconnect'> Se déconnecter </a>
                <?php
                        }
                ?>
                
            </div>
        </div>
        
        <div id="page-content-wrapper">
            <div class="page-content inset">
                <div class="row">
        
        