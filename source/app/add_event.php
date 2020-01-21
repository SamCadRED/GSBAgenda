<?php
session_start();
include_once "../connection/ddb_conn.php";

$event_title = htmlentities($_POST['title']);
$event_date = htmlentities($_POST['date']);
$event_time = htmlentities($_POST['time']);
$event_place = htmlentities($_POST['place']);
$event_color = htmlentities($_POST['color']);
$event_description = htmlentities($_POST['description']);
$id_user = $_SESSION['idUser'];

if ($event_title && $event_date != null) {
    if ($id_user == null) {
        header("location: ../index.php");
    } else {
        if ($event_color == null) {
            $event_color = "#f2f2f2";
        }
        $sql = 'INSERT INTO Events (intitule, date_event, heure_event, lieu_event, couleur_event, description_event, idUser) 
                    VALUES (:titre, :date_event, :heure, :lieu, :couleur, :description_event, :iduser);';
        $req = $conn->prepare($sql);
        try {
            $req->execute(array(
                'titre' => $event_title,
                'date_event' => $event_date,
                'heure' => $event_time,
                'lieu' => $event_place,
                'couleur' => $event_color,
                'description_event' => $event_description,
                'iduser' => $id_user,
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        header("location: app.php");
    }
}

