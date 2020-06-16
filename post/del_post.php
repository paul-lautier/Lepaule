<?php

session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}

require '../bdd.php';
$username = $_SESSION['connected'];

$querry_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$querry_get_id->bindParam(':username',$username);
$querry_get_id->execute();
$user_id = implode($querry_get_id->fetch());

$query_is_modo = $pdo->prepare('SELECT is_modo from subs_details where users_id = :users_id');
$query_is_modo->BindParam(':users_id',$user_id);
$query_is_modo->execute();
$is_modo = $query_is_modo->fetch();

$query_post_name = $pdo->prepare('SELECT * from post where author = :username');
$query_post_name->BindParam(':username',$username);
$query_post_name->execute();
$fetch_post = $query_post_name->fetchAll();

if(isset($_GET["delete"]) and !empty($_GET["delete"])){
    $post_id = (int) $_GET["delete"];

    $post_details_delete = $pdo->prepare('DELETE FROM posts_details WHERE post_id = :post_id');
    $post_details_delete->bindParam(':post_id',$post_id);
    $post_details_delete->execute();

    $post_delete = $pdo->prepare('DELETE FROM post WHERE post_id = :post_id');
    $post_delete->bindParam(':post_id',$post_id);
    $post_delete->execute();

    header('Location: ../users/profile_users.php');

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>


    <table>
    <tr>

    <th>titre de vos post :</th>
    <th> supprimer:</th>
    </tr>
    <?php 
    foreach($fetch_post as $post){?>

    <tr>
        <td> <?= $post["post_title"] ;?> </td>
        <td><a href="del_post.php?delete=<?= $post["post_id"]; ?>">supprimer</a></td>
    </tr>

    <?php } ?>

    <form action="../users/profile_users.php" >
        <button name="home">home</button>
    </form>

</table>
</body>
</html>