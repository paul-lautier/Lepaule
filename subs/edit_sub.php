<?php
session_start();

if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}
require '../bdd.php';
$username = $_SESSION['connected'];
$sub_id = (int) $_GET["id"];





if(isset($_POST['submit'])){
    $new_name = $_POST['new_name'];
    $new_desc = $_POST["new_desc"];


    $query_change_desc = $pdo->prepare('UPDATE subs SET description_sub = :new_desc WHERE sub_id = :sub_id');
    $query_change_desc->bindParam(':description_sub',$new_desc);
    $query_change_desc->bindParam(':sub_id',$sub_id);


    $query_change_name = $pdo->prepare('UPDATE subs SET sub_name = :new_name WHERE sub_id = :sub_id');
    $query_change_name->bindParam(':new_name',$new_name);
    $query_change_name->bindParam(':sub_id',$sub_id);

    if(empty($_POST['new_name'])){
        $query_change_desc->execute();
        
        echo "<script type='text/javascript'>alert('la nouvelle description a bien été mid à jour');</script>";
    }
    if(empty($_POST['new_desc'])){
        $query_change_name->execute();

        echo "<script type='text/javascript'>alert('le nom du sub a bien été mis à jour');</script>";
    }
    if(!empty($_POST['new_name']) and !empty($_POST['new_desc'])){
        $query_change_name->execute();
        $query_change_desc->execute();

        echo "<script type='text/javascript'>alert('les informations ont été mis à jour');</script>";
        header('Location: ./manage_subs.php');
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>
    <form method="post">
        <input type="text" placeholder="nouveau nom" name="new_name">
        <input type="text" placeholder="nouvelle description" name="new_desc">
        <button type="submit" name="submit">éffectuer les changements</button>
    </form>
</body>
</html>