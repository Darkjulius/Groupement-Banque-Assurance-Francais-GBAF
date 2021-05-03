<?php

include "parts/connexionBDD.php";
    if(!empty($_POST)){
        extract($_POST);
        $valider = true;
    
        if(isset($_POST['envoyer'])){
            
            
            //Vérification des données saisies.
            if(empty($newpassword) || empty($confpassword) || empty($id_user) || $newpassword != $confpassword){
                $valider = false;
            }
            
            if(!$valider){
                header("Location: mdpoubli.php");
            }
            else {
                $requete = $bdd->prepare('UPDATE account SET password = ? WHERE id_user = ?');
                $requete->execute(array(password_hash($newpassword, PASSWORD_BCRYPT), $id_user));
                header("Location: connexion.php");
            }
        }
    }
?>