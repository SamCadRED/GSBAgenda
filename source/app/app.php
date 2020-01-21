<?php
session_start();
include_once "component.php";

$today_date = date("D/M/Y");
$id = $_SESSION['idUser'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Agenda GSB</title>
        <link rel="stylesheet" href="../style/main.css">
        <link rel="icon" type="image/png" href="/source/images/g_logo.png" />
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    </head>
    <script>

    </script>
    <body class='body'>
        <div class="header">

            <div id="left_header">
                <a id="logo_accueil" href="../../index.php">
                    <img class="logo_accueil_img" src="../images/g_logo.png" alt="Accueil">
                    <span class="logo_title" style="color: white">Agenda</span>
                </a>

                <a class="space_left">
                    <img class="plus_sign" src="../images/plus.jpeg" alt="Ajouter">
                </a>
            </div>

            <div class="right_header">
                <!-- <a id="add_event_button" onclick="showFormMenu()">
                    <img id="plus_sign" src="../images/cross2.png" alt="Ajouter">
                </a> -->

                <a id="settings" href="">
                    <img id="settings_img" src="../images/settings_logo.png" alt="Paramètres">
                </a>

                <!-- <a id="profile" href="">
                    <img id="profile_img" src="../images/profile_icon.png" alt="Mon Profil">
                </a> -->
            </div>

        </div>

        <hr style="margin-left:-8px;margin-right:-8px"/>
        <div class="whole_app">
            <div id="add_event_div">
                <form id="add_event_form" action="add_event.php" method="POST" autocomplete="off">
                    <h4 id="form_title" >Ajouter un événement</h4>
                    <input class="form_element" id="title" name="title" type="text" placeholder="Titre" required="true"/>
                    <input class="form_element" id="date" name="date" type="date" placeholder="date" value="" required="true"/>
                    <input class="form_element" id="time" name="time" type="time" placeholder="Heure" value="12:00"/>
                    <input class="form_element" id="place" name="place" type="text" placeholder="Adresse" value="" style="display: none"/>
                    <select class="form_element" id="color" name="color">
                        <option value="#ffa630" style="background-color: #ffa630">Orange</option>
                        <option value="#da3932" style="background-color: #da3932">Rouge</option>
                        <option value="#4da1a9" style="background-color: #4da1a9">Bleu</option>
                        <option value="#8c596c" style="background-color: #8c596c">Violet</option>
                        <option value="#f2f2f2" style="background-color: #f2f2f2">Blanc</option>
                    </select>
                    <input class="form_element" id="description" name="description" type="textarea" placeholder="description" />
                    <input id="id_event" name="id_event" type="text" style="display: none"/>
                    <input class="form_button" id="submit_event" type="submit" value="Ajouter" />
                    <input class="cancel_button" id="cancel_button" type="reset" value="Annuler" onclick="resetForm()" />

                </form>
            </div>
            <script>
                $("#add_event_form").submit(function(e) {
                    e.preventDefault(); // avoid to execute the actual submit of the form.
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            // alert(data); // show response from the php script.
                            location.reload();
                        }
                        });
                    });
            </script>
            <div class="event_container">
                <?php $index = 0; get_all_events($all_lines) ?>
            </div>
        </div>
    <script src="../script/app.js"></script>
    </body>
</html>