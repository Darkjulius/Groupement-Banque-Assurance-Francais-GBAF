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
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Accueil</title>
            </head>

            <body>
            
                <div id="page">
                    <?php include "parts/header.php" ?>
                    <div class="profil">
                    <a href="profil.php">Paramètre du compte</a> <a href="deconnexion.php">Déconnexion</a>
                    </div>
                        <section>
                            <?php
                            include "parts/connexionBDD.php";
                            $reponse = $bdd->query('SELECT * FROM account');
                            $donnees = $reponse->fetch()
                            ?>
                            <div id="presentation_gbaf">
                                <div class="texte_gbaf">
                                        <h1>Qu'est-ce que GBAF et l'Extranet ?</h1>
                                        <p>Le <strong>Groupement Banque Assurance Français</strong> GBAF est une fédération représentant les 6 grands groupes français:</p>
                                            <ul>
                                                <li>BNP Paribas</li>
                                                <li>BPCE</li>
                                                <li>Crédit Agricole</li>
                                                <li>Crédit Mutuel-CIC</li>
                                                <li>Société Générale</li>
                                                <li>La Banque Postale</li>
                                            </ul>
                                        
                                        <p>L'extranet est un point d'entrée unique, répertoriant un grand nombre d'informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaire et financier.<br /> 
                                        Chaque salarié pourra poster un commentaire et donner son avis.</p>
                                    <div class="illustration_gbaf">
                                        <img src="images/illustration.png" alt="Illustration GBAF" />
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div id="presentation_acteurs">
                                <div class="texte_acteurs">
                                    <h2>
                                    Qui sont les acteurs et partenaires ?
                                    </h2>
                                </div>
                                <ul>
                                    <li>Formation&Co</li>
                                    <li>ProtectPeople</li>
                                    <li>DSA France</li>
                                    <li>CDE</li>
                                </ul>
                            </div>
                            <?php
                            //Connexion à la base de données.
                            include "parts/connexionBDD.php";
                            $reponse = $bdd->query('SELECT id_acteur, acteur, description, logo FROM acteur');
                            while ($donnees = $reponse->fetch())
                            {
                            ?>
                                <div class="acteurs_partenaires">
                                    <div class="partenaires">
                                        <div class="logo">
                                            <img src="images/<?php echo htmlspecialchars($donnees['logo']) ; ?>" alt="Logo <?php echo htmlspecialchars($donnees['acteur']) ; ?>" />
                                        </div>
                                    </div>
                                    <div class="texte">
                                        <h3><?php
                                            //Affichage d'un nombre de mots définis dans la variable $longueur.
                                                $chaine = htmlspecialchars($donnees['description']);
                                                $tab = explode(" ", $chaine);
                                                $long = count($tab);
                                                $longueur = 20;
                                                if ($long < $longueur)
                                                    echo $chaine;
                                                else {
                                                    $result = "";
                                                    for ($i = 0; $i <= $longueur; $i++) {
                                                        $result .= $tab[$i] . " ";
                                                    }
                                                    echo $result . "...";
                                                }
                                            ?></h3>
                                    </div>
                                    <div class="suite">
                                        <a href="acteurs.php?id=<?php  echo htmlspecialchars($donnees['id_acteur']) ?>">Lire la suite</a>
                                    </div>
                                </div>
                            <?php
                            }
                            $reponse->closeCursor();
                            ?>
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