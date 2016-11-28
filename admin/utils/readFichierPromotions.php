<?php

    /*PERMET DE LIRE LE CONTENU DU FICHIER CONTENANT LA LISTE DES PROMOTIONS DANS L'APPLICATION RENTREE*/
    /*CREE UN TABLEAU ASSOCIATIF libellePromo*/

    function readFichierPromotions($url) {
        
        $fichierPromosContent0 = file_get_contents($url);
        $tabContent0 = explode('$libellePromo = array (', $fichierPromosContent0);
        $content1 = $tabContent0[1];
        $tabContent1 = explode(');', $content1);
        $content2 = $tabContent1[0];
        $tabContent2 = explode('"', $content2);
        $tab = [];
        $libellePromo = [];

        for($i = 0; $i < sizeof($tabContent2); $i++) {
            if($i%2 != 0) {
                array_push($tab, $tabContent2[$i]);   
            }
        }

        for($i = 0; $i < sizeof($tab); $i++) {
            if($i%2 == 0) {
                $libellePromo[$tab[$i]] = $tab[$i+1];
            }
        }
        
        return $libellePromo;
    }

?>