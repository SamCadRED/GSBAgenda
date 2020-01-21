<?php
    $host = "localhost";
    $db = "gsb_agenda";
    $username = "root";
    $password = 'root';

    $dsn = "mysql:host=$host;dbname=$db";
    try {
        $conn = new PDO($dsn);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
