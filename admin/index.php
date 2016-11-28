<?php

# 1. Import de Limonade
require_once('limonade-master/lib/limonade.php');

# 2. Définition des routes et des controlleurs associés
#
# -------------------------------------------------------------------------------
#  Méthode HTTP  |  Url              |  Controlleur
# ---------------+-------------------+-------------------------------------------
#   GET          |  /promos          |  promos
#   GET          |  /fichiers        |  fichiers 
#   GET          |  /fichiers/:promo |  fichierspromo 
#   GET          |  /personaldata    |  personaldata
#   POST         |  /promos          |  promos_add 
#   POST         |  /fichiers        |  fichiers_add
#   PUT          |  /promos          |  promos_edit
#   PUT          |  /fichiers        |  fichiers_edit
#   PUT          |  /personaldata    |  personaldata_edit
# ---------------+-------------------+-------------------------------------------

# 3. Dispatchs GET

dispatch('/', 'accueil');
dispatch('/promos', 'promos');
dispatch('/fichiers', 'fichiers');
dispatch('/fichiers/:promo', 'fichierspromo');
dispatch('/personaldata', 'personaldata');

# 3. Dispatchs POST

dispatch_post('/promos', 'promos_add'); 
dispatch_post('/fichiers', 'fichiers_add');

# 3. Dispatchs PUT

dispatch_put('/promos', 'promos_edit');
dispatch_put('/fichiers', 'fichiers_edit');
dispatch_put('/personaldata', 'personaldata_edit');

function before($route) {
    $baseurl = 'http://127.0.0.1/rentree/';
    set('baseurl', $baseurl);
}

run();

?>