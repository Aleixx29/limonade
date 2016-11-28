<?php include_once("secure.php"); ?>

<form id="formData" class="w3-container validate" method="post">	
  <?php
    if ($_SESSION['existe'] != "TRUE") {
      $nomFils = "";
      $prenomFils = "";
      $ddn = "";
      $telMobile = "";
      $courriel = "";
      echo "<br /><div id=\"message\" class=\"monMessage\" align=\"center\">";
      echo "Nous vous remercions de bien vouloir compléter ce formulaire<br />avant d'accéder aux documents de rentrée.";
      echo "</div><br />";        
    }
    else {
      echo "<br /><div id=\"message\" class=\"monMessage\" align=\"center\">";
      echo "Vous pouvez modifier les données enregistrées...<br /><br />";
      echo "</div><br />";         
    }
  ?> 
  <div class="w3-container cellOne">
    <br />
    <div class="texte" align="center"><b>Identifiant&nbsp;:&nbsp;<?php echo $_SESSION['courriel']; ?></b></div>
    <div align="left" class="monLabel"><u>Etudiant(e)</u></div>
    <div>
      <label class="monLabel">Nom de l'étudiant(e)</label>
      <input class="w3-input w3-border" name="nomFils" type="text" value="<?php echo $nomFils; ?>"/>  
    </div>     
    <div id="nomFils"></div>
    <div>
      <label class="monLabel">Prénom de l'étudiant(e)</label>
      <input class="w3-input w3-border" name="prenomFils" type="text" value="<?php echo $prenomFils; ?>"/>
    </div>  
    <div id="prenomFils"></div>
    <div>
      <label class="monLabel">Date de naissance</label>
      <input class="w3-input w3-border" name="ddn" type="text" value="<?php echo $ddn; ?>" id="inputDate" />
      <div id="ddn"></div>
      <p class="texte" align="right">
        Choisir une date&nbsp;<button class="w3-btn w3-round button" type="reset" id="buttonDate" title="Choisir une date">...</button>
      </p>
      <script type="text/javascript">
      Calendar.setup ({
      inputField     :    "inputDate",    // id of the input field
      ifFormat       :    "%e %B %Y",     // format of the input field
      showsTime      :    false,          // will display a time selector
      button         :    "buttonDate",   // trigger for the calendar (button ID)
      singleClick    :    true,           // double-click mode
      step           :    2               // show all years in drop-down boxes (instead of every other year as default)
      });
      </script>
    </div>
              
    <br />
  </div>
  <div class="w3-container cellTwo">
    <br />
    <div align="left" class="monLabel"><u>Parents</u></div>
    <div>
      <label class="monLabel">Téléphone mobile</label>
      <input class="w3-input w3-border" name="telMobile" type="text" value="<?php echo $telMobile; ?>"/>  
    </div>
    <div id="telMobile"></div>
    <div>
      <label class="monLabel">Courriel</label>
      <input class="w3-input w3-border" name="courriel" type="text" value="<?php echo $courriel; ?>"/>  
    </div>
    <div id="courriel"></div>  
    <div>
    <p align="right">  
      <button class="w3-btn w3-round button" name="submitData" id="submitData">Enregistrer</button>
      &nbsp;&nbsp;
      <button class="w3-btn w3-round button" name="quit" id="quit">Quitter</button>    
    </p>  
    <p class="notice" style="text-align: justify">
      Conformément à la loi "Informatique et Libertés" (loi du 6 janvier 1978 telle que modifiée), 
      vous bénéficiez d'un droit d'accès, de rectification et de suppression des données personnelles vous concernant, 
      que vous pouvez exercer en vous adressant à l'adresse e-mail mentionnée ci-dessous.
    </p>
    </div>
    <br />
  </div>   
</form>
