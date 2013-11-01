<?php
    include(realpath(dirname(__FILE__).'/../utils/htmls.php'));
    echo header_();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/static/js/user.js"></script>
<div class="your-site">
    <h1>Vos mots clés</h1>
    <?php
    if(!empty($_GET['arg']))
    	echo '<button class="addKeyword">Ajouter un mot clé</button>';
    ?>
    <p class="ponderation chooseChamp">
	<label>Champs sémantiques</label>
      	<select>
      		<option id_champ=""></option>
      		<?php
      			foreach ($champs as $key => $value) {
      				if($value->id_champ == $_GET['arg'])
      					echo '<option id_champ="'.$value->id_champ.'" selected>'.$value->nom_champ.'</option>';
      				else
      					echo '<option id_champ="'.$value->id_champ.'">'.$value->nom_champ.'</option>';
      			}
      		?>
        </select>
     </p>
     <?php
     	if(!empty($_GET['arg'])){
            if(!empty($keywords)){
	     		echo '<table class="champ-details" cellpadding="0" cellspacing="0">
	            <tr>
	                <th class="border_left_coin">Mots clés</th>
	                <th>Ponderation</th>
	                <th>Editer</th>
	                <th class="border_right_coin">Supprimer</th>
	            </tr>';
		        foreach($keywords as $key => $value){
		                echo 
		               '<tr>
		                    <td class="important_data no_border">'.$value->contenu_expression.'</td>
		                    <td>'.$value->ponderation.'</td>
		                    <td class="center_data editKeyword"><a href="#" title="Modifier" id_expression="'.$value->id_expression.'"><img src="/static/images/edit-icon.jpg" width="17" height="17" alt="" /></a></td>
		                    <td class="center_data delKeyword"><a href="#" title="Supprimer" id_expression="'.$value->id_expression.'"><img src="/static/images/delete-icon.jpg" width="17" height="17" alt="" /></a></td>
		           		</tr>';
		         }
	            echo '</table>';
	       		}
       		else{
       			echo '<div class="empty-user-data">Aucun mot clés associé à ce champ sémantique</div>';
       		}
     	}
     ?>
</div>
<div class="overlay-bg addKeyword">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Ajouter un mot clé</h1>
        <input type="text" class="data_input" value="mot clé" title="mot clé" name="keywordName">
        <p class="pond">
                    <label>Pondération</label>
                    <span>
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                    </select>
                    </span>
        </p>
        <button class="save-data gold_button">Enregistrer le mot clé</button>
    </div>
</div>
<div class="overlay-bg editKeyword">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Edition du mot clé <strong></strong></h1>
        <input type="text" class="data_input" value="" name="keywordName">
        <p class="pond">
                    <label>Pondération</label>
                    <span>
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                    </select>
                    </span>
        </p>
        <button class="save-data gold_button">Enregistrer les modifications</button>
    </div>
</div>
<div class="overlay-bg delKeyword">
    <div class="overlay-content">
		<span class="close_overlay"></span>
        <h1 class="blue_h1">Suppression du mot clé <strong></strong></h1>
        <button class="save-data gold_button">Supprimer</button>
    </div>
</div>
