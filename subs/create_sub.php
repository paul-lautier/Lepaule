<?php
session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}

$database_host = 'localhost';
$database_port = '3306';
$database_dbname = 'lepaule';
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>

<form action="create_sub.php" method="post">
    <input type="text" name="sub_name" placeholder="nom du sub"> 
    <input type="text" name="description_sub" placeholder="description du sub">
    <!-- image -->
    <button name="create_sub" action="submit">crée un sub</button>
    <button name="home">home</button>
</form>
    
</body>
</html>

<?php

if(isset($_POST['home'])){
    header('Location: ../users/home_users.php');
}
$description_sub = $_POST['description_sub'];
$sub_name = $_POST['sub_name'];

if(isset($_POST['create_sub'])){
    $query_add_sub = $pdo->prepare("INSERT INTO subs (sub_name, description_sub, createur) VALUES (:sub_name, :description_sub, :createur) ");
    $query_add_sub->bindParam(':sub_name',$sub_name);
    $query_add_sub->bindParam(':description_sub',$description_sub);
    $query_add_sub->bindParam(':createur',$username);
    $query_add_sub->execute();
    echo "<script type='text/javascript'>alert('le sub a bien été crée');</script>";
}
?>