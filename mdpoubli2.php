<?php

include "parts/connexionBDD.php";
    if(!empty($_POST)){
        extract($_POST);
        $valider = true;
        $erreur_connexion = "Username incorrect";
    
        if(isset($_POST['envoyer'])){
            //Récupération des données.
            $username = (String) trim($_POST['username']);
            
            //Vérification des données saisies.
            if(empty($username)){
                $valider = false;
                $erreur_nom = "Veuillez renseigner le champ Username !";
            }
            
            //Récupération Username et Password.
            $requete = $bdd->prepare('SELECT id_user, question FROM account WHERE username = :username');
            $requete->execute(array(
                'username' => $username));
                $resultat = $requete->fetch();

                if(empty($resultat))
                {
                    $valider = false;
                }
            
            if(!$valider){
                echo $erreur_connexion;
                header("Location: mdpoubli.php");
            }
            else {
                ?>
                    <!DOCTYPE html>
                    <html lang="fr">
                        <head>
                            <meta charset="utf-8" />
                            <link rel="stylesheet" href="style.css" />
                            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                            <title>Mot de passe oublié</title>
                        </head>

                        <body>
                        
                        <?php include "parts/header_connexion.php" ?>

                        <!-- 2nde, il faut répondre à sa question secrète afin de pouvoir passer à la page suivante: 
                        Qui est de saisir le nouveau mot de passe. -->
                        <div id=connexion>
                            <form action="mdpoubli3.php" method="post">
                                <p>Question : <?php echo $resultat['question'] ?></p>
                                <p>
                                    <label for="reponse">Reponse</label> : <input type="text" class="style" name="reponse" id="reponse" /><br /><br />
                                    <input type="hidden" name="id_user" value="<?php echo $resultat['id_user'] ?>">
                                    <button class ="style" type="submit" name="envoyer" value="Valider">envoyer</button>
                                </p>

                            </form>
                        </div>
                        </body>

                    </html>
                <?php
            }
        }
    }
?>