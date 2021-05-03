<?php
    session_start();
    include "parts/connexionBDD.php";

    if(isset($_SESSION) && isset($_SESSION['id_user']) && !is_null($_SESSION['id_user']))
    {
        if(isset($_GET['vote']) && ($_GET['vote'] == 1 || $_GET['vote'] == 0) && isset($_GET['id_acteur']) && !empty($_GET['id_acteur']))
        {
            extract($_GET);

            $reponse = $bdd->prepare("SELECT * FROM vote WHERE id_user = ? AND id_acteur = ?");
            $reponse -> execute(array($_SESSION['id_user'], $id_acteur));

            $bddvote = $reponse->fetch();

            if(empty($bddvote))
            {
                $ajout = $bdd -> prepare("INSERT INTO vote VALUES (?, ?, ?)");
                $ajout->execute(array($_SESSION['id_user'], $id_acteur, $vote));
            }
            else
            {
                $ajout = $bdd -> prepare("UPDATE vote SET vote = ? WHERe id_user = ? AND id_acteur = ?");
                $ajout->execute(array( $vote, $_SESSION['id_user'], $id_acteur));
            }
        }
        header("Location: acteurs.php?id=".$id_acteur);
    }
    else{
        header("Location: deconnexion.php");
    }