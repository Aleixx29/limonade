<div class="row">
    <div class="col-md-12">
        <h2>Gestion des fichiers</h2>
    </div>
</div>
<div class="row mg-bt-s">
    <div class="col-md-12">
        <?php
            echo '<a href="'.$baseurl.'admin/?/fichiers" class="btn btn-default">Tous les fichiers</a>';
        ?>
    </div>
</div>
<div class="row mg-bt-s">
    <div class="col-md-12">
        <div class="btn-toolbar">
            <div class="btn-group">
                <?php
                    foreach($libellePromo as $key => $item) {
                        if(!strcmp(strtolower($promo), strtolower($item))) {
                        echo '<a href="'.$baseurl.'admin/?/fichiers/'.$item.'" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="'.$key.'">'.$item.'</a>';
                        } else {
                           echo '<a href="'.$baseurl.'admin/?/fichiers/'.$item.'" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="'.$key.'">'.$item.'</a>'; 
                        }
                    }

                    if(!strcmp($promo, "")) {
                        echo '<a href="'.$baseurl.'admin/?/fichiers/communs" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Fichiers communs à toutes les promotions">Fichiers communs</a>';
                    } else {
                        echo '<a href="'.$baseurl.'admin/?/fichiers/communs" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Fichiers communs à toutes les promotions">Fichiers communs</a>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php 
                        if(!strcmp($promo, "")) {
                            echo 'Fichiers communs à toutes les promotions';
                        } else {
                             echo 'Fichiers liés à la promotion '.$promo;
                        }
                    
                    ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-1">
                    <ul class="list-group">
                        <?php
                            $i = 0;
                            while($donnees = $count->fetch()) {
                                $i++;
                                echo '<li class="list-group-item">'. $i .'</li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-11">
                    <ul class="list-group sortable" id="change-order">
                       <?php
                            $i = 0;
                            while($donnees = $tabReponse->fetch()) {
                                $i++;
                                echo '<li class="list-group-item"><a href="../pdf/'. $donnees['fichier'] .'" target="_blank" data-value="'.$donnees['fichier'].'" data-toggle="tooltip" data-placement="right" title="Ouvrir le fichier">'. $donnees['libelle'] .'</a><i class="icon-braille"></i></li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="alert alert-primary alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">✕</button>
                    <?php

                        if(!strcmp($promo, "")) {

                            echo 'Les fichiers communs seront affichés <strong>après les fichiers liés à chaque promotion</strong>';
                        } else {
                            echo 'Les fichiers de la section <strong>FICHIERS COMMUNS</strong> seront affichés <strong>après les fichiers ci-dessus';
                        }
                        
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>