<?php
    require_once(realpath(dirname(__FILE__).'/../utils/htmls.php'));
    echo header_();
?>
<!-- Champs semantiques et rappport -->
<div class="your-champ">
    <h1>Vos champs s&eacute;matiques et vos rapports</h1>
    <div class="clearfix"></div>
    <?php
    if(!empty($reports)){
        echo '<table class="champ-list" cellpadding="0" cellspacing="0">
        <tr>
            <th class="champ-name">Champs s&eacute;matiques</th>
            <th class="champ-last">Derni&egrave;re version du rapport</th>
            <th class="champ-pdf">Rapport</th>
        </tr>';
        foreach ($reports as $key => $value) {
            $infos = split("_", $key);
            echo '<tr>
                     <td class="champ-name">'.$infos[1].'</td>
                     <td class="champ-last">'.substr($infos[2], 0, -4).'</td>
                     <td class="champ-pdf"><a href="/download/'.$key.'" title="Rapport"><img src="/static/images/pdf-icon.jpg" width="20" height="25" alt="" /></a></td>
                </tr>';
        }
        echo '</table>';
    }
    else
        echo '<div class="empty-user-data"> Aucun rapport n\'a été généré pour le moment !</div>';
    ?>
</div>
<!-- Vos sites internets -->
<div class="your-site">
	<h1>Vos sites internet</h1>
    <div class="clearfix"></div>
    <?php
    if(!empty($sites)){
        echo '<table class="site-list" cellpadding="0" cellspacing="0">';
        foreach ($sites as $key => $value){
            echo 
           '<tr>
                <td class="site-name">'.$value->nom_site.'</td>
                <td class="site-link">
                    <a href="'.$value->url.'" title="'.$value->nom_site.'" target="_blank">'.$value->url.'</a>
                </td>
            </tr>';
        }
        echo '</table>';
    }
    else
        echo '<div class="empty-user-data">Vous ne gèrez aucun site pour le moment</div>';
    ?>
</div>
<?php
    echo footer_();
?>
