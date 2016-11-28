<?php    

    /*---------------------------------------------------*/
    /*---EXPORT AU FORMAT PDF DES DONNEES PERSONNELLES---*/
    /*---------------------------------------------------*/
	
	require_once('../config-admin.php');
	require_once('../utils/fpdf17/fpdf.php');

    if(!empty($_POST["persojsn"]) && !empty($_POST["datedeb"]) && !empty($_POST["datefin"])) {
        
        $datedebtmp = str_replace('/', '-', $_POST["datedeb"]);
        $datefintmp = str_replace('/', '-', $_POST["datefin"]);
        
        $datedeb = date("Y-m-d", strtotime($datedebtmp));
        $datefin = date("Y-m-d", strtotime($datefintmp));
        
        $select = $bdd->prepare('SELECT * FROM data WHERE date BETWEEN :datedeb AND :datefin');
        $select->bindParam(':datedeb', $datedeb, PDO::PARAM_STR);
        $select->bindParam(':datefin', $datefin, PDO::PARAM_STR);  
        $select->execute();

        $pdf=new FPDF('L','cm','A4');

        //Titres des colonnes
        $header = array();

        if($tab = json_decode($_POST["persojsn"])) {
            foreach($tab as $value){
                array_push($header, $value);

            }
        }

        switch (sizeof($header)) {
      case '8':
        $taillecell = 3.75;
        break;
      case '7':
        $taillecell = 4.24;
        break;
      case '6':
        $taillecell = 4.94;
        break;
      case '5':
        $taillecell = 5.94;
        break;
      case '4':
        $taillecell = 7.44;
        break;
      case '3':
        $taillecell = 9.60;
        break;
      case '2':
        $taillecell = 15;
        break;
      case '1':
        $taillecell = 4.2;
        break;

      
      default:
        $taillecell = 3.75;
        break;
    }

    $pdf->SetFont('Arial','B',7);
    $pdf->AddPage();
    $pdf->SetFillColor(96,96,96);
    $pdf->SetTextColor(255,255,255);
    $select = $bdd->query('SELECT * FROM data');

    $pdf->SetXY(0,0);
    for($i=0;$i<sizeof($header);$i++) $pdf->cell($taillecell,1,$header[$i],1,0,'C',1);

    $pdf->SetFillColor(0xdd,0xdd,0xdd);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',7);
    $pdf->SetXY(0,$pdf->GetY()+1);
    $fond=1;

        while($donnees = $select->fetch()){

            foreach($header as $value){
			$pdf->cell($taillecell,0.7,$donnees[$value],1,0,'C',$fond);
		}
	   

       $pdf->SetXY(0,$pdf->GetY()+0.7);
       $fond=!$fond;
        }

        $pdf->Output($urlrentree."../pdf/datas.pdf","F",true);
        $p = 0;
        
        echo $datedeb;
    }
?>