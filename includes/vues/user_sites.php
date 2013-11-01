<?php
    include(realpath(dirname(__FILE__).'/../utils/htmls.php'));
    echo header_();
?>
<!-- Vos sites internets -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/static/js/user.js"></script>
<div class="your-site">
	<h1>Vos sites internet</h1>
    <button class="add-site addSite">Ajouter un site internet</button>
    <div class="clearfix"></div>
    <?php
        if(!empty($sites)){
            echo '<table class="site-details" cellpadding="0" cellspacing="0">
            <tr>
                <th class="border_left_coin">Nom site</th>
                <th>URL</th>
                <th>Champs sémantiques associés</th>
                <th>Détails</th>
                <th>Editer</th>
                <th class="border_right_coin">Supprimer</th>
            </tr>';
            foreach($sites as $key => $value){
                echo 
               '<tr>
                    <td class="important_data no_border">'.$value->nom_site.'</td>
                    <td class="underline_data">
                        <a href="'.$value->url.'" title="'.$value->nom_site.'" target="_blank">'.$value->url.'</a>
                    </td>
                    <td>'.$value->nbChamp.'</td>
                    <td class="center_data detailSite"><a href="/user/gestion/'.$value->id_site.'" title="Details" id_site="'.$value->id_site.'"><img src="/static/images/loupe-icon.png" width="17" height="17" alt="" /></a></td>
                    <td class="center_data editSite"><a href="#" title="Modifier" id_site="'.$value->id_site.'"><img src="/static/images/edit-icon.jpg" width="17" height="17" alt="" /></a></td>
                    <td class="center_data delSite"><a href="#" title="Supprimer" id_site="'.$value->id_site.'"><img src="/static/images/delete-icon.jpg" width="17" height="17" alt="" /></a></td>
                </tr>';
            }
            echo '</table>';
        }
        else
            echo '<div class="empty-user-data">Vous ne gèrez aucun site pour le moment</div>';
    ?>
</div>
<div class="overlay-bg addSite">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Ajouter un site web</h1>
        <input type="text" class="data_input" value="Nom du site web" title="Nom du site web" name="siteName">
        <input type="text" class="data_input" value="URL du site web avec (http://)" title="URL du site web avec (http://)" name="url">
        <button class="save-data gold_button">Enregistrer</button>
    </div>
</div>
<div class="overlay-bg delSite">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Suppression du site <strong></strong></h1>
        <button class="save-data gold_button">Supprimer</button>
    </div>
</div>

<div class="overlay-bg editSite">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Edition du site <strong></strong></h1>
        <input type="text" class="data_input" value="Nom du site web" title="Nom du site web" name="siteName">
        <input type="text" class="data_input" value="URL du site web" title="URL du site web" name="url">
        <button class="save-data gold_button">Enregistrer les modifications</button>
    </div>
</div>
<?php
    echo footer_();
?>
