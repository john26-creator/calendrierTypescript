<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="form.css" rel="stylesheet" type="text/css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="script.js" defer></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["session"])) {
        echo $_SESSION["session"];} ?>
    <form action="script.php" method="POST" novalidate>
        <input type="text" name="nom" id="" value="<?php
            if (isset($_COOKIE["nom"])) {
                echo $_COOKIE["nom"];
            } ?>" placeholder="Nom">
        <input type="text" name="prenom" id="" value="<?php
            if (isset($_COOKIE["prenom"])) {
                echo $_COOKIE["prenom"];
            } ?>" placeholder="Prenom">
        <input type="email" name="mail" id="" value="<?php
            if (isset($_COOKIE["mail"])) {
                echo $_COOKIE["mail"];
            } ?>" placeholder="Email">
        <input type="email" name="confEmail" value="<?php
            if (isset($_COOKIE["confmail"])) {
                echo $_COOKIE["confmail"];
            } ?>" placeholder="Confirmation">
        <input type="text" name="sujet" id="" value="<?php
            if (isset($_COOKIE["sujet"])) {
                echo $_COOKIE["sujet"];
            } ?>" placeholder="Sujet">
        <textarea name="message" id="" cols="30" rows="10" value="<?php
            if (isset($_COOKIE["message"])) {
                echo $_COOKIE["message"];
            } ?>" placeholder="Message ..."></textarea>
            
        <input type="submit" value="Envoyer">
    </form>
    <span class="error" style="display:none">Formulaire invalide</span>
    <span class="success" style="display:none">Mail envoyé</span>
    <span class="formok" style="display:none">Formulaire OK</span>

</body>

</html>