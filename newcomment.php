<?php 
session_start();
$id = 0;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if(isset($_SESSION) && isset($_SESSION['id_user']) && !is_null($_SESSION['id_user']))
{
if ($id != 0) {
?>

        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8" />
                <link rel="stylesheet" href="style.css" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>NewComment</title>
            </head>

            <body>
                <div id="connexion">
                    <form action="newcomment_traitement.php" method="POST">
                        <?php if(isset($erreur_nom)) { echo $erreur_nom; } ?>
                            <?php include "parts/header_connexion.php" ?>
                                <div class="profil">
                                    <a href="accueil.php">Accueil</a> <a href="deconnexion.php">Déconnexion</a>
                                </div>
                            <p>Votre commentaire :</p>
                            <textarea name="post" rows="8" cols="45">Vous pouvez écrire ici</textarea><br /><br/>
                            <input type="hidden" name="id_acteur" value="<?php echo $id ?>">
                            <button class="style" type="submit" name="envoyer">Envoyer</button>

                    </form>
                </div>
            </body>
        </html>
    <?php  
}
}
else {
    header("Location: accueil.php");
}
?>