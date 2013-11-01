<?php 
include(realpath(dirname(__FILE__).'/../utils/htmls.php'));
echo header_();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/static/js/site.js"></script>
<!-- Selecteur -->
<!-- Pricing -->
<h1 class="headline logo_vroom">Etes-vous meilleur que vos concurrents ?</h1>
<div class="pricing-bloc">
	<h3 class="pricing-title">Choisissez votre niveau de service</h3>
    <div class="offre">
    	<div class="freeware">
        	<h4>Freeware</h4>
            <span>Service gratuit</span>
            <p>Jusqu&acute;&agrave; 3 champs s&eacute;mantiques</p>
            <p>Jusqu&acute;&agrave; 10 expressions par champ s&eacute;mantique</p>
            <p>Suivi de la performance dans le temps</p>
            <p>Emails automatiques mensuels</p>
            <form action="/inscription/freeware" method="POST">
                <button>Essayer</button>
            </form>
        </div>
        <div class="premium">
        	<h4>Premium</h4>
            <div class="premium-label"><strong>19&euro;</strong><br /><span>HT 12 mois</span></div>
            <p>Jusqu&acute;&agrave; <strong>30 champs s&eacute;mantiques</strong></p>
            <p>Jusqu&acute;&agrave; <strong>500 expressions</strong> par champ s&eacute;mantique</p>
            <p>Suivi de la <strong>performance dans le temps</strong></p>
            <p>Emails automatiques mensuels</p>
            <form action="/inscription/premium" method="POST">
                <button>Choisir</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>    
</div>
<?php
    echo footer_();
?>
