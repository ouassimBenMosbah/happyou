
<div class="col-lg-12 background-100" id="fond-connect">
    <div id="contener-connect">
        
        <div class="col-lg-6 col-lg-offset-1 col-form-connect">
            
            <hr class="col-lg-8 col-lg-offset-2">

            <div class="col-lg-12 text-connect" id="title-connect">Bienvenue</div>
            
            <div class="col-lg-12 text-connect" id="pres-connect">À partir de maintenant chers clients, vous pouvez connaitre l'avis de vos clients en un clic.</div>
            
            
            
            <div class="col-lg-6 col-sm-6 col-xs-12 contener-contact">
                <div class="col-lg-12 col-sm-12 col-xs-12 title-contact">Contactez-nous <hr></div>
                
                <div class="col-lg-offset-0 col-lg-3 col-sm-offset-2 col-sm-2 col-xs-2 ico-mail"></div>
                
                <div class="col-lg-9 col-sm-8 col-xs-8">wassimbenmosbah@gmail.com</div>
               
            </div>
            
            <div class="col-lg-6 col-sm-6 col-xs-12 contener-contact">
                <div class="col-lg-12 col-sm-12 title-contact">Appelez nous<hr></div>
                
                <div class="col-lg-offset-1 col-lg-3 col-sm-offset-2 col-sm-2 ico-phone"></div>
                
                <div class="col-lg-8 col-sm-4">55 09 01 94</div>
                
            </div>
            
        </div>
       
        
        <div class="col-lg-offset-0 col-lg-3 col-lg-offset-1 col-sm-offset-4 col-sm-4 col-form-lg-connect col-form-sm-connect" id="contener-form-connect">
            <div id="header-form-connect" class="header-form">Connectez-vous</div>
            
             <form action='index' method='post'>
                
                <input type="hidden" value="connected" name='action' >
                <input type="hidden" value="interface" name='controller' >
                
                <?php
                   if($erreurIn)
                   {
                ?>
                    <div class='msgErreur'>Erreur sur l'identifiant ou le mot de passe</div>
                <?php
                   }
                ?>
                
                
                <div class="col-lg-9 col-lg-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="group" id="firstgroup">      
                        <input type="text" name='login' required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Identifiant</label>
                    </div>
                </div>
                
                
                <div class="col-lg-9 col-lg-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="group">   
                        <input type="password" name='mdp' required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Mot de passe</label>
                    </div>
                </div>
                
                
                <div class="col-lg-9 col-lg-offset-2 col-sm-10 col-sm-offset-2">
                    <button type='submit' class="button-form" id="button-connect">Connexion</button>
                </div>
                <div class="col-lg-3 col-sm-6"></div>
            
            </form>
          
        </div>
       
        <div class="footer col-xs-12">
        </div>
    </div>
</div>

