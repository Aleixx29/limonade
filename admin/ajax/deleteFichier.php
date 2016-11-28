<?php

require_once('../config-admin.php');

if(!empty($_POST['fichier'])) {
    
    $delete = $bdd->prepare("DELETE FROM document WHERE fichier =  :fichier");
    $delete->bindParam(':fichier', $_POST['fichier'], PDO::PARAM_STR);   
    $delete->execute();
    
    // Suppression définitive du fichier
    unlink($urlrentree.'../pdf/'.$_POST['fichier']);
}

?>