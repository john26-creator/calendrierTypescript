<?php
$token = addslashes ($_GET["token"]);

if (isset($token)  && !empty($token)) { //token renseigné
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=tuto_login_page', "root", "");

        $sth = $dbh->prepare("SELECT * from user WHERE token = '$token'");
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $date_validite = new DateTime($result['date_creation']);
            $date_validite->add(new DateInterval('PT5M'));
            $now = new DateTime();
            $lien = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
            if ($date_validite >= $now) {
                $stmt = $dbh->prepare("UPDATE `user` SET `email_valid`= 1 WHERE `token` =  :token;");
                $stmt->bindParam(':token', $token);
                $status = $stmt->execute();
                session_start();
                $_SESSION["idUser"] = $result["id"];
                header("location:$lien/login/espaceperso");
            } else {
                $lien = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/login";
                header("location:$lien/login");
            }
        }
        $stmt = null;
        $dbh = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
