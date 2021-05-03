<?php 
    session_start();
    if(isset($_SESSION) && isset($_SESSION['id_user']) && !is_null($_SESSION['id_user']))
    {
?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8" />
                <link rel="stylesheet" href="style.css" />
                <meta name="viewport" content="widht=device-width, initial-scale=1, shrink-to-fit=no">
                <title> Profil</title>
            </head>

            <body>
                <?php include "parts/connexionBDD.php" ?>

                
                <?php include "parts/header.php" ?>
                <div id="connexion">
                <a href="accueil.php">Accueil</a> <a href="deconnexion.php">Déconnexion</a>
                <form action="profil.php" method="post">
                    
                    <?php
                        
                        $profil = $bdd->prepare('SELECT * FROM account WHERE id_user = ?');
                        $profil -> execute(
                            [$_SESSION['id_user']]
                        );
                        $profil = $profil->fetch();

                        if(!empty($_POST)){
                            extract($_POST);
                            $valider=true;

                            if(isset($_POST['modifier'])){
                                $username = htmlentities(trim($username));
                                $oldpassword = htmlentities(trim($oldpassword));
                                $newpassword = htmlentities(trim($newpassword));
                                $newconfpassword = htmlentities(trim($newconfpassword));
                                
                                //Vérification des variables si elles sont vides ou non définie.
                                if(empty($username)){
                                    $valider=false;
                                    $erreur_nom = "Il faut saisir un username";
                                }

                                if(empty($oldpassword)){
                                    $valider=false;
                                    $erreur_nom = "Il faut saisir un password";
                                }if(empty($newpassword)){
                                    $valider=false;
                                    $erreur_nom = "Il faut saisir un password";
                                }if(empty($newconfpassword)){
                                    $valider=false;
                                    $erreur_nom = "Il faut saisir un password";
                                }
                                    //Si tout est Ok alors contrôle des 2 password afin de savoir si ils sont identiques.
                                    else{
                                        $requete = $bdd->prepare('SELECT password FROM account WHERE id_user = ?');
                                        $requete->execute(array($_SESSION['id_user']));
                                        $utilisateur = $requete->fetch();
                                        if(!password_verify($oldpassword, $utilisateur['password']))
                                        {
                                            $valider=false;
                                            $erreur_nom = "L'ancien mot de passe n'est pas le bon !";
                                        }

                                        if($newpassword != $newconfpassword)
                                        {
                                            $valider=false;
                                            $erreur_nom = "Le nouveau mot de passe n'est pas identique à la confirmation !";
                                        }
                                    //Vérification dans la BDD si le username est déjà existant. Si oui message d'erreur. Utilisateur doit en créer un nouveau.
                                        $requete = $bdd->prepare('SELECT id_user FROM account WHERE username = ? AND id_user != ?');
                                        $requete->execute(array($username, $_SESSION['id_user']));
                                        $utilisateur = $requete->fetch();

                                        if(isset($utilisateur['id_user'])){
                                            $valider=false;
                                            $erreur_nom = "Ce username est déjà utilisé !";
                                        }
                                    }
                            }

                                if($valider){
                                    $password = password_hash($newpassword, PASSWORD_BCRYPT);
                                    $profil = $bdd->prepare('UPDATE account SET username = ?, password = ? WHERE id_user = ?'); 
                                    $profil -> execute(array($username, $password, $_SESSION['id_user']));

                                    $erreur_nom = "Le nom d'utilisateur et le mot de passe ont bien été changés.";
                                    header('Location: profil.php');
                                    exit;
                                }
                        }
                        ?>

                        <?php
                            if (isset($erreur_nom)){
                        ?>
                            <div><?php echo $erreur_nom ?></div>

                        <?php
                        }
                        ?>
                        
                        <p>
                            <label for="username">Username</label> :
                            <input type="text" class="style" placeholder="Votre username" name="username" id="username" value="<?php  echo trim($profil['username']);  ?>" /><br /><br />
                            <label for="password">Ancien Password</label> : 
                            <input type="password" class="style" name="oldpassword" id="password" /><br /><br />
                            <label for="password">Nouveau Password</label> : 
                            <input type="password" class="style" name="newpassword" /><br /><br />
                            <label for="password">Confirmation nouveau Password</label> : 
                            <input type="password" class="style" name="newconfpassword" /><br /><br />
                            <button class ="style" type="submit" name="modifier" value="Valider">Mettre à jour</button>
                        </p>
                        
                </form>
                </div>

            </body>

        </html>
<?php
}
    else{
        header("Location: deconnexion.php");
    }
?>
