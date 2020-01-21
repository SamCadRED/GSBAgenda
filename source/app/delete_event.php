<?php
session_start();
include_once "../connection/ddb_conn.php";

// récupération des variables de session
$id_event = $_GET['id'];
$id_user = $_SESSION['idUser'];

// Verification de l'identifiant utilisateur récupérer en session 
$sql = 'SELECT `idUser` FROM Events WHERE idEvent = :id_event;';
$req = $conn->prepare($sql);
try {
    $req->execute(array('id_event' => $id_event));
    $result = $req->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// suppression de l'event si l'utilisateur existe et est lié à cet évenement
if ($result) {
    $sql = 'DELETE FROM `Events` WHERE `idEvent` = :id_event';
    $req = $conn->prepare($sql);
    try {
        $req->execute(array('id_event' => $id_event));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    header("location: app.php");
}

