<div class="row">
    <div class="col-md-12">
        <h2>Gestion des promotions</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="panel panel-primary">
          <div class="panel-heading">
                  <h3 class="panel-title">Liste des promotions</h3>
              </div>
          <div class="panel-body">
            <input type="text" placeholder="Recherche..." class="form-control recherche">
            <table class="table table-hover table-promos">
                 <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Nom complet</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            foreach($libellePromo as $key => $item) {
                                echo '<tr>
                                        <td class="libelle">'.$item.'</td>
                                        <td class="nom">'.$key.'</td>
                                        <td class="tr-fixed">
                                            <span class="control-section">
                                                    <button type="button" data-toggle="modal" data-target="#modification-modal" class="btn btn-primary btn-xs modification-modal-button"><i class="icon-pencil"></i></button>
                                                    <button type="button" data-toggle="popover" class="suppression-popover btn btn-danger btn-xs" data-placement="right"><i class="icon-trash-empty"></i></button>
                                            </span>
                                        </td>
                                    </tr>';
                            }
                        ?>
                </tbody>
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-5">
         <div class="panel panel-primary">
            <div class="panel-heading">
                  <h3 class="panel-title">Ajout d'une promotion</h3>
              </div>
             <div class="panel-body">
                 <form class="ajax-add-promo" id="formulaire-add-promo" method="POST" action="<?php echo url_for('/promos')?>">
                    <div class="form-group">
                        <label for="libelle" class="control-label">Libellé</label>
                        <input type="text" class="form-control" id="libelle-promo" name="libelle" placeholder="Saisir un libellé..." required>
                    </div>
                    <div class="form-group">
                        <label for="nom" class="control-label">Nom complet</label>
                        <input type="text" class="form-control" id="nom-promo" name="nom" placeholder="Saisir un nom..." required>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <button type="reset" class="btn btn-default">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                 </form>
             </div>
         </div>
            <div class="alert alert-primary alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">✕</button>
                Le libellé d'une promotion doit contenir <strong>la lettre A suivie d'un chiffre entre 1 et 5</strong> selon l'année correspondante
            </div>
     </div>
</div>
<?php
     if(!empty($toast) && !empty($toastStyle)) {
        echo '<div class="'.$toastStyle.' largetoast alert-dismissible alert-success"><span>'.$toast.'</span></div>';
     } 
?>

<div id="popover-suppression-content">
        <input name="nom" class="nom-promo-a-suppr" type="hidden" value=""/>
        <input name="libelle" class="libelle-promo-a-suppr" type="hidden" value=""/>
        <button type="button" class="btn btn-default">Annuler</button>
        <button type="submit" data-dismiss="popover" class="ajax-delete btn btn-default">Supprimer</button>
</div>

<div class="modal fade" id="modification-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Modifier une promotion</h4>
        </div>
        <form class="ajax-modification-promo" method="POST" action="<?php echo url_for('/promos')?>">
          <input type="hidden" name="_method" value="PUT" id="_method">
          <div class="modal-body">
                <div class="form-group">
                    <label for="libelle" class="control-label">Libellé</label>
                    <input name="libelle" value="" type="text" class="form-control" id="input-libelle" placeholder="Saisir un libellé..." required>
                </div>
                <div class="form-group">
                    <label for="nom" class="control-label">Nom complet</label>
                    <input name="nom" value="" type="text" class="form-control" id="input-nom" placeholder="Saisir un nom..." required>
                </div>
                <input name="libelleoriginal" value="" type="hidden" id="input-libelle-original">
                <input name="nomoriginal" value="" type="hidden" id="input-nom-original">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
    </div>
  </div>
    
</div>