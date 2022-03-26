<?php

session_start();

include("mysql.php");

// verifie les infos
if (empty($_POST["mdpCO"])){
    die("pas de mot de passe");
}
if (empty($_POST["pseudoCO"])){
    die("pas de mail");
}

$pseudo = htmlspecialchars($_POST["pseudoCO"]);
$mdp  = sha1(htmlspecialchars($_POST["mdpCO"]));

$query = "SELECT * FROM `utilisateurs` WHERE pseudo='$pseudo' and mdp='$mdp'";
$result = mysqli_query($conn,$query) or die(mysql_error());
$rows = mysqli_num_rows($result);
if($rows>=1){
    $_SESSION['pseudo'] = $pseudo;
    header("Location: acueille.php");
}else{
  echo ("Le nom d'utilisateur ou le mot de passe est incorrect.");
}


?>

