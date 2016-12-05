<?php
    function fichiers_edit() {
        
        require_once('config-admin.php');
        require_once('utils/readFichierPromotions.php');
                    
        //$toastState = 'toast-warning';
        //$toastMessage = "Les informations du fichier n'ont pas été modifiées";
        
        if(!empty($_POST["nom"]) && !empty($_POST["libelle"]) && !empty($_POST["promos"])) {
            
            
            $promos12 = false;
            $promos345 = false;
            $dossier = "";
            
            $asupprimer = array("A12/", "A345/");
        
            $uploaddir = $urlrentree."pdf/";
            $file = str_replace($asupprimer, "", $_POST["libelle"]);
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
            
            $nouveaufichier = $dossier.$file;
            
            // On vérifie si on doit changer de dossier le fichier
            // (ex: si un fichier précédemment associé aux années 1/2 devient associé à toutes les promotions)
            
            if($uploaddir.$_POST["libelle"] != $uploadfile) {
                rename($uploaddir.$_POST["libelle"], $uploadfile);
            }
            
            if(!empty($_FILES['fichier'])) {
                if($_FILES['fichier']['type'] == "application/pdf") {
                    move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile);
                }
            }
            
			$tabBefore = array();
            
			$select = $bdd->prepare('SELECT rang, promo FROM document WHERE fichier = :libelle');
			$select->bindParam(':libelle', $_POST['libelle'], PDO::PARAM_STR);   
			$select->execute();
            
            while($donnees = $select->fetch()) {
                $tabBefore[$donnees['promo']] = $donnees['rang'];
            }
            
			$delete = $bdd->prepare("DELETE FROM document WHERE fichier = :libelle ");
			$delete->bindParam(':libelle', $_POST['libelle'], PDO::PARAM_STR);   
            $delete->execute();
            
            if($tab = json_decode($_POST["promos"])){
                if($tab[0] == "TOUTES") {
                    
                    $insert = $bdd->prepare("INSERT INTO document VALUES (NULL, 0, '', :nom, :libelle)");
                    $insert->bindParam(':nom', $_POST["nom"], PDO::PARAM_STR);  
                    $insert->bindParam(':libelle', $nouveaufichier, PDO::PARAM_STR);   
                    $insert->execute();

                } else {
                    foreach($tab as $promo) {
                        if(array_key_exists($promo, $tabBefore)) {
                            $insert = $bdd->prepare("INSERT INTO document VALUES (NULL, :rang, :promo, :nom, :libelle)");
                            $insert->bindParam(':rang', $tabBefore[$promo], PDO::PARAM_STR);
                        } else {
                            $insert = $bdd->prepare("INSERT INTO document VALUES (NULL, 0, :promo, :nom, :libelle)");
                        }

                        $insert->bindParam(':promo', $promo, PDO::PARAM_STR);
                        $insert->bindParam(':nom', $_POST["nom"], PDO::PARAM_STR);  
                        $insert->bindParam(':libelle', $nouveaufichier, PDO::PARAM_STR);   
                        $insert->execute();
                    }
                }
            }
            
            //$toastState = 'toast-success';
            //$toastMessage = "Les informations du fichier <b>".$_POST['libelle']."</b> ont été modifiées";

        }
           
        $url = $urlrentree.'config.php';
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
