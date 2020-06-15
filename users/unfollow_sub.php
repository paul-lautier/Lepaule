<?php
session_start();
require '../bdd.php';
$username = $_SESSION['connected'];

$query_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$query_get_id->bindParam(':username',$username);
$query_get_id->execute();
$user_id = implode($query_get_id->fetch());

$sub_id = (int) $_GET["id"];

    $query_unfollow_sub = $pdo->prepare('DELETE FROM subs_details WHERE users_id = :user_id AND sub_id = :sub_id');
    $query_unfollow_sub->bindParam(':user_id',$user_id);
    $query_unfollow_sub->bindParam(':sub_id',$sub_id);
    $query_unfollow_sub->execute();
    header('Location: ./content.php');

?>