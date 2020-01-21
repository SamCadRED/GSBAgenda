<?php
//Fichier de parametrage de la connection à la base de données 

    $host = "localhost:8889";
    $db = "gsb_agenda";
    $username = "root";
    $password = "root";

    $dsn = "mysql:host=".$host.";dbname=".$db;
    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
