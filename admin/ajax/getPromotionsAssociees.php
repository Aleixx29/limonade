<?php

require_once('../config-admin.php');
require_once('../utils/readFichierPromotions.php');

if(!empty($_POST['fichier'])) {
    
    $url = $urlrentree.'../config.php';
    $libellePromo = readFichierPromotions($url);

    $promosChecked = [];
    $promos = [];
    
    $select = $bdd->prepare("SELECT promo FROM document where fichier = :fichier");
    $select->bindParam(':fichier', $_POST['fichier'], PDO::PARAM_STR);   
    $select->execute();
    
    while($resultat = $select->fetch()) {
        array_push($promosChecked, $resultat['promo']);
    }
    
    $select->closeCursor();
    
    $numpromos = array("0","0","0");
    
    if(strstr($_POST['fichier'], "A12/")) {
        $numpromos[0] = "1";
        $numpromos[1] = "2";
    } else if(strstr($_POST['fichier'], "A345/")) {
        $numpromos[0] = "3";
        $numpromos[1] = "4";
        $numpromos[2] = "5";
    }
    
    $promosempty = true;
    
    foreach($libellePromo as $promo) {
        /*if(strstr($promo, $numpromos[0]) || strstr($promo, $numpromos[1]) || strstr($promo, $numpromos[2])) {*/
            if(in_array($promo, $promosChecked)) {
                $promos[$promo] = "checked";
                $promosempty = false;
            } else {
                $promos[$promo] = "";
            }
        /*}*/
    }
    
    if($promosempty) {
        $promos['TOUTES'] = 'checked';
    } else {
        $promos['TOUTES'] = "";
    }
    
    echo json_encode($promos);
}

?>