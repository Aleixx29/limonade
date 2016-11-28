<?php

    /*---------------------------------------------------------*/
    /*---SUPPRESSION DE LA TOTALITE DES DONNEES PERSONNELLES---*/
    /*---------------------------------------------------------*/

    require_once('../config-admin.php');
		
    $delete = $bdd->prepare("DROP TABLE data");
    $delete->execute();

    $create = $bdd->prepare("CREATE TABLE IF NOT EXISTS `data` (
								`id` int(11) NOT NULL AUTO_INCREMENT,
								`identifiant` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								`nom_fils` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								`prenom_fils` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								`ddn_fils` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								`tel_mobile` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								`courriel` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								`date` datetime NOT NULL,
								`ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
								PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;")->execute();

?>
