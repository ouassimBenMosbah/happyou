<div class="col-lg-12 background-auto">
    
    
    <div class="col-xs-offset-3 col-xs-6" id="contener-form-admin">
        <?php
           if($change_success)
           {
        ?>
            <div class='msg-succes'>Identifiants de connexion modifiés avec succés</div>
        <?php
           }
        ?>
        <div class="header-form">

            Modifier votre profil
            
        </div>
        <form action='index.php' method='post'>
            <input type="hidden" value="modifiedAdmin" name='action' >
            <input type="hidden" value="admin" name='controller' >
            
            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">
                <div class="group">   
                    <input type="text" name='login' value="<?php echo $_SESSION['login']?>" id="login" autofocus required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>login</label>
                </div>
            </div>
                
            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">
                <div class="group">   
                    <input type="password" name='mdp' required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Mot de passe</label>
                </div>
            </div>    
           
            <div class="col-sm-10 col-sm-offset-2 col-xs-11 col-xs-offset-1">   
                <button type='submit' class="button-form" id="button-new-admin">
                    Modifier
                </button>
            </div>
    </div>
                
    </form>
    
</div>