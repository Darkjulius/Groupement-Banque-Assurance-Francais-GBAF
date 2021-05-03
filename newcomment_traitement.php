<?php
session_start();
include "parts/connexionBDD.php";
if(isset($_SESSION) && isset($_SESSION['id_user']) && !is_null($_SESSION['id_user']))
{
    //Si la variable $_POST contient des données alors traitement.
    if(!empty($_POST))
    {
        extract($_POST);
        $valider = true;

        if(isset($_POST['envoyer'])){
        //Récupération des données.
            $post = (string) htmlentities(trim($post));
            $id_acteur = (int) ($id_acteur);

            //Vérification du commentaire commentaires.
            if(empty($post)){
                $valider = false;
                $erreur_nom = "Veuillez saisir votre commentaire !";
            }
    
        if($valider){
            $requete = $bdd->prepare('INSERT INTO post (id_acteur, post, id_user) VALUES (:id_acteur, :post, :id_user)');
            $requete->execute(array(
                
                'post' => $post,
                'id_acteur' => $id_acteur,
                'id_user' => $_SESSION['id_user']
            ));
            
            header('location: acteurs.php?id='.$id_acteur);
            exit;

            }
        }
    }
}
?>