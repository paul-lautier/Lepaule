<?php
session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}
require '../bdd.php';


if(isset($_POST['add_modo']) and !empty($_POST['new_modo'])){
    if($query_id_modo->rowCount() !== 0){
        echo 'non';

    }





    else{
    $query_add_modo = $pdo->prepare('INSERT INTO subs_details (users_id,sub_id,is_modo) VALUES (:users_id, :sub_id,:is_modo)');
    $query_add_modo->bindParam(':users_id',$users_id);
    $query_add_modo->bindParam(':sub_id',$sub_id);
    $query_add_modo->bindParam(':is_modo',$is_modo);
    $query_add_modo->execute();
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
    


<form action="manage_modo.php" method="post">
    <input type="text" placeholder="nom d'utilisateur" name="new_modo">
    <button name="add_modo" type="submit">ajouter en tant que modérateur</button>
</form>
</body>
</html>