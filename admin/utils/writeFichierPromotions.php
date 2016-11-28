<?php

    /*PERMET DE RECONSTRUIRE LE FICHIER CONTENANT LA LISTE DES PROMOTIONS DANS L'APPLICATION RENTREE*/
    /*Est utilisé lors de l'ajout/modification/suppression d'une promotion*/

    function writeFichierPromotions($url, $libellePromo) {
        
        $fichierPromosContent = file_get_contents($url);
        $tabContent = explode('$libellePromo = array (', $fichierPromosContent);
        $creationFichier = $tabContent[0] . "\$libellePromo = array (";

        foreach(array_keys($libellePromo) as $key){
            $creationFichier .= "\n\"" . $key ."\" => \"". $libellePromo[$key] . "\",";   
        }
        
        $creationFichier = substr($creationFichier, 0, -1);

        $creationFichier .= "\n);\n\nrequire_once(\"lib.php\");\n\n?>";
        file_put_contents($url, $creationFichier);
        
    }

?>