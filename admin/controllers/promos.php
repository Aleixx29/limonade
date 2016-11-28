<?php

function promos() {
    
    require_once('config-admin.php');
    require_once('utils/readFichierPromotions.php');
    
    $url = $urlrentree.'config.php';
    $libellePromo = readFichierPromotions($url); 
    set('libellePromo', $libellePromo);
    
    return render('promos.html.php' ,'layout/default_layout.php'); # rendering HTML view
}
?>