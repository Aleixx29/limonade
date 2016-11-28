<?php
include_once("secure.php");

$DbLink = mysqli_connect($DbHost, $DbUser, $DbPassword) or die('erreur de connexion au serveur');
mysqli_select_db($DbLink, $DbName) or die('erreur de connexion a la base de donnees');
mysqli_query("SET NAMES 'utf8'");
$query = "SELECT * FROM data WHERE identifiant LIKE '".$_SESSION['courriel']."'";
$result = mysqli_query($DbLink, $query);
$ligne = mysqli_fetch_assoc($result);
$identifiant = stripslashes($ligne['identifiant']);
$nomFils = stripslashes($ligne['nom_fils']);
$prenomFils = stripslashes($ligne['prenom_fils']);
$ddn = stripslashes($ligne['ddn_fils']);
$telMobile = stripslashes($ligne['tel_mobile']);
$courriel = stripslashes($ligne['courriel']);
mysqli_close($DbLink);

?>
