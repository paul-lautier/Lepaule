<?php
session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}
require '../bdd.php';

$username = $_SESSION['connected'];





if(isset($_POST['home'])){
    header('Location: ./users_manage_subs.php');
}

if(isset($_POST['submit'])){
    
    $query_change_name = $pdo->prepare('UPDATE subs SET sub_name = :new_name where sub_name = :old_name');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>
    <form action="change_info_sub.php" method="post">
        <input type="text" name="new_name" placeholder="nouveau nom">
        <input type="text" name="new_desc" placeholder="nouvelle description">
        <button type="submit" name="submit">éffectuer les changements</button>
        <button name="home">home</button>
    </form>
    
</body>
</html>