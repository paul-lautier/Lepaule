<?php
session_start();
require '../function/connexion_test.php';
if (!is_connected()){
    header('Location: ../connexion.php');
}
require '../bdd.php';
$username = $_SESSION['connected'];
$sub_id = (int) $_GET['id'];


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

    echo "<script type='text/javascript'>alert('votre post a été créé ');</script>";
    header('location: ../users/home_users.php');


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>create_post</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/Custom-Checkbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-1.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-2.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-3.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-4.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Card-Group1-Shadow.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="../assets/css/Search-Input-responsive.css">
</head>

<body>
<body>
<nav class="navbar navbar-light navbar-expand-md fixed-top border rounded float-none navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;">
        <div class="container-fluid"><a class="navbar-brand" href="../index.php" style="filter: blur(0px);width: 182px;margin: -18px;">&nbsp;<img data-bs-hover-animate="bounce" src="../assets/img/shoulder_img.png">&nbsp; &nbsp;L'Epaule</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="float-left float-md-right mt-5 mt-md-0 search-area"><i class="fas fa-search float-left search-icon"></i><input class="float-left float-sm-right custom-search-input" type="search" placeholder="Type to filter by address" style="padding: 00x;height: 35px;width: 1123px;"></div><a class="d-xl-flex justify-content-xl-end"
            style="color: #ffffff;" href="../users/profile_users.php"><i class="fa fa-user" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Profil</a><a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="../logout.php"><i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Log&nbsp; Out</a></div>
    </nav>
    <div>

    <div class="row">
            <div class="col-md-4 m-auto">
                <section class="card" style="margin: 75px;">
                    <h1>Création de post</h1>
                    <form method="post">
                        <div class="md-input-group">
                        <input class="form-control md-input" type="text" name="post_title" placeholder="Titre du post">
                        <div class="md-input-group"></label><input class="form-control md-input" type="text" name="post_content" placeholder="Contenu">
                        </div>
                        <br>
                        <input type="checkbox" name="mature_content" value="1"/> contenu mature
                        <button class="btn btn-primary btn-block md-btn" name="submit">Valider</button></section>
                    </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Material-Inputs.js"></script>
    <form action="" method="post">

    
</body>
</html>