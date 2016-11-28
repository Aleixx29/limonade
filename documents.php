<?php

  session_name("Rentree");
  @session_start();
  require_once("config.php");

  if( !isset($_SESSION['auth']) || ($_SESSION['auth'] != "TRUE" ) ) {
    // redirection
    header("location: index.php");
  }
  
  if ($_SESSION['existe'] == "TRUE") {
    include_once("includes/getData.php");
  }
  
  include_once("includes/header.php");
?>

<script type="text/javascript">
$(document).ready(function(){
<?php
  include_once("js/spinner.js"); 
  include_once("js/formData.js");
  include_once("js/selectPromo.js");
  include_once("js/fancybox.js");     
?>
});
</script>

<br />
<div class="w3-row">
  <div class="w3-container w3-third" align="center"><img src="images/logo_ISEN.png" width="270" /></div>
  <div class="w3-container w3-third titre" align="center"><?php echo $titre; ?></div>
  <div class="w3-container w3-third titreBis" align="center">ISEN-Ouest</div>
</div>
<br />
<div class="w3-row">

  <div class="w3-container w3-half">
    <?php include_once("includes/formData.php"); ?>  
  </div>
  
  <div class="w3-container w3-half">
    <div id="intro" style="display:none;">
      <img style="margin-top: 120px" class="intro" src="images/isen.gif">
    </div>
    <div id="docs" style="display:none;">
      <?php include_once("includes/listPromo.php"); ?>
      <div id="container" style="display:none;"></div>              
    </div>  
  </div>

</div>
<?php
  if ($_SESSION['existe'] == "TRUE") {
    echo "<script type=\"text/javascript\">$(\"#docs\").show();</script>";        
  }
  else {
    echo "<script type=\"text/javascript\">$(\"#intro\").show();</script>";      
  }
?>
<div class="w3-container w3-half">
  <?php include_once("includes/footer.php"); ?>  
  <br />
</div>

</body>
</html>



