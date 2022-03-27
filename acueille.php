<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(isset($_SESSION["pseudo"])){
    $connecte=true; 
  }
  else{
    $connecte=false;
  }
?>
<!DOCTYPE html>
<html>
  <body>
      <h1>Site de notation</h1>
      <br>
      <?php 
        if($connecte){
          echo "<a href=\"monProfile.php\">mon profil</a><br><br><a href=\"deconnexion.php\">deconnexion</a>";
        }
        else{
          echo "vous n'etes pas connecté";
          echo "<br>";
          echo "<br>";
          echo "<a href=\"connexion.php\">connexion</a>";
          echo "<br>";
          echo "<a href=\"inscription.php\">inscription</a>";
        }
      ?>
      
  </body>
</html>