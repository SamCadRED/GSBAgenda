<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Accueil GSB</title>
        <link rel="stylesheet" href="source/style/main.css">
        <link rel="icon" type="image/png" href="/source/images/g_logo.png" />
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    </head>
    <body class="body">
        <img class='logo_gsb' src='source/images/logo-gsb.png' alt='GSB_LOGO'>
        <div class="master_window">
            <div class="form_window">
                <div class="connection">
                    <h2 style="color: white">Se connecter</h2>
                    <form id="connection_form" method="POST" action="source/connection_form.php" autocomplete="off"> 
                        <input class="form_element" name="id" type="text" placeholder="Identifiant" required/>
                        <input class="form_element" name="pwd" type="password" placeholder="Mot de Passe" required/>
                        <input class="form_button" id="login_button" type="submit" value="Se connecter" />
                    </form>
                </div>
                
                <!-- <div class="separation_line">
                    <hr/>
                </div> -->

                <div class="subscribe">
                    <h2 style="color: white">S'inscrire</h2>
                    <div id="subscribe_message"></div>
                    <form id="subcsribe_form" action="source/subscribe_form.php" method="POST" autocomplete="off">
                        <input class="form_element" name="surname" id="surname" type="text" placeholder="Prénom" required/>
                        <input class="form_element" name="name" id="name" type="text" placeholder="Nom" required/>
                        <input class="form_element" name="id" id="id" type="text" placeholder="Identifiant" required/>
                        <input class="form_element" name="pwd" id="pwd" type="password" placeholder="Mot de Passe" required/>
                        <input class="form_element" name="pwdconf" id="pwdconf" type="password" placeholder="Confirmation" required/>
                        <input class="form_button" id="subscribe_button" type="submit" value="S'inscrire"/>
                        <input class="cancel_button" type="reset" value="Effacer"/>
                    </form>
                </div>
                <script>
                    $("#subcsribe_form").submit(function(e) {
                        e.preventDefault(); 
                        var form = $(this);
                        var url = form.attr('action');
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form.serialize(), 
                            success: function(data)
                            {
                                $('#subscribe_message').html(data);
                            }
                            });
                        });
                </script>
            </div>
        </div>
    </body>
</html>
