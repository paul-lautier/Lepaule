<?php
session_start();
$username = $_SESSION['connected'];
require '../bdd.php';


$querry_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$querry_get_id->bindParam(':username',$username);
$querry_get_id->execute();
$user_id = implode($querry_get_id->fetch());


if(isset($_GET['action'],$_GET['id'])){
    $avis = $_GET["action"];
    $post_id = $_GET['id'];

    $query_avis_neg = $pdo->prepare('SELECT post_id from dislikes where users_id = :user_id and post_id = :post_id');
    $query_avis_neg->bindParam(':user_id',$user_id);
    $query_avis_neg->bindParam(':post_id',$post_id);
    $query_avis_neg->execute();

    $query_avis_pos = $pdo->prepare('SELECT post_id from likes where users_id = :user_id and post_id = :post_id');
    $query_avis_pos->bindParam(':user_id',$user_id);
    $query_avis_pos->bindParam(':post_id',$post_id);
    $query_avis_pos->execute();


    if($avis=='like'){

            if($query_avis_pos->rowCount() == 0){

                $query_like = $pdo->prepare('INSERT into likes (post_id,users_id) values (:post_id,:user_id)');
                $query_like->bindParam(':post_id',$post_id);
                $query_like->bindParam(':user_id',$user_id);
                $query_like->execute();
            }

            elseif($query_avis_pos->rowCount() == 1){
                $query_unlike = $pdo->prepare('DELETE FROM likes where users_id = :user_id and post_id = :post_id');
                $query_unlike->bindParam(':user_id',$user_id);
                $query_unlike->bindParam(':post_id',$post_id);
                $query_unlike->execute();

            }
            elseif($query_avis_neg->rowCount() == 1){
                $query_undislike = $pdo->prepare('DELETE FROM dislikes where users_id = :user_id and post_id = :post_id');
                $query_undislike->bindParam(':user_id',$user_id);
                $query_undislike->bindParam(':post_id',$post_id);
                $query_undislike->execute();

                $query_like = $pdo->prepare('INSERT into likes (post_id,users_id) values (:post_id,:user_id)');
                $query_like->bindParam(':post_id',$post_id);
                $query_like->bindParam(':user_id',$user_id);
                $query_like->execute();
                
            }
        }

        if($avis=='dislike'){
 
            if($query_avis_neg->rowCount() == 1){

                $query_undislike = $pdo->prepare('DELETE FROM dislikes where users_id = :user_id and post_id = :post_id');
                $query_undislike->bindParam(':user_id',$user_id);
                $query_undislike->bindParam(':post_id',$post_id);
                $query_undislike->execute();
            }
            elseif($query_avis_neg->rowCount() == 0){
                $query_dislike = $pdo->prepare('INSERT into dislikes (post_id,users_id) values (:post_id,:user_id)');
                $query_dislike->bindParam(':post_id',$post_id);
                $query_dislike->bindParam(':user_id',$user_id);
                $query_dislike->execute();
            }
            elseif($query_avis_pos->rowCount() == 1){
                $query_unlike = $pdo->prepare('DELETE FROM likes where users_id = :user_id and post_id = :post_id');
                $query_unlike->bindParam(':user_id',$user_id);
                $query_unlike->bindParam(':post_id',$post_id);
                $query_unlike->execute();

                $query_dislike = $pdo->prepare('INSERT into dislikes (post_id,users_id) values (:post_id,:user_id)');
                $query_dislike->bindParam(':post_id',$post_id);
                $query_dislike->bindParam(':user_id',$user_id);
                $query_dislike->execute();

            }
        }
        header('Location: ../users/home_users.php');
    }
?>