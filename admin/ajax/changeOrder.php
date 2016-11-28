<?php

    require_once('../config-admin.php');

	if(!empty($_POST["promo"]) && !empty($_POST["tabjsn"]))	{
        
        $promo = "";
        
        if($_POST["promo"] != "TOUTES")  {
            $promo = $_POST["promo"];
        }
        
        if($tab = json_decode($_POST["tabjsn"])) {
            foreach($tab as $key => $value) {
                $tmp = $key;
                $tmp++;
                $update = $bdd->prepare("UPDATE document SET rang = :rang WHERE fichier = :fichier AND promo = :promo");
                $update->bindParam(':rang',$key, PDO::PARAM_STR);   
                $update->bindParam(':fichier', $value, PDO::PARAM_STR);   
                $update->bindParam(':promo', $promo, PDO::PARAM_STR);   

                $update->execute();
            }
        }
        
    }

?>
