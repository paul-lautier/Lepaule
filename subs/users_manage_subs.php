<?php
session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}

if(isset($_POST['del_sub'])){
    header('Location: ./del_sub.php');
}
if(isset($_POST['manage_modo'])){
    header('Location: ./manage_modo.php');
}
if(isset($_POST['change_info'])){
    header('Location: ./change_info_sub.php');
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
        <button name="manage_modo">gérer les modérateur</button> <!-- uniquement le prorio -->
        <button name="change_info">gérer les info du sub</button>
        <button name="home">home</button>


    
    </form>
</body>
</html>


