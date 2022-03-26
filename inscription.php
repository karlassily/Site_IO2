<?php

include ("mysql.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // verifie les infos
    if (empty($_POST["mdp"])){
        die("pas de mot de passe");
    }
    if (empty($_POST["pseudo"])){
        die("pas de mail");
    }

    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $mdp  = sha1(htmlspecialchars($_POST["mdp"]));

    $injection = $conn->prepare("INSERT INTO utilisateurs (pseudo, mdp) VALUE(?, ?)");
    $injection->bind_param('ss', $pseudo, $mdp);

    if(!$injection->execute()){
        echo "error";
        $lien="\"inscription.php\"";
        $reussite="inscription echoué";
    }
    else{
        $lien="\"acueille.php\"";
        $reussite="Vous avez été inscrit avec succes ";
    }
}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <form action="inscription.php" method="POST">
        <ul>
            <li>
                <input type="text" name="pseudo" placeholder="pseudo" >
            </li>
            <br>
            <li>
                <input type="password" name="mdp" placeholder="mdp" >
            </li>
            <br>
        <input type="submit" value="s'inscrire">
        </ul>
    </form>
    <br>
    <br>
    <p>
        <?php 
        if(isset($reussite)){ 
            echo $reussite; 
            echo "<a href=".$lien.">retour</a>";
        }
        else{
            echo "<p>Vous avez deja un compte : <a href=\"connexion.html\">connexion</a></p>";
        }
        ?>
    </p>
    
    <br>
    

</body>
</html>