<?php
function fichiers_add() {
    
    require_once('config-admin.php');
    require_once('utils/readFichierPromotions.php');
        
    
    $url = $urlrentree.'config.php';
    //$toastState = 'toast-warning';
    //$toastMessage = "Le fichier n'a pas été ajouté";
    
    if(!empty($_FILES['fichier']) && !empty($_POST['libelle']) && !empty($_POST['promos'])) {
        if($_FILES['fichier']['type'] == "application/pdf") {
            $promos12 = false;
            $promos345 = false;
            $dossier = "";

            $uploaddir = $urlrentree."pdf/";
            $file = basename($_FILES['fichier']['name']);
            $uploadfile = $uploaddir.$file;

            /*On détermine dans quel dossier l'on devra enregistrer le fichier*/

            if($tab = json_decode($_POST["promos"])) {

                foreach($tab as $promo) {
                    if(strstr($promo, 'A1') || strstr($promo, 'A2')) {
                        $promos12 = true;
                    } else if(strstr($promo, 'A3') || strstr($promo, 'A4') || strstr($promo, 'A5')) {
                        $promos345 = true;
                    }
                }

                if(!($promos12 == true && $promos345 == true)) {
                    if($promos12 == true) {
                        $dossier = "A12/";
                        $uploadfile = $uploaddir.$dossier.$file;
                    } else if($promos345 == true) {
                        $dossier = "A345/";
                        $uploadfile = $uploaddir.$dossier.$file;  
                    }
                }
            }

            $fichierbdd = $dossier.$file;

            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile)) {

               if($tab = json_decode($_POST["promos"])){
                   if($tab[0] == "TOUTES") {
                        $insert = $bdd->prepare("INSERT INTO document VALUES (NULL, 0, '', :libelle, :fichier)");
                        $insert->bindParam(':libelle', $_POST['libelle'], PDO::PARAM_STR);   
                        $insert->bindParam(':fichier', $fichierbdd, PDO::PARAM_STR);  
                        $insert->execute();
                   } else {
                       foreach($tab as $promo) {
                            $insert = $bdd->prepare("INSERT INTO document VALUES (NULL, 0, :promo, :libelle, :fichier)");
                            $insert->bindParam(':promo', $promo, PDO::PARAM_STR);
                            $insert->bindParam(':libelle', $_POST['libelle'], PDO::PARAM_STR);   
                            $insert->bindParam(':fichier', $fichierbdd, PDO::PARAM_STR);  
                            $insert->execute();
                       }
                   }
               }
            }

            //$toastState = 'toast-success';
            //$toastMessage = "Le fichier <b>".$_POST['libelle']."</b> a été importé et lié aux promotions sélectionnées";
        } else {
            //$toastMessage = "Seuls les fichiers au format PDF sont autorisés";
        }
    }
    
    $libellePromo = readFichierPromotions($url);
    $files = $bdd->query('SELECT fichier, libelle FROM document GROUP BY fichier');
    
    set('url', $urlrentree);
    set('files', $files);
    set('libellePromo', $libellePromo);
    //set('toast',  $toastMessage);
    //set('toastStyle', $toastState);
    
    return render('fichiers.html.php' ,'layout/default_layout.php'); # rendering HTML view
}

?>