<?php
session_start();
include "parts/connexionBDD.php";

//Récupération de l'id acteur dans l'URL en fonction du clic effectué sur le lien lire la suite et de l'acteur.
$id = 0;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if ($id != 0) {
    $reponse = $bdd->prepare('SELECT acteur, description, logo
FROM acteur
WHERE id_acteur = ?');
    $reponse->bindValue(1, $id, PDO::PARAM_INT);
    $reponse->execute();
    $donnees = $reponse->fetch();
    if (empty($donnees)) {
        header("Location: accueil.php");
    }
    $reponse = $bdd->prepare('SELECT * FROM vote WHERE id_acteur = ?');
    $reponse->execute(array($id));
    $likes = $reponse-> fetchAll();
    $nb_likes = 0;
    $nb_dislikes = 0;
    foreach($likes as $l)
    {
        if($l['vote'])
        {
            $nb_likes++;
        }
        else{
            $nb_dislikes++;
        }
    }

} else {
    header("Location: accueil.php");
}
if(isset($_SESSION) && isset($_SESSION['id_user']) && !is_null($_SESSION['id_user']))
{
?>
<!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8" />
                <link rel="stylesheet" href="style.css" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Acteurs</title>
            </head>

            <body>
                <div id="page">
                    <?php include "parts/header.php" ?>
                    <div class="profil">
                    <a href="accueil.php">Accueil</a> <a href="deconnexion.php">Déconnexion</a>
                    </div>
                        <section>
                            <div id="presentation_acteurs">
                                <div class="logo_acteurs">
                                    <img src="images/<?php echo htmlspecialchars($donnees['logo']); ?>" alt="Logo <?php echo htmlspecialchars($donnees['acteur']); ?>" />
                                </div>
                                <div class="texte_acteurs">
                                    <h2>
                                    Présentation de <?php echo htmlspecialchars($donnees['acteur']) ?>
                                    </h2>
                                    <p>
                                    <?php echo htmlspecialchars($donnees['description']) ?>
                                    </P>
                                </div>

                            </div>

                        </section>
                    <?php
                    //Récupération des commentaires associés à l'acteur.
                    $reponse = $bdd->prepare('SELECT post, date_add, prenom
                                                                FROM post
                                                                INNER JOIN account
                                                                ON post.id_user = account.id_user
                                                                WHERE post.id_acteur = ?');
                    $reponse->bindValue(1, $id, PDO::PARAM_INT);
                    $reponse->execute();
                    $comm = $reponse->fetchAll();

                    $reponse = $bdd->prepare("SELECT id_post FROM post WHERE id_acteur = ? AND id_user = ?");
                    $reponse->execute(array($id, $_SESSION['id_user']));
                    $moncomm = $reponse->fetch();
                    ?>
                    <section id="commentaires">
                        <div class="commentaires">
                            <div class="container">
                                <div class="nombres">
                                    <h2>
                                    <!-- Comptabilisation du nombres de commentaires.-->
                                    Nombres <?php echo count($comm) ?>
                                    </h2>
                                </div>
                                <?php if(!$moncomm){ ?>
                                <div class="nouveau">
                                    <a href="newcomment.php?id=<?php echo $id ?>">Nouveau commentaire</a>
                                </div>
                                    <?php } ?>
                                <div class="like_dislike">
                                    <p>
                                    <a href="vote.php?vote=1&id_acteur=<?php echo $id ?>"><?php echo $nb_likes ?> Likes</a> -  <a href="vote.php?vote=0&id_acteur=<?php echo $id ?>"><?php echo $nb_dislikes ?> Dislikes</a>
                                    </p>
                                </div>

                            </div>
                            
                            <?php
                            foreach ($comm as $c) {
                            ?>
                            <!-- Affichage de tous les commentaires liés à l'acteur.-->
                            <table>
                                <tr>
                                    <td><?= $c['prenom'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= $c['date_add'] ?></td>
                                </tr>
                                <tr>
                                    <td><?= $c['post'] ?></td>
                                </tr>
                            </table>

                            <?php
                            }
                            ?>
                        </div>
                    </section>

                    <?php include "parts/footer.php" ?>

                </div>

            </body>

        </html>
    <?php
        }
        else{
            header("Location: deconnexion.php");
    }
    ?>