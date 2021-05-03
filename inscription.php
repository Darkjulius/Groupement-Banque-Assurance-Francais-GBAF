<?php

include "parts/connexionBDD.php";

if(!empty($_POST)){
    extract($_POST);
    $valider = true;

    if(isset($_POST['envoyer'])){
    //Récupération des données.
        $nom = (String) trim($nom);
        $prenom = (String) trim($prenom);
        $username = (String) trim($username);
        $password = (String) trim($password);
        $confirm_password = (String) trim($confirm_password);
        $question = (String) trim($question);
        $reponse = (String) trim($reponse);

        //Vérification des données saisies.
        if(empty($nom)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Nom !";
        }

        if(empty($prenom)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Prénom !";
        }

        if(empty($username)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Username !";
        }
        else {
            //Vérification dans la BDD si le username est déjà existant. Si oui message d'erreur. Utilisateur doit en créer un nouveau.
            $requete = $bdd->prepare('SELECT id_user FROM account WHERE username = ?');
            $requete->execute(array($username));
            $utilisateur = $requete->fetch();

                if(isset($utilisateur['id_user'])){
                    $valider = false;
                    $erreur_nom = "Ce username est déjà utilisé !";
                }
            }

        if(empty($password)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Password !";
        }
        
        if(empty($question)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Question secrète !";
        }

        if(empty($reponse)){
            $valider = false;
            $erreur_nom = "Veuillez renseigner le champ Réponse à la question secrète !";
        }

        if($password !=  $confirm_password)
        {
            $valider = false;
            $erreur_nom = "Les deux mots de passe sont différents ! ";
        }

        //Import des informations saisies après vérification.
        if($valider){
            $pass_hache = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $requete = $bdd->prepare('INSERT INTO account (nom, prenom, username, password, question, response)
            VALUES (:nom, :prenom, :username, :password, :question, :response)');
            $requete->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'username' => $username,
                'password' => $pass_hache,
                'question' => $question,
                'response' => $reponse));
            
                header('location: accueil.php');
                exit;
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
        <title>Inscription</title>
    </head>

    <body>
        <div id=inscription>
            <form action="inscription.php" method="post">
                <?php
                    if(isset($erreur_nom)){
                        echo $erreur_nom;
                    }
                ?>
                <?php include "parts/header_connexion.php" ?>
            
                    <p>
                        <label for="nom">Nom</label> : 
                        <input type="text" class="style" name="nom" id="nom" value="<?php if(isset($nom)) { echo $nom; } ?> " /><br /><br />
                        <label for="prenom">Prénom</label> : 
                        <input type="text" class="style" name="prenom" id="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?> " /><br /><br />
                        <label for="username">Username</label> : 
                        <input type="text" class="style" name="username" id="username" /><br /><br />
                        <label for="password">Password</label> : 
                        <input type="password" class="style" name="password" id="password"/><br /><br />
                        <label for="confirm_password">Confirmer Password</label> : 
                        <input type="password" class="style" name="confirm_password" id="confirm_password" /><br /><br />
                        <label for="question">Question secrète</label> : 
                        <input type="text" class="style" name="question" id="question" value="<?php if(isset($question)) { echo $question; } ?> " /> <br /><br />
                        <label for="reponse">Réponse à la question secrète</label> : 
                        <input type="text" class="style" name="reponse" id="reponse" value="<?php if(isset($reponse)) { echo $reponse; } ?> " /> <br /><br />
                        <button class ="style" type="submit" name="envoyer" value="Valider">Envoyer</button>

                    </p>

            </form>

        </div>

    </body>

</html>