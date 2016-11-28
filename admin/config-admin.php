<?php

/*CONNEXION A LA BASE DE DONNEE*/

$dbhost ='localhost';
$dbname = 'doc_rentree';
$dbuser = 'cir32016';
$dbpassword = 'cir32016';

/*URL RELATIF DE L'APPLICATION RENTREE PAR RAPPORT A L'INDEX DE ADMIN*/

$urlrentree = '../';

$bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', ''.$dbuser.'',''.$dbpassword.'');