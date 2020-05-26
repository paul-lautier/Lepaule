<?php
require '../function/connexion_test.php';

if (!is_connected()){
    header('Location: connexion.php');
}

session_start();


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

$pdo = new PDO(
    'mysql:host=' . $database_host .
    ';port=' . $database_port .
    ';dbname=' . $database_dbname .
    ';charset=' . $database_charset,
    $database_user,
    $database_password,
    $database_options
);

$username = $_SESSION['connected'];

$querry_get_info = $pdo->prepare("SELECT email FROM companies WHERE username = :username");
$querry_get_info->bindParam(':username',$username);
$querry_get_info->execute();
$email = $querry_get_info->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

nom d'utilisateur : <?php echo $username?><br>
addresse email : <?php echo implode($email)?><br>
<a href="./change_pass.php">changer son mot de passe</a><br>
<a href="./sup_compte.php">supprimer votre compte</a>
    
</body>
</html>