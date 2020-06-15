<?php
session_start();
require '../bdd.php';
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}

if(isset($_POST['del_sub'])){

    $query_compte_is_créateur = $pdo->prepare('SELECT createur FROM subs WHERE createur = :username');
    $query_compte_is_créateur->bindParam(':username',$username);
    $query_compte_is_créateur->execute();
    if($query_compte_is_créateur->rowCount() == 0){
        header('Location: ../users/profile_users.php');
    }
   
}
if(isset($_POST['manage_modo'])){
    header('Location: ./manage_modo.php');
}
if(isset($_POST['change_info'])){
    header('Location: ./select_subs.php');
}
if(isset($_POST['home'])){
    header('Location: ../users/home_users.php'); 
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>L'épaule</title>
</head>
<body>


    <form action="users_manage_subs.php" method="post">
        <button name="del_sub">supprimer un sub</button>
        <button name="manage_modo">gérer les modérateur</button>
        <button name="change_info">gérer les info du sub</button>
        <button name="home">home</button>


    
    </form>
</body>
</html>


