<?php

function personaldata_edit() {
    
    require_once('config-admin.php');
    
    $toastState = 'toast-warning';
    $toastMessage = "Les données personnelles n'ont pas été modifiées";
    
      if(!empty($_POST["identifiant"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["naissance"]) && !empty($_POST["tel"]) && !empty($_POST["courriel"]) && !empty($_POST["id"])) {
        
        $update = $bdd->prepare("UPDATE data SET identifiant = :identifiant, nom_fils = :nom, prenom_fils = :prenom, ddn_fils = :naissance, tel_mobile = :tel, courriel = :courriel WHERE id = :id");

        $update->bindParam(':identifiant', $_POST["identifiant"], PDO::PARAM_STR);
        $update->bindParam(':nom', $_POST["nom"], PDO::PARAM_STR);   
        $update->bindParam(':prenom', $_POST["prenom"], PDO::PARAM_STR);   
        $update->bindParam(':naissance', $_POST["naissance"], PDO::PARAM_STR);   
        $update->bindParam(':tel', $_POST["tel"], PDO::PARAM_STR);   
        $update->bindParam(':courriel', $_POST["courriel"], PDO::PARAM_STR);   
        $update->bindParam(':id', $_POST["id"], PDO::PARAM_STR);   
        
        $update->execute();
          
        $toastState = 'toast-success';
        $toastMessage = "Les données personnelles ont été modifiées";
    }
    
    $reponse = $bdd->query('SELECT * FROM data');
    set('tabReponse', $reponse);
    set('toast',  $toastMessage);
    set('toastStyle', $toastState);
    
    return render('personaldata.html.php' ,'layout/default_layout.php'); # rendering HTML view
}

?>