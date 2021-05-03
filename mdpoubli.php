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

        <!-- Première page, il faut saisir son username afin de pouvoir passer à la page suivante: Réponse à la question secrète. -->
        <div id=connexion>
            <form action="mdpoubli2.php" method="post">
                <p>
                    <label for="username">Username</label> : <input type="text" class="style" name="username" id="username" /><br /><br />
                    <button class ="style" type="submit" name="envoyer" value="Valider">envoyer</button>
                </p>

            </form>
        </div>
    </body>

</html>