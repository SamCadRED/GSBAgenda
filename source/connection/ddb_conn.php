<?php
//Fichier des paramêtres de connection à la base de données SQL

    $host = "localhost";
    $db = "gsb_agenda";
    $username = "";
    $password = "";

    $dsn = "mysql:host=".$host.";dbname=".$db;
    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
