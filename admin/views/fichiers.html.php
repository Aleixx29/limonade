<div class="row">
    <div class="col-md-12">
        <h2>Gestion des fichiers</h2>
    </div>
</div>

<div class="row mg-bt-s">
    <div class="col-md-12">
        <a href="#" class="btn btn-primary">Tous les fichiers</a>
    </div>
</div>
<div class="row mg-bt-s">
    <div class="col-md-12">
        <div class="btn-toolbar">
            <div class="btn-group">
                <?php
                    foreach($libellePromo as $key => $item) {
                        echo '<a href="'.$baseurl.'admin/?/fichiers/'.$item.'" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="'.$key.'">'.$item.'</a>';
                    }
                    echo '<a href="'.$baseurl.'admin/?/fichiers/communs" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Fichiers communs à toutes les promotions">Fichiers communs</a>';
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Vue générale des fichiers</h3>
          </div>
          <div class="panel-body">
            <input type="text" placeholder="Recherche..." class="form-control recherche">
                <table class="table table-hover table-fichiers">
                 <thead>
                    <tr>
                        <th>Fichier</th>
                        <th>Promotions associées</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                     <?php

                        while($file = $files->fetch()) {
                            echo '<tr><td class="libelle">
                                <a href="'.$url.'pdf/'.$file['fichier'].'" data-url="'.$file['fichier'].'" target="_blank" data-toggle="tooltip" data-placement="right" title="Ouvrir le fichier">'.$file['libelle'].'</a></td><td class="promos-fichier"></td>
                                <td class="tr-fixed">
                                <span class="control-section">
                                <button type="button" data-toggle="modal" data-target="#modification-modal" class="btn btn-primary btn-xs modification-promo-modal-button"><i class="icon-pencil"></i></button>
                                <button type="button" data-toggle="popover" class="suppression-fichier-popover btn btn-danger btn-xs" data-placement="right"><i class="icon-trash-empty"></i></button>
                                </span>
                                </td></tr>';
                        }
                    ?>
                </tbody>
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-2">
            <button type="button" data-toggle="modal" data-target="#ajout-fichier-modal" class="btn btn-primary btn-block ajout-fichier-modal-button"><i class="icon-doc-inv"></i><br>Importer un<br>fichier</button>
    </div>
</div>

<?php
     if(!empty($toast) && !empty($toastStyle)) {
        echo '<div class="'.$toastStyle.' largetoast alert-dismissible alert-success"><span>'.$toast.'</span></div>';
     } 
?>

<div id="popover-suppression-content">
        <input name="fichier" class="fichier-a-suppr" type="hidden" value=""/>
        <button type="button" class="btn btn-default">Annuler</button>
        <button type="submit" data-dismiss="popover" class="ajax-delete-fichier btn btn-default">Supprimer</button>
</div>

<div class="modal fade" id="modification-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Modifier le fichier</h4>
        </div>
        <form enctype="multipart/form-data" class="ajax-modification-fichier" method="POST" action="<?php echo url_for('/fichiers')?>">
            <input type="hidden" name="_method" value="PUT" id="_method">
            <div class="modal-body">
                <div class="form-group">
                    <label for="libelle" class="control-label">Fichier</label>
                    <input name="libelle" value="" type="text" class="form-control" id="input-libelle" readonly required>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="toggle-fichier"><label class="control-label">Remplacer le contenu du fichier</label>
                    <div class="section-fichier-toggle">
                        <input name="fichier" class="file" type="file" multiple data-min-file-count="0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nom" class="control-label">Nom affiché</label>
                    <input name="nom" value="" type="text" class="form-control" id="input-nom" placeholder="Saisir un nom..." required>
                </div>
                <div class="form-group">
                    <label class="control-label">Promotions associées</label>
                    <div class="promo-associees-section">
                        <div class="well promos-12">
                        </div>
                        <div class="well promos-345">
                        </div>
                        <div class="well promos-all">
                        </div>
                    </div>
                    <input class="promos-checked hidden-input" name="promos" value="" required>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ajout-fichier-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Importer un fichier</h4>
        </div>
        <form enctype="multipart/form-data" method="POST" action="<?php echo url_for('/fichiers')?>">
          <div class="modal-body">
                <div class="form-group">
                    <label for="fichier" class="control-label">Fichier</label>
                    <input name="fichier" class="file" type="file" multiple data-min-file-count="1">
                </div>
                <div class="form-group">
                    <label for="libelle" class="control-label">Libellé</label>
                    <input name="libelle" value="" type="text" class="form-control" id="input-nom" placeholder="Saisir un nom..." required>
                </div>
                <div class="form-group">
                    <label class="control-label">Promotions associées</label>
                    <div class="promo-associees-section">
                        <div class="well promos-12">
                            <?php
                                foreach($libellePromo as $key => $item) {
                                    if(strstr($item, "A1") || strstr($item, "A2")) {
                                        echo '<span><input name="'.$item.'" type="checkbox"><span>'.$item.'</span></span>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="well promos-345">
                            <?php
                                foreach($libellePromo as $key => $item) {
                                    if(strstr($item, "A3") || strstr($item, "A4") || strstr($item, "A4")) {
                                        echo '<span><input name="'.$item.'" type="checkbox"> <span>'.$item.'</span></span>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="well promos-all">
                            <span><input name="TOUTES" type="checkbox"><span>TOUTES</span></span>
                        </div>
                        <input class="promos-checked hidden-input" name="promos" value="" required>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
    </div>
  </div>
</div>