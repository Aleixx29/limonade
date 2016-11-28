<div class="row">
    <div class="col-md-12">
        <h2>Gestion des données personnelles</h2>
    </div>
</div>

<div class="row mg-bt-s">
    <div class="col-md-12">
        <button type="button" data-toggle="modal" data-target="#export-modal" id="export-btn" class="btn btn-default">Export des données</button>
        <button type="button" data-toggle="modal" data-target="#delete-all-modal" class="btn btn-default">Tout supprimer</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
                  <h3 class="panel-title">Liste des données personnelles</h3>
          </div>
          <div class="panel-body">
            <table class="table datatable table-hover">
                 <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom fils</th>
                        <th>Prénom fils</th>
                        <th>Naissance</th>
                        <th>Téléphone</th>
                        <th>Courriel</th>
                        <th>Date visite</th>
                        <th>ip</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                     <?php

                        while($donnees = $tabReponse->fetch()) {
                            echo '<tr><td class="identifiant">'
                                .$donnees['identifiant'].'</td><td class="nom">'
                                .$donnees['nom_fils'].'</td><td class="prenom">'
                                .$donnees['prenom_fils'].'</td><td class="naissance" >'
                                .$donnees['ddn_fils'].'</td><td class="tel">'
                                .$donnees['tel_mobile'].'</td><td class="courriel">'
                                .$donnees['courriel'].'</td><td class="date">'
                                .$donnees['date'].'</td><td class="ip">'
                                .$donnees['ip'].'</td>
                                <td class="tr-fixed">
                                            <span class="control-section">
                                                    <button type="button" data-toggle="modal" data-target="#modification-modal" class="btn btn-primary btn-xs modification-data-modal-button" data-id="'.$donnees['id'].'"><i class="icon-pencil"></i></button>
                                                    <button type="button" data-toggle="popover" class="suppression-data-popover btn btn-danger btn-xs" data-placement="bottom" data-id="'.$donnees['id'].'"><i class="icon-trash-empty"></i></button>
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
</div>

<?php
     if(!empty($toast) && !empty($toastStyle)) {
        echo '<div class="'.$toastStyle.' largetoast alert-dismissible alert-success"><span>'.$toast.'</span></div>';
     } 
?>

<div id="popover-suppression-content">
        <input name="id" class="id-data-a-suppr" type="hidden" value=""/>
        <button type="button" class="btn btn-default">Annuler</button>
        <button type="submit" data-dismiss="popover" class="ajax-delete-data btn btn-default">Supprimer</button>
</div>

<div class="modal fade" id="delete-all-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Suppression des données</h4>
        </div>
          <div class="modal-body">
            <p>L'intégralité des données personnelles seront supprimées.<br/>Cette suppression est définitive.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" id="delete-all-data" class="btn btn-default" data-dismiss="modal">Confirmer</button>
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="export-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Export des données</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12">
                    <div class="alert alert-primary alert-dismissible alert-success">
                        <strong>Ne pas saisir de période</strong> pour exporter l'intégralité des données
                    </div>
                </div>
            </div>
            <label class="control-label">Période</label>
            <div class="row">
                    <div class="col-md-6">
                        <input name="datedeb" type="text" class="datepicker form-control" id="datedeb" placeholder="Saisir une date de début..."><span class="calendar-container"><i class="icon-calendar"></i></span>
                    </div>
                    <div class="col-md-6">
                        <input name="datefin" type="text" class="datepicker form-control" id="datefin" placeholder="Saisir une date de fin..."><span class="calendar-container"><i class="icon-calendar"></i></span>
                    </div>
            </div>
            <br>
                    <label class="control-label">Champs à exporter</label>
					<div class="personaldata-chooser-section">
                        <span> <input type="checkbox" checked name="identifiant">Identifiant</span>
						<span> <input type="checkbox" checked name="nom_fils">Nom fils</span>
                        <span> <input type="checkbox" checked name="prenom_fils">Prénom fils</span>
                        <span> <input type="checkbox" checked name="ddn_fils">Naissance</span>
                        <span> <input type="checkbox" checked name="tel_mobile">Téléphone</span>
                        <span> <input type="checkbox" checked name="courriel">Courriel</span>
                        <span> <input type="checkbox" checked name="date">Date visite</span>
                        <span> <input type="checkbox" checked name="ip">Ip</span>
                        <input class="perso-checked hidden-input" name="persojsn" value="">
                    </div>
			<br>
            
            <label for="tel" class="control-label">Format d'export</label><br>
            <a href="" type="button" data-toggle="modal" id="export-pdf" class="btn btn-default">PDF</a>
            <a href="" type="button" data-toggle="modal" id="export-csv" class="btn btn-default">CSV</a>
        <div class="download-section"></div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modification-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Modifier les données personnelles</h4>
        </div>
        <form class="ajax-modification-data" method="POST" action="<?php echo url_for('/personaldata')?>">
          <input type="hidden" name="_method" value="PUT" id="_method">
          <div class="modal-body">
              <div class="col-lg-6">
                <div class="form-group">
                    <label for="identifiant" class="control-label">Identifiant</label>
                    <input name="identifiant" value="" type="text" class="form-control" id="input-identifiant" placeholder="Saisir un identifiant..." required>
                </div>
                <div class="form-group">
                    <label for="nom" class="control-label">Nom fils</label>
                    <input name="nom" value="" type="text" class="form-control" id="input-nom" placeholder="Saisir un nom..." required>
                </div>
                <div class="form-group">
                    <label for="prenom" class="control-label">Prénom fils</label>
                    <input name="prenom" value="" type="text" class="form-control" id="input-prenom" placeholder="Saisir un prénom..." required>
                </div>
                <div class="form-group">
                    <label for="naissance" class="control-label">Naissance</label>
                    <input name="naissance" value="" type="text" class="datepicker form-control" id="input-naissance" placeholder="Saisir une date de naissance..." required><span class="calendar-container"><i class="icon-calendar"></i></span>
                </div>
              </div>
              <div class="col-lg-6">
                 <div class="form-group">
                    <label for="tel" class="control-label">Téléphone</label>
                    <input name="tel" value="" type="text" class="form-control" id="input-tel" placeholder="Saisir un numéro de téléphone..." required>
                </div>
                <div class="form-group">
                    <label for="courriel" class="control-label">Courriel</label>
                    <input name="courriel" value="" type="text" class="form-control" id="input-courriel" placeholder="Saisir un courriel..." required>
                </div>
                <div class="form-group">
                    <label for="date" class="control-label">Date visite</label>
                    <input name="date" value="" type="text" class="form-control" id="input-date" placeholder="Saisir un nom..." readonly required>
                </div>
                <div class="form-group">
                    <label for="ip" class="control-label">Ip</label>
                    <input name="ip" value="" type="text" class="form-control" id="input-ip" placeholder="Saisir un nom..." readonly required>
                </div>
              </div>
              <div class="form-group">
                    <input name="id" value="" type="hidden" class="form-control" id="input-id" required>
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