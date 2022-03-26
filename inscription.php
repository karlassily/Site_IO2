<?php

include ("mysql.php");

// verifie les infos
if (empty($_POST["mdp"])){
    die("pas de mot de passe");
}
if (empty($_POST["pseudo"])){
    die("pas de mail");
}

$pseudo = htmlspecialchars($_POST["pseudo"]);
$mdp  = sha1(htmlspecialchars($_POST["mdp"]));



$injection = $conn->prepare("INSERT INTO utilisateur (pseudo, mdp) VALUE(?, ?)");
$injection->bind_param('ss', $pseudo, $mdp);

if(!$injection->execute()){
    echo $mysqli->error;
    $lien="\"inscription.html\"";
    $reussite="inscription echoué";
}
else{
    $lien="\"inscription.html\"";
    $reussite="Vous avez été inscrit avec succes.";
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
</head>
<body>
    <p><?php echo $reussite ?></p>
    <a href=<?php echo $lien ?>>retour</a>
</body>
</html>
