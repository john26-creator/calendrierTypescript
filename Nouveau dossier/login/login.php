<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tuto_login_page', "root", "");
    //echo "la connexion a eu lieu";
    $login = addslashes ($_POST["login"]);
    $password = addslashes ($_POST["password"]);

    if (isset($login) && !empty($login) && isset($password) && !empty($password)) {

        $sth = $dbh->prepare("SELECT * from user WHERE email = '$login' AND password = '$password' AND email_valid='1'");
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            session_start();
            $_SESSION["idUser"] = $result["id"];
            header("location:espaceperso/index.php");
        }
    } else {
        echo "désolé vos identifants sont incorrects";
    }
    $dbh = null;
} catch (PDOException $e) {
    echo $e->getMessage();
}
