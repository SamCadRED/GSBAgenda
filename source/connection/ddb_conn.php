<?php
    $host = "localhost:8889";
    $db = "gsb_agenda";
    $username = "root";
    $password = 'root';

    $dsn = "mysql:host=localhost:8889;dbname=gsb_agenda";
    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
