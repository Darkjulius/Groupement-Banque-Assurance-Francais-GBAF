<?php

include "parts/connexionBDD.php";

if(!empty($_POST)){
    extract($_POST);
    $valider = true;
    $erreur_connexion = "Username ou Password incorrect";

    if(isset($_POST['connexion'])){
        //Récupération des données.
        $username = (String) trim($_POST['username']);
        $password = (String) trim($_POST['password']);
        
        //Vérification des données saisies.
        if(empty($username)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Username !";
        }
        
        if(empty($password)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Password !";
        }
        
        //Récupération Username et Password.
        $requete = $bdd->prepare('SELECT id_user, nom, prenom, password FROM account WHERE username = :username');
        $requete->execute(array(
            'username' => $username));
            $resultat = $requete->fetch();
            //Comparaison du password envoyé via le formulaire avec la BDD.
            $PasswordCorrect = password_verify($password, $resultat['password']);
        
        if(!$valider){
            echo $erreur_connexion;
        }
        else {
            if($PasswordCorrect){
                    session_start();
                    $_SESSION['id_user'] = $resultat['id_user'];
                    $_SESSION['nom'] = $resultat['nom'];
                    $_SESSION['prenom'] =$resultat['prenom'];

                    header('Location: accueil.php');
                    exit;
                }
                else{
                    echo $erreur_connexion;
                }
            }

    }
}
?>
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="style.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Connexion</title>
        </head>

        <body>
        
        <?php include "parts/header_connexion.php" ?>

        <div id="connexion">
            <form action="connexion.php" method="post">
                <p>
                    <label for="username">Username</label> : <input type="text" class="style" name="username" id="username" /><br /><br />
                    <label for="password">Password</label> : <input type="password" class="style" name="password" id="password" /><br /><br />
                    <button class ="style" type="submit" name="connexion" value="Valider">Connexion</button>
                    <a href="mdpoubli.php">Mot de passe oublié ?</a>
                    <a href="inscription.php">Inscription</a>
                </p>

            </form>
        </div>
        </body>

    </html>