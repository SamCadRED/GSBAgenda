<?php
include_once "connection/ddb_conn.php";

$name = htmlentities($_POST['name']);
$surname = htmlentities($_POST['surname']);
$id = htmlentities($_POST['id']);
$pwd = $_POST['pwd'];
$pwdconf = $_POST['pwdconf'];

$sql = 'SELECT identifiant FROM User WHERE `identifiant` LIKE :id;';
$req = $conn->prepare($sql);

try {
    $req->execute(array('id' => $id));
    $fetchArray = $req->fetch(PDO::FETCH_ASSOC);
    $id_db = $fetchArray['identifiant'];
    if ($id_db == false) {
        if ($name && $surname && $id && $pwd && $pwdconf != null) {
            if ($pwd === $pwdconf) {
                $pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
                $sql = 'INSERT INTO User (nom, prenom, identifiant, mdpasse) VALUES (:nom, :prenom, :id, :mdpasse);';
                $req = $conn->prepare($sql);
                try {
                    $req->execute(array(
                        'nom' => $name,
                        'prenom' => $surname,
                        'id' => $id,
                        'mdpasse' => $pwdhash,
                    ));
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                echo '<div class="error_message">
                        <h3>Votre inscription est validée '.$surname.' !</h3>
                    </div>';
            } else {
                echo '<div class="error_message">
                        <h3>Attention !</h3>
                        <h3>Mot de passes non correspondants</h3>
                    </div>';
            }
        }
    } else {
        echo '<div class="error_message">
                <h3>Attention !</h3>
                <h3>Cet identifiant est déja utilisé.</h3>
            </div>';
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
