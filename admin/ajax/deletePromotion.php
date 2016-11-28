<?php

    require_once('../config-admin.php');
    require_once('../utils/readFichierPromotions.php');
    require_once('../utils/writeFichierPromotions.php');

    $url = $urlrentree.'../config.php';
    $libellePromo = readFichierPromotions($url);

    // SUPPRESSION DE LA PROMOTION

    if(!empty($_POST['nom']) && !empty($_POST['libelle'])) {
        
        // Transformation des caractères speciaux en héxa car
        // ils sont en héxa dans le fichier config.php
        
        $transformations = array("ᵉ" => "&#x1D49;", "ʳ" => "&#x02B3;");
        $_POST['nom'] = strtr($_POST['nom'], $transformations);
        $_POST['libelle'] = strtr($_POST['libelle'], $transformations);
        
        // Si la clé existe, la promotion est retirée du tableau 

        unset($libellePromo[$_POST['nom']]);
        
        // On supprime également les fichiers associés dans la base de donnée
        
        $delete = $bdd->prepare("DELETE FROM document WHERE promo =  :promo");
        $delete->bindParam(':promo', $_POST['libelle'], PDO::PARAM_STR);   
        $delete->execute();
        
        writeFichierPromotions($url, $libellePromo);
    }

?>