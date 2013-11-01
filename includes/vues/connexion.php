<?php
require_once(realpath(dirname(__FILE__).'/../utils/htmls.php'));
echo header_();
if($displayError)
    echo '<div class="login-error">Identifiants Incorrect !</div>';
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/static/js/site.js"></script>
<div class="login-box">
	<h1><span>Connexion</span></h1>
    <form class="login-member" action="/section/connexion" method="post">
    	<input type="text" value="Adresse email" name="email"/>
        <input type="text" value="Mot de passe" name ="pw"/>
        <input type="submit" class="login-submit" value="Connexion" />
    </form>
</div>
<!-- Footer -->
<?php
    echo footer_();
?>