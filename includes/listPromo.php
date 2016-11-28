<?php include_once("secure.php"); ?>

<div class="w3-container texte">
  <p style="text-align: justify">
    Vous trouverez sur cette page toutes les informations utiles pour la <b>rentrée <?php echo $annee; ?></b> 
    en sélectionnant l'année qui vous concerne.
    Vous pouvez télécharger chaque fichier (format <a href="http://get.adobe.com/fr/reader/" target="_blank">PDF</a>)
    ou bien l'ensemble des fichiers (format <a href="http://www.7-zip.org/" target="_blank">ZIP</a>) pour l'année choisie. <i>
    A imprimer avec modération...</i>
  </p>
</div>
<div class="w3-container messageTabDoc">
Choisissez votre année&nbsp;:
<?php
  echo "<select class=\"w3-select\" id=\"selectPromo\" size=\"1\">";
  echo "<option value=\"NULL\">"."Choisir dans la liste"."</option>";			
  foreach($libellePromo as $key => $value) {
    echo "<option value=\"".$value."\">".$key."</option>";
  }
  echo "</select>";
?>
</div>
<br />

