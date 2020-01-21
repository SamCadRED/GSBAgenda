<?php
// Récupération des informations de session initialisées dans la page index.php
session_start();
include_once "component.php";

// Définition des variables utilisées dans l'application
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
        <!-- Lien d'import de la librairie JQuery Ajax -->
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    </head>
    <script>

    </script>
    <body class='body'>

        <!-- Header de l'application  -->
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
                <a id="settings" href="">
                    <img id="settings_img" src="../images/settings_logo.png" alt="Paramètres">
                </a>
            </div>

        </div>

        <!-- Séparateur header/reste de l'application -->
        <hr style="margin-left:-8px;margin-right:-8px"/>

        <div class="whole_app">
            <div id="add_event_div">

                <!-- Formulaire d'ajout et/ou modification des évenements (post-it) -->
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

            <!-- Script Ajax d'ajout et/ou modification d'évenements -->
            <script>
                $("#add_event_form").submit(function(e) {
                    e.preventDefault(); // permet de bloquer le comportement par défaut du formulaire
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(), // Serialisation des données du formulaire
                        success: function(data)
                        {
                            // alert(data); 
                            location.reload();
                        }
                        });
                    });
            </script>

            <!-- Conteneur des évenements générer dans components.php -->
            <div class="event_container">
                <?php $index = 0; get_all_events($all_lines) ?>
            </div>
        </div>
    <script src="../script/app.js"></script>
    </body>
</html>