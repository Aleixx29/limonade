<?php

  session_name("Rentree");
  @session_start();  
  
  if ( (!isset($_SESSION['auth'])) || ($_SESSION['auth'] != "TRUE") ) { 
   	echo "Vous n'êtes pas autorisés à consulter cette page !<br>";
		echo "Go away!";
		die();  
  }

?>
