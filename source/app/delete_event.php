<?php
session_start();
include_once "../connection/ddb_conn.php";

$id_event = $_GET['id'];
$id_user = $_SESSION['idUser'];

$sql = 'SELECT `idUser` FROM Events WHERE idEvent = :id_event;';
$req = $conn->prepare($sql);
try {
    $req->execute(array('id_event' => $id_event));
    $result = $req->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

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

