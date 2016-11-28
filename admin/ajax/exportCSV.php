<?php

    /*---------------------------------------------------*/
    /*---EXPORT AU FORMAT CSV DES DONNEES PERSONNELLES---*/
    /*---------------------------------------------------*/

    require_once('../config-admin.php');
	
	if(!empty($_POST["persojsn"]) && !empty($_POST["datedeb"]) && !empty($_POST["datefin"])) {
		
		$header = array();
        
        $datedebtmp = str_replace('/', '-', $_POST["datedeb"]);
        $datefintmp = str_replace('/', '-', $_POST["datefin"]);
        
        $datedeb = date("Y-m-d", strtotime($datedebtmp));
        $datefin = date("Y-m-d", strtotime($datefintmp));
        
        $select = $bdd->prepare('SELECT * FROM data WHERE date BETWEEN :datedeb AND :datefin');
        $select->bindParam(':datedeb', $datedeb, PDO::PARAM_STR);
        $select->bindParam(':datefin', $datefin, PDO::PARAM_STR);  
        $select->execute();
		
		if($tab = json_decode($_POST["persojsn"])) {
            foreach($tab as $value){
				array_push($header, $value);
				
			}
		}
		
		$file = fopen($urlrentree."../pdf/datas.csv","w");
	
		fputcsv($file, $header, ";");
		
		while($donnees = $select->fetch()) {
            
			$tab_tmp = array();
			foreach($header as $value){
				array_push($tab_tmp,$donnees[$value]);
			}
			fputcsv($file, $tab_tmp, ";");

		}

		fclose($file);
				
	}

  

?>