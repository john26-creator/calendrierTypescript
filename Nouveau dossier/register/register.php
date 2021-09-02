<?php

header('Content-type:application/json;charset=utf-8');
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$confEmail = $_POST["confemail"];
$email = $_POST["email"];
$password = $_POST["password"];
$confpassword = $_POST["confpassword"];
$cgulues = (isset ($_POST["cgulues"]))? $_POST["cgulues"] : 0;
$cguaccptees = (isset ($_POST["cguaccptees"]))? $_POST["cguaccptees"] : 0;

$status = true; //statut du formaulaire et de l'envoie du mail

if (!isInformed($nom) || !isInformed($prenom) || !isInformed($email)
|| !isInformed($confEmail) || !isInformed($password) || !isInformed($confpassword)
|| !filter_var($email, FILTER_VALIDATE_EMAIL) || $email != $confEmail || $password != $confpassword
|| $cgulues != 1 ||  $cguaccptees != 1) {
    $status = false;
} else {
    //1/Inserer le nouvel utilisateur en BD
    try {
    $dbh = new PDO('mysql:host=localhost;dbname=tuto_login_page', "root", "");
    $stmt = $dbh->prepare("INSERT INTO user (`nom`, `prenom`, `email`, `password`, `date_creation`, `email_valid`, `token`) 
                                     VALUES (:lastname,:firstname,:email,:password,NOW(),0, :token)");
    $stmt->bindParam(':lastname', $nom);
    $stmt->bindParam(':firstname', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $token = uniqid();
    $stmt->bindParam(':token', $token);

    $status = $stmt->execute();
    //2/Envoyer un mail avec un lien de validation de compte utilisateur
     if ($status) {
        $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        $lien = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/activation.php?token=$token";
        $message = "Veuillez cliquer sur ce <a href=\"$lien\"> lien</a> afin d'activer votre compte";
        $status = mail($email, "Activation de votre compte", $message, $headers);
     }
    $stmt = null;
    $dbh = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function isInformed($field)
{ //Est ce qu'un champ est renseigné
    return isset($field) && !empty($field);
}

echo json_encode(['status' => $status]);