<!DOCTYPE html>

<html>
    <head>
        <title>Interface d'administration</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'/>
        

        <link href="views/css/bootstrap-3.3.5-dist/css/bootstrap2.min.css" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="views/css/fontello-21ae6d11/css/fontello.css"/>
        <link type="text/css" rel="stylesheet" href="views/css/jquery.dataTables.min.css"/>
        <link type="text/css" rel="stylesheet" href="views/css/main.css"/>
        <link type="text/css" rel="stylesheet" href="views/css/bootstrap-fileinput/fileinput.min.css"/>
        <link type="text/css" rel="stylesheet" href="views/css/pikaday.css"/>
        
        <script src="views/js/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="views/css/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="views/js/html5sortable/jquery.sortable.js" type="text/javascript"></script>
        <script src="views/js/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="views/js/bootstrap-fileinput/fileinput.js" type="text/javascript"></script>
        <script src="views/js/bootstrap-fileinput/fileinput_locale_fr.js" type="text/javascript"></script>
        <script src="views/js/timepicker/moment.js" type="text/javascript"></script>
        <script src="views/js/timepicker/pikaday.js" type="text/javascript"></script>
        <script src="views/js/main.js" type="text/javascript"></script>
        <script src="views/js/ajax.js" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
        
                    <a class="navbar-logo" href="#"><img style="display: none;"src="views/images/isen-logo.png" alt="logo-isen" /></a>
                    <a class="navbar-brand" href="#">Documents de rentrée ISEN</a>
                </div> 

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo $baseurl ?>admin/?/promos">Promotions</a></li>
                        <li><a href="<?php echo $baseurl ?>admin/?/fichiers">Fichiers</a></li>
                        <li><a href="<?php echo $baseurl ?>admin/?/personaldata">Données personnelles</a></li>  
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container main-content">
            
            <?php echo $content ?>
            
        </div>
        <div class="popup-bg"></div>
        <footer>
            
        </footer>
        <div id="toast-container"></div>
    </body>
</html>