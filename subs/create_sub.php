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

    $check_sub_name = $pdo->prepare("SELECT sub_name FROM subs where sub_name = :sub");
    $check_sub_name->bindParam(':sub',$sub_name);
    $check_sub_name->execute();
    

    if($check_sub_name -> rowCount() > 0){
        echo "<script type='text/javascript'>alert('un sub porte déjà ce nom');</script>";
    }
    else{
        $query_add_sub = $pdo->prepare("INSERT INTO subs (sub_name, description_sub, createur, modos) VALUES (:sub_name, :description_sub, :createur, :modo)");
        $query_add_sub->bindParam(':sub_name',$sub_name);
        $query_add_sub->bindParam(':description_sub',$description_sub);
        $query_add_sub->bindParam(':createur',$username);
        $query_add_sub->bindParam(':modo',$username);
        $query_add_sub->execute();
    
        $un = 1;
        $query_add_modo = $pdo->prepare("UPDATE users SET is_modo = :modo WHERE username = :username");
        $query_add_modo->bindParam(':modo',$un);
        $query_add_modo->bindParam(':username',$username);
        $query_add_modo->execute();
    
    
        echo "<script type='text/javascript'>alert('le sub a bien été crée');</script>";

    }

    

}
?>