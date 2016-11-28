<?php

function promos_add() {
    
    require_once('config-admin.php');
    require_once('utils/readFichierPromotions.php');
    require_once('utils/writeFichierPromotions.php');
    
    $toastState = 'toast-warning';
    $toastMessage = "La promotion n'a pas été ajoutée";
    
    $url = $urlrentree.'config.php';
    $libellePromo = readFichierPromotions($url);

    // AJOUT OU MODIFICATION DE LA PROMOTION

    if(!empty($_POST['libelle']) && !empty($_POST['nom'])) {
        
        if(strstr($_POST['libelle'], "A1") || strstr($_POST['libelle'], "A2") || strstr($_POST['libelle'], "A3") || strstr($_POST['libelle'], "A4") || strstr($_POST['libelle'], "A5")) {
            
            // Transformation des caractères speciaux en héxa car
            // ils sont en héxa dans le fichier config.php
            
            $transformations = array("ᵉ" => "&#x1D49;", "ʳ" => "&#x02B3;", "\"" => "'");
            $_POST['libelle'] = strtr($_POST['libelle'], $transformations);
            $_POST['nom'] = strtr($_POST['nom'], $transformations);

            // On insére la nouvelle promotion
            $libellePromo[$_POST['nom']] = $_POST['libelle'];
            ksort($libellePromo); // Trie les éléments de la première à la dernière année

            writeFichierPromotions($url, $libellePromo);
            $toastState = 'toast-success';
            $toastMessage = "La promotion <b>".$_POST['libelle']."</b> a été ajoutée";
        } else {
            $toastMessage = "La promotion n'a pas été ajoutée.  <b>Le libellé doit contenir A suivi d'un chiffre</b>";
        }
    }
    
    set('libellePromo', $libellePromo);
    set('toast',  $toastMessage);
    set('toastStyle', $toastState);
    
    return render('promos.html.php' ,'layout/default_layout.php'); # rendering HTML view

}

?>