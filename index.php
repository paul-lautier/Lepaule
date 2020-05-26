<?php
    $database_host = 'localhost';
    $database_port = '3306';
    $database_dbname = 'login';
    $database_user = 'root';
    $database_password = 'Paul@123';
    $database_charset = 'UTF8';
    $database_options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=login','root','Paul@123');

    
?>


<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
    <title>L'épaule</title>
</head>
<body>
<form action="" method="post">
    <button name="login">login</button> 
    <button name="register">register</button>
</form>

    
</body>
</html>

<?php

if (isset($_POST['login'])){
    header('Location: login.php');
    exit;
}
if (isset($_POST['register'])){
    header('Location: register.php');
    exit;
}
?>