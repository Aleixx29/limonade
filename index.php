<?php
  session_name("Rentree");
  @session_start();
  require_once("config.php");
  
  include_once("includes/header.php");
  
?>

<script type="text/javascript">
$(document).ready(function(){
<?php
  include_once("js/spinner.js"); 
  include_once("js/formLogin.js"); 
?>
});
</script>
<br />
<div class="w3-container titre" align="center">
  <img src="images/logo_ISEN.png" width="270" />
</div>
<br />
<div class="w3-container titre" align="center">
  <?php echo $titre." ".$annee; ?>
</div>
<br />
<div class="w3-row">
  <div class="w3-container w3-third">&nbsp;</div>  
  <div class="w3-container w3-third">  
    <form id="formLogin" class="w3-container validate" method="post">
      <label class="monLabel"><b>Courriel</b></label>
      <input class="w3-input w3-border" name="courriel" type="text" />
      <div id="courriel"></div>  
      <div class="texte">(Cette adresse électronique sera votre identifiant)</div>  
  
      <br />
      <label class="monLabel"><b>Mot de passe</b></label>
      <input class="w3-input w3-border" name="password" type="password" />
      <div id="password"></div>
      <div class="texte" align="left">(Le mot de passe qui vous a été envoyé par courrier)</div>
  
      <p align="right">  
        <button class="w3-btn w3-round button" name="submitLogin" id="submitLogin">Valider</button>
      </p>  
    </form>  
  </div>  
  <div class="w3-container w3-third">&nbsp;</div>
</div>
<?php include_once("includes/footer.php"); ?>
</body>
</html>