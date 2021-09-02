<?php
session_start();

$idUser = $_SESSION["idUser"];
if (isset($idUser) && !empty($idUser)) {
    $dbh = new PDO('mysql:host=localhost;dbname=tuto_login_page', "root", "");
    $sth = $dbh->prepare("SELECT * from user WHERE id = '$idUser'");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo "Hello User : " . $result["prenom"] . "  " . $result["nom"];
    }
} else {
    header("location:../index.html");
}
