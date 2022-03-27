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

    
    
    $queryPseudo = "SELECT * FROM `utilisateurs` WHERE pseudo='$pseudo'";
    $resultPseudo = mysqli_query($conn,$queryPseudo) or die(mysql_error());
    $rowsPseudo = mysqli_num_rows($resultPseudo);

    $queryMdp = "SELECT * FROM `utilisateurs` WHERE mdp='$mdp'";
    $resultMdp = mysqli_query($conn,$queryMdp) or die(mysql_error());
    $rowsMdp = mysqli_num_rows($resultMdp);

    if($rowsPseudo>=1 or $rowsMdp>=1){
        $reussite="pseudo ou mdp deja pris ";
    }else{
        $injection = $conn->prepare("INSERT INTO utilisateurs (pseudo, mdp) VALUE(?, ?)");
        $injection->bind_param('ss', $pseudo, $mdp);
        if(!$injection->execute()){
            echo "error";
            $reussite="inscription echoué";
        }
        else{
            $reussite="Vous avez été inscrit avec succes ";
        }
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
        }
        else{
            echo "<p>Vous avez deja un compte : <a href=\"connexion.php\">connexion</a></p>";
        }
        ?>
    </p>
    <a href="acueille.php" name="retour">retour</a>
    
    <br>
    

</body>
</html>