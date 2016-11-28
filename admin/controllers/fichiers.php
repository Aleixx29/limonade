<?php

function fichiers() {
    
    require_once('config-admin.php');
    require_once('utils/readFichierPromotions.php');
    
    $url = $urlrentree.'config.php';
    $libellePromo = readFichierPromotions($url);
    $files = $bdd->query('SELECT fichier, libelle FROM document GROUP BY fichier');
    
    set('url', $urlrentree);
    set('files', $files);
    set('libellePromo', $libellePromo);
    return render('fichiers.html.php' ,'layout/default_layout.php'); # rendering HTML view
}

?>