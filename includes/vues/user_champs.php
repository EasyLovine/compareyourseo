<?php
    include(realpath(dirname(__FILE__).'/../utils/htmls.php'));
    echo header_();
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/static/js/user.js"></script>
<div class="your-champ">
    <h1>Vos champs sémantiques</h1>
    <button class="add-champ">Ajouter un champ sémantique</button>
    <div class="clearfix"></div>
    <?php
        if(!empty($champs)){
            echo '<table class="champ-details" cellpadding="0" cellspacing="0">
            <tr>
                <th class="border_left_coin">Nom champ</th>
                <th>Mots clés associés</th>
                <th>Détails</th>
                <th>Editer</th>
                <th class="border_right_coin">Supprimer</th>
            </tr>';
            foreach($champs as $key => $value){
                echo 
               '<tr>
                    <td class="important_data no_border">'.$value->nom_champ.'</td>
                    <td>'.$value->nbExp.'</td>
                    <td class="center_data detailChamp"><a href="/user/keywords/'.$value->id_champ.'" title="Details mots clés"><img src="/static/images/loupe-icon.png" width="17" height="17" alt="" /></a></td>
                    <td class="center_data editChamp"><a href="#" title="Modifier" id_champ="'.$value->id_champ.'"><img src="/static/images/edit-icon.jpg" width="17" height="17" alt="" /></a></td>
                    <td class="center_data delChamp"><a href="#" title="Supprimer" id_champ="'.$value->id_champ.'"><img src="/static/images/delete-icon.jpg" width="17" height="17" alt="" /></a></td>
                </tr>';
            }
            echo '</table>';
        }
        else
            echo '<div class="empty-user-data">Vous n\'avez aucun champ sémantique pour le moment</div>';
    ?>
</div>
<div class="overlay-bg addChamp">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Ajouter un champ sémantique</h1>
        <input type="text" class="data_input" value="Nom champ sémantique" title="Nom champ sémantique" name="champName">
        <button class="save-data gold_button">Enregistrer le champ</button>
    </div>
</div>
<div class="overlay-bg editChamp">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Edition du champ sémantique</h1>
        <input type="text" class="data_input" value="" name="champName">
        <button class="save-data gold_button">Enregistrer le mot clé</button>
    </div>
</div>

<div class="overlay-bg delChamp">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Suppression du champ <strong></strong></h1>
        <button class="save-data gold_button">Supprimer</button>
    </div>
</div>
<?php
    echo footer_();
?>
