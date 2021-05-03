<?php

include "parts/connexionBDD.php";
    if(!empty($_POST)){
        extract($_POST);
        $valider = true;
        $erreur_connexion = "Username incorrect";
    
        if(isset($_POST['envoyer'])){
            //Récupération des données.
            $reponse = (String) trim($_POST['reponse']);
            $id_user = ($_POST['id_user']);
            
            //Vérification des données saisies.
            if(empty($reponse)){
                $valider = false;
                $erreur_nom = "Veuillez renseigner le champ Reponse !";
            }
            if(empty($id_user)){
                $valider = false;
                $erreur_nom = "Veuillez renseigner le champ id_user !";
            }
            
            //Récupération Username et Password.
            $requete = $bdd->prepare('SELECT id_user, question FROM account WHERE id_user = :id_user AND response = :reponse');
            $requete->execute(array(
                'id_user' => $id_user, 'reponse' => $reponse));
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

                        <!-- Il faut saisir son nouveau mot de passe et le confirmer. La page 4 effectuera un contrôle et amenera l'utilisateur
                        à la page de connexion si tout est Ok. -->
                        <div id=connexion>
                            <form action="mdpoubli4.php" method="post">
                                
                                <p>
                                    <label for="newpassword">Nouveau mot de passe</label> : <input type="password" class="style" name="newpassword" id="newpassword" /><br /><br />
                                    <label for="confpassword">Confirmation mot de passe</label> : <input type="password" class="style" name="confpassword" id="confpassword" /><br /><br />
                                    <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
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