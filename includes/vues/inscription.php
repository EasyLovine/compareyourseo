<?php
require_once(realpath(dirname(__FILE__).'/../utils/htmls.php'));
echo header_();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="/static/js/form.js"></script>
<?php
	if(!$registered){
?>
<div class="register">
	<h1><span>Inscription</span></h1>
<?php
    echo '<form action="/inscription/'.$_GET['inscription'].'" method="post">';
?>
    	<div class="left_container">
    		<input type="text" value="Nom" title="Nom" name="nom"/>
     	    <input type="text" value="Adresse email" title="Adresse email" name ="mail"/>
     	    <input type="text" value="Mot de passe (7 caractères minimum)" class="pw" name ="mdp1"/>
        </div>
        <div class="right_container">
       		<input type="text" value="Prénom" title="Prénom" name ="prenom"/>
      	    <input type="text" value="Téléphone" title="Téléphone" name ="phone"/>
     	    <input type="text" value="Confirmation mot de passe" class="pw" name ="mdp2"/>
        </div>
        <div class="bottom_container">
       		<input type="submit" class="register-submit" value="Inscription" />
        	<p class="cgu">
      	    	<input type="checkbox" name="cgu" value="J'accepte les CGU"> J'accepte les CGU 
      	    </p>
        </div>
    </form>
</div>
<?php
	}
	else
		echo '<div class="mail_confirm">Un mail de confirmation vous a été envoyé ! </div>';
?>
<!-- Footer -->
<?php
    echo footer_();
?>
