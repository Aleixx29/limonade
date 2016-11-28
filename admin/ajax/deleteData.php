<?php

    /*-----------------------------------------------------------*/
    /*---SUPPRESSION D'UNE LIGNE DANS LES DONNEES PERSONNELLES---*/
    /*-----------------------------------------------------------*/

    require_once('../config-admin.php');

    if(!empty($_POST["id"])) {
        
		$delete = $bdd->prepare("DELETE FROM data WHERE id = :id");
        $delete->bindParam(':id', $_POST["id"], PDO::PARAM_STR);   
        $delete->execute();
    }
?>
