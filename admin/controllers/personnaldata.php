<?php

function personaldata() {
    
    require_once('config-admin.php');
    $reponse = $bdd->query('SELECT * FROM data');
    
    set('tabReponse', $reponse);
    return render('personaldata.html.php' ,'layout/default_layout.php'); # rendering HTML view
}

?>