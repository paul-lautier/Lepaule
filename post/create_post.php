<?php
session_start();
require '../function/connexion_test.php';
if (!is_connected()){
    header('Location: ../connexion.php');
}
require '../bdd.php';
$username = $_SESSION['connected'];
$sub_id = $_GET['id'];

$querry_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$querry_get_id->bindParam(':username',$username);
$querry_get_id->execute();
$user_id = implode($querry_get_id->fetch());

if(isset($_POST['submit']) and !empty($_POST['post_title']) and !empty($_POST['post_content'])){
    $content = $_POST['post_content'];
    $post_title = $_POST['post_title'];
    $mature_content = $_POST['mature_content'];
    if (is_null($mature_content)){
        $mature_content = 0;
    }

    $query_create_post = $pdo->prepare('INSERT INTO post (post_title,author,mature_content,content) VALUES (:post_title, :author, :mature_content, :content)');
    $query_create_post->bindParam(':post_title',$post_title);
    $query_create_post->bindParam(':author',$username);
    $query_create_post->bindParam('mature_content',$mature_content);
    $query_create_post->bindParam(':content',$content);
    $query_create_post->execute();

    $query_post_id = $pdo->prepare('SELECT post_id from post where post_title = :post_title');
    $query_post_id->bindParam(':post_title',$post_title);
    $query_post_id->execute();
    $post_id = implode($query_post_id->fetch());

    $query_link_post = $pdo->prepare('INSERT INTO posts_details (post_id,sub_id,users_id) VALUES(:post_id,:sub_id,:users_id)');
    $query_link_post->bindParam(':post_id',$post_id);
    $query_link_post->bindParam(':sub_id',$sub_id);
    $query_link_post->bindParam('users_id',$user_id);
    $query_link_post->execute();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'épaule</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="titre du post" name="post_title">
        <input type="text" placeholder="contenue du post" name="post_content">
        <input type="checkbox" name="mature_content" value="1"/> contenue mature <br/><br/>
        <button type="submit" name="submit">crée le post</button>
    </form>
    
</body>
</html>