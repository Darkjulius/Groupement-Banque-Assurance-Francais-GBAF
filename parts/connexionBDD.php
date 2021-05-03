<?php
try{
    $bdd = new PDO ('mysql:host=localhost;dbname=extranet_gbaf;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }
?>