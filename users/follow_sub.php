<?php
session_start();
require '../bdd.php';
$username = $_SESSION['connected'];

$query_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$query_get_id->bindParam(':username',$username);
$query_get_id->execute();
$user_id = implode($query_get_id->fetch());

$sub_id = (int) $_GET["id"];

    $query_follow_sub = $pdo->prepare('INSERT INTO subs_details (users_id,sub_id) VALUES (:user_id,:sub_id)');
    $query_follow_sub->bindParam(':user_id',$user_id);
    $query_follow_sub->bindParam(':sub_id',$sub_id);
    $query_follow_sub->execute();
    header('Location: ./content.php');
    

?>