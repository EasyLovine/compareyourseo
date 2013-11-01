<?php
    include(realpath(dirname(__FILE__).'/../utils/htmls.php'));
    echo header_();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/static/js/user.js"></script>
<div class="your-champ">
    <h1>Gestion des sites web et des champs sémantiques</h1>
    <?php
    if(!empty($_GET['arg']))
    	echo '<button class="addSiteChamp">Lié à un champ sémantique</button>';
    if(!empty($sites)){
        echo '<p class="ponderation chooseSite">
              <label>Sites web</label>
              <select>
              <option id_site=""></option>';
      	foreach ($sites as $key => $value) {
      		if(!empty($_GET['arg']) && $value->id_site == $_GET['arg'])
      			echo '<option id_site="'.$value->id_site.'" selected>'.$value->nom_site.'</option>';
      		else
      			echo '<option id_site="'.$value->id_site.'">'.$value->nom_site.'</option>';
      		}
          echo '</select>
                </p>';
      }
      else
          echo '<div class="cl"></div><div class="empty-user-data">Vous ne gèrez aucun sites pour le moment !</div>';
     	if(!empty($_GET['arg'])){
            if(!empty($champs)){
	     		echo '<table class="champ-details" cellpadding="0" cellspacing="0">
	            <tr>
	                <th class="border_left_coin">Champ sémantique</th>
	                <th>Nombre de mots clés</th>
	                <th>Détails</th>
	                <th class="border_right_coin">Supprimer</th>
	            </tr>';
		        foreach($champs as $key => $value){
		                echo 
		               '<tr>
		                    <td class="important_data no_border">'.$value->nom_champ.'</td>
		                    <td>'.$value->nbExp.'</td>
                    <td class="center_data detailSiteChamp"><a href="/user/keywords/'.$value->id_champ.'" title="Details champ sémantique"><img src="/static/images/loupe-icon.png" width="17" height="17" alt="" /></a></td>
		                    <td class="center_data delSiteChamp"><a href="#" title="Supprimer" id_champ="'.$value->id_champ.'"><img src="/static/images/delete-icon.jpg" width="17" height="17" alt="" /></a></td>
		           		</tr>';
		         }
	            echo '</table>';
	       		}
       		else{
       			echo '<div class="empty-user-data">Aucun champ sémantique n\'est lier à ce site web !</div>';
       		}
     	}
     ?>
</div>
<div class="overlay-bg addSiteChamp">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Champ sémantique</h1>
        <p class="ponderation chooseSiteChamp">
          <label>Champs sémantiques</label>
          <select>
          </select>
        </p>
        <div class="empty-user-data">Vous n'avez plus aucun champs sémantique à lier</div>
        <button class="save-data gold_button">Ajouter le champ sémantique</button>
    </div>
</div>
<div class="overlay-bg delSiteChamp">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Suppression du champ sémantique <strong></strong> associé au site <strong></strong></h1>
        <button class="save-data gold_button">Supprimer</button>
    </div>
</div>
