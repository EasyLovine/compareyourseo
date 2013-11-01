<?php
function header_(){
    if(!empty($_SESSION['id_client'])){
        $homeLink = "/user/home";
        $headerMenu = '<li><a href="/user/home">Récapitulatif</a></li>
                        <li><a href="/user/gestion">Gestion</a></li>
                        <li><a href="/user/sites">Sites web</a></li>
                        <li><a href="/user/champs">Champs sémantiques</a></li>
                        <li><a href="/user/keywords">Mots clés</a></li>';
    }
    else{
        $homeLink = "/";
        $headerMenu = '<li><a href="#">Pourquoi se comparer?</a></li>
                        <li><a href="#">M&eacute;thode de calcul</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">CGU</a></li>
                        <li><a href="#">Qui sommes-nous</a></li>';
    }
 return '
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Compare my seo.net</title>
<link rel="shortcut icon" type="/static/image/png" href="favicon.png" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/static/css/style.css" />
<!--[if lte IE 7]> <link rel="stylesheet" href="/static/css/ie7.css" type="text/css" /> <![endif]-->
<!--[if lte IE 8]> <link rel="stylesheet" href="/static/css/ie8.css" type="text/css" /> <![endif]-->
</head>
<body>
<!-- Header -->
 <div class="header">
	<div class="header_top">
    	<div class="rapport"><span>1221 rapports soumis</span></div>
        <div class="connexion"><a href="/section/connexion" class="btn_connexion" title="Connexion">Connexion</a></div>
        <div class="langue">
        	<ul>
            	<li><a href="#" class="lang-fr" title="Fran&ccedil;ais"><img src="/static/images/fr-flag.png" height="11" width="16" alt="" /></a></li>
                <li><a href="#" class="lang-fr" title="English"><img src="/static/images/en-flag.png" height="11" width="16" alt="" /></a></li>
                <li class="clearfix">&nbsp;</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header_bottom clearfix">
    	<div class="logo">
        	<a href="'.$homeLink.'" title="Compare my seo.net"><img src="/static/images/logo.png" height="30" width="244" alt="Compare my seo.net" /></a>
        </div>
        <div class="nav-top">
        	<ul>'.
            $headerMenu
            .'</ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>';
}

function footer_(){
	return '
	<!-- Footer -->
	<div class="footer">
		<ul>
	    	<li><a href="#">Pourquoi se comparer?</a></li>
	        <li><a href="#">M&eacute;thode de calcul</a></li>
	        <li><a href="#">FAQ</a></li>
	        <li><a href="#">CGU</a></li>
	        <li><a href="#">Qui sommes-nous</a></li>
	   </ul>
	</div>
	</body>
	</html>';
}
?>