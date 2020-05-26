<?php


require '../function/connexion_test.php';


if (!is_connected()){
    header('Location: ../connexion.php');
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

$querry_get_info = $pdo->prepare("SELECT email FROM users WHERE username = :username");
$querry_get_info->bindParam(':username',$username);
$querry_get_info->execute();


$username = $_SESSION['connected'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rédaction d'offres</title>
</head>
<body>

<form action="" method="post">
    <input type="text" name='title' placeholder="intitulé du poste">
    <input type="text" name='description' placeholder="description du poste">
    <input type="email" name='email' placeholder="email de contact">
    <button type="submit">poster</button>
</form>
    
</body>
</html>

<?php
$title = $_POST['title'];
$description = $_POST['description'];
$email = $_POST['email'];
if (isset($_POST['title']) && isset($_POST['description'])){
    $query_post_offre = $pdo->prepare("INSERT INTO offres (title,entreprise,description,email) VALUES (:title,:entreprise,:description,:email)");
    $query_post_offre->bindParam(':title',$title);
    $query_post_offre->bindParam(':entreprise',$username);
    $query_post_offre->bindParam(':description',$description);
    $query_post_offre->bindParam(':email',$email);
    $query_post_offre->execute();
    echo "<script type='text/javascript'>alert('votre offre est maintenant en ligne');</script>";
    header('Location: ./home_donneur.php');
}
?>