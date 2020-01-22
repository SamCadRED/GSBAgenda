<?php
session_start();
include_once "connection/ddb_conn.php";

$id = $_POST['id'];
$pwd = $_POST['pwd'];
$start_time = getdate();

$sql = 'SELECT mdpasse, prenom, nom FROM user WHERE `identifiant` LIKE :id;';
$req = $conn->prepare($sql);

try {
    $req->execute(array('id' => $id));
    $fetchArray = $req->fetch(PDO::FETCH_ASSOC);
    print_r($fetchArray);
    exit();


    $pwddb = $fetchArray['mdpasse'];
    $surnamedb = $fetchArray['prenom'];
    $namedb = $fetchArray['nom'];
    if (password_verify($pwd, $pwddb)) { 
        $_SESSION['idUser'] = $id;
        $_SESSION['surname'] = $surnamedb;
        $_SESSION['name'] = $namedb;
        $_SESSION['session_start'] = $start_time;
        header("location: app/app.php");
    } else {
        var_dump($fetchArray);
        echo "Resultat du PDO : ".$fetchArray;
        echo "<br>";
        var_dump($pwddb);
        echo "MDP Stocké en base : ".$pwddb;
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
