<?php

function promos_edit() {
    
    require_once('config-admin.php');
    require_once('utils/readFichierPromotions.php');
    require_once('utils/writeFichierPromotions.php');
        
    $toastState = 'toast-warning';
    $toastMessage = "La promotion n'a pas été modifiée";
    
    $url = $urlrentree.'config.php';
    $libellePromo = readFichierPromotions($url);
    
    

    // MODIFICATION DE LA PROMOTION

    if(!empty($_POST['libelle']) && !empty($_POST['nom']) && !empty($_POST['libelleoriginal']) && !empty($_POST['nomoriginal'])) {
        
        if(strstr($_POST['libelle'], "A1") || strstr($_POST['libelle'], "A2") || strstr($_POST['libelle'], "A3") || strstr($_POST['libelle'], "A4") || strstr($_POST['libelle'], "A5")) {
            // Transformation des caractères speciaux en héxa car
            // ils sont en héxa dans le fichier config.php

            $transformations = array("ᵉ" => "&#x1D49;", "ʳ" => "&#x02B3;", "\"" => "'");
            $_POST['libelle'] = strtr($_POST['libelle'], $transformations);
            $_POST['nom'] = strtr($_POST['nom'], $transformations);

            // on supprime l'ancienne clé/valeur

            $_POST['libelleoriginal'] = strtr($_POST['libelleoriginal'], $transformations);
            $_POST['nomoriginal'] = strtr($_POST['nomoriginal'], $transformations);
            unset($libellePromo[$_POST['nomoriginal']]);

            // On change le nom de la promotion pour les fichiers associès en base de donnée
            if($_POST['libelle'] != $_POST['libelleoriginal']) {
                $bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', ''.$dbuser.'',''.$dbpassword.'');
                 $update = $bdd->prepare("UPDATE document SET promo = :promo WHERE promo = :promooriginal");
                 $update->bindParam(':promo', $_POST['libelle'], PDO::PARAM_STR);
                 $update->bindParam(':promooriginal', $_POST['libelleoriginal'], PDO::PARAM_STR);   
                 $update->execute();
            }

            // On insére la nouvelle promotion ou la promotion modifiée
            $libellePromo[$_POST['nom']] = $_POST['libelle'];
            ksort($libellePromo); // Trie les éléments de la première à la dernière année
            
            writeFichierPromotions($url, $libellePromo);
            $toastState = 'toast-success';
            $toastMessage = "La promotion à été modifiée";
        }
    }
    
    set('libellePromo', $libellePromo);
    set('toast',  $toastMessage);
    set('toastStyle', $toastState);
    
    return render('promos.html.php' ,'layout/default_layout.php'); # rendering HTML view

}

?>