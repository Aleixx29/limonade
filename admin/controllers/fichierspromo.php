<?php

function fichierspromo() { 
    
    require_once('config-admin.php');
    require_once('utils/readFichierPromotions.php');

    $url = $urlrentree.'config.php';
    $libellePromo = readFichierPromotions($url);
    
    if($promo = params('promo')) {
        
        if($promo == "communs") {
            $promo = "";
        }
        
        $reponse = $bdd->query('SELECT * FROM document WHERE LOWER(promo) = LOWER("'.$promo.'") ORDER BY rang');
        $count = $bdd->query('SELECT * FROM document WHERE LOWER(promo) = LOWER("'.$promo.'") ORDER BY rang');
        
        set('promo', $promo);
        set('libellePromo', $libellePromo);
        set('tabReponse', $reponse);
        set('count', $count);
        
        return render('fichiersdetail.html.php' ,'layout/default_layout.php'); # rendering HTML view
    } else {
        halt(NOT_FOUND, "This post doesn't exists"); # raises error / renders an error page
    }
    
}

?>