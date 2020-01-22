<?php
//Fichier de parametrage de la connection à la base de données 

    $host = "localhost";
    $db = "gsb_agenda";
    $username = "gsba";
    $password = "Samuman-43";

    $dsn = "mysql:host=".$host.";dbname=".$db;
    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
