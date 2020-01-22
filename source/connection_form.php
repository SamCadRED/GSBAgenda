<!-- Script PHP de connection utilisateur à l'App -->
<?php
session_start();
include_once "connection/ddb_conn.php";

// Récupération de l'identitifiant et Mot de passe du formulaire via POST
$id = $_POST['id']; 
$pwd = $_POST['pwd'];
$start_time = getdate();

$sql = 'SELECT * FROM User WHERE `identifiant` LIKE :id;';
$req = $conn->prepare($sql);

try {
    $req->execute(array('id' => $id));
    $fetchArray = $req->fetch(PDO::FETCH_ASSOC);
    $pwddb = $fetchArray['mdpasse']; // Mot de passe Hasher stocké en base
    $surnamedb = $fetchArray['prenom']; 
    $namedb = $fetchArray['nom'];
    if (password_verify($pwd, $pwddb)) { // Fonction de verfification du mot de passe 
        $_SESSION['idUser'] = $id;
        $_SESSION['surname'] = $surnamedb;
        $_SESSION['name'] = $namedb;
        $_SESSION['session_start'] = $start_time;
        header("location: app/app.php"); // Redirection vers l'App si la connection réussie
    } else {
        // Message d'erreur si la connection échoue
        ?>
        <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <link rel="stylesheet" href="../source/style/main.css">
                    <title>Attention</title>
                </head>
                <body class="body">
                    <div class="error_message2" style="margin-left: 30%; margin-right:30%; margin-top:10%">
                        <h2>Attention !</h2>
                        <h3>Mot de passe ou identifiant incorrect</h3>
                        <h2><a href="../index.php">Retour</a></h2>
                    </div>
                </body>
                </html>
            <?php 
        session_destroy();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
