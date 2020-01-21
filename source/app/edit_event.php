<?php
session_start();
include_once "../connection/ddb_conn.php";

// Récupération des valeurs du formaulaire éxécuter dans la page App.php
$event_title = $_POST['title'];
$event_date = $_POST['date'];
$event_time = $_POST['time'];
$event_place = $_POST['place'];
$event_color = $_POST['color'];
$event_description = $_POST['description'];

$id_event = $_POST['id_event'];
$id_user = $_SESSION['idUser'];

// Verfification de l'identifiant utilisateur stocké en session
$sql = 'SELECT `idUser` FROM Events WHERE idEvent = :id_event;';
$req = $conn->prepare($sql);

try {
    $req->execute(array('id_event' => $id_event));
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $result = TRUE;
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
    $result = false;
}

// Si la requête précédente retourne un résultat valide, on met a jour les informations en base avec les odnnées du formulaire
if ($result) {
    $sql = 'UPDATE Events
            SET intitule = :titre, 
                date_event = :date_event, 
                heure_event = :heure, 
                lieu_event= :lieu, 
                couleur_event = :couleur, 
                description_event = :description_event
            WHERE idEvent = :id_event ;';

    $req = $conn->prepare($sql);
    try {
        $req->execute(array(
            'titre' => $event_title,
            'date_event' => $event_date,
            'heure' => $event_time,
            'lieu' => $event_place,
            'couleur' => $event_color,
            'description_event' => $event_description,
            'id_event' => $id_event
        ));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

