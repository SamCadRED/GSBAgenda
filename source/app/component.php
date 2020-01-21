<?php
session_start();
include_once "../connection/ddb_conn.php";
date_default_timezone_set('Europe/Paris');

$id_user = $_SESSION['idUser'];
$all_lines = [];
//echo $all_lines[$index]['idEvent']);

$sql = 'SELECT * FROM Events WHERE `idUser` = :id ORDER by date_event ASC;';
$req = $conn->prepare($sql);
try {
    $req->execute(array('id' => $id_user));
    while ($line = $req->fetch(PDO::FETCH_ASSOC)) {
        array_push($all_lines, $line);
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$id_event = $all_lines[$index]['idEvent'];


function get_event_case($all_lines, $index) {
    $color = $all_lines[$index]['couleur_event'];
    $id_event = $all_lines[$index]['idEvent'];
    $title_event = ucfirst($all_lines[$index]['intitule']);
    $date_event = $all_lines[$index]['date_event'];
    $time_event = $all_lines[$index]['heure_event'];
    $description_event = ucfirst($all_lines[$index]['description_event']);

    $text_color= 'black';
    $order = 1;
    $title_event_class='intitule';

    $date = date_create_from_format('Y-m-d',$date_event);
    $date_event = $date->format('d/m/Y');

    $date_test = mktime(0,0,0,$date->format('n'),$date->format('j'),$date->format('Y'));
    $today_date = mktime(0, 0, 0, date('n'), date('j'), date('Y'));

    if ($date_test < $today_date) {
        $color = '#b3b3b3';
        $text_color = '#666666';
        $order = 2;
        $box_shadow='0px 0px 4px 1px rgba(0,0,0,0.44)';
        $title_event_class = "event_passed";
        $show_edit = "0";
    }

    $event = "<div class='event_case' 
                id='".$id_event."'
                style='background-color:".$color."; 
                order:".$order.";
                color:".$text_color.";
                box-shadow:".$box_shadow."'>
                <div class='case_header'>
                    <div class='edit_cont'>
                        <a onclick='editEvent(".$id_event.")'>
                            <img class='edit_sign' src='../images/edit.png' alt='modifier' style='opacity:".$show_edit."'>
                        </a>
                    </div>
                    <div class='center_title'>
                        <span class=".$title_event_class.">".$title_event."</span>
                    </div>
                    <div class='cross_cont'>
                        <a href='delete_event.php?id=".$id_event."'>
                            <img class='delete_cross' src='../images/cross2.png' alt='supprimer'>
                        </a>
                    </div>
                </div>
                <div class='case_body'>
                    <div class='date_time'>
                        <span class='date'>".$date_event."</span>
                        <span class='heure'>".$time_event."</span>
                    </div>
                    <div class='description_field'>
                        <span class='description' >".$description_event."</span>
                    </div>
                </div>
            </div>";
    echo $event;
}
//print_r (sizeof($all_lines));
function get_all_events($all_lines) {
    $i = 0;
    while ($i < sizeof($all_lines)) {
        get_event_case($all_lines, $i);
        $i++;
    }
}

