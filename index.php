<?php

if (isset($_POST['login'])){
    header('Location: login.php');
    exit;
}
if (isset($_POST['register'])){
    header('Location: register.php');
    exit;
}
require 'bdd.php';

$query_affiche_post = $pdo->prepare('SELECT * FROM post');
$query_affiche_post->execute();
$fetch_post = $query_affiche_post->fetchAll();
?>

<!doctype html>

<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>LEpaule</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Card-Group1-Shadow.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<nav class="navbar navbar-light navbar-expand-md sticky-top border rounded float-none navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="filter: blur(0px);width: 182px;margin: -18px;">
        <img src="./assets/img/shoulder_img.png" />   L&#39;Epaule</a>
        <button class="navbar-toggler" data-toggle="collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="float-left float-md-right mt-5 mt-md-0 search-area">
            <i class="fas fa-search float-left search-icon"></i>
            <input class="float-left float-sm-right custom-search-input" type="search" placeholder="Type to filter by address" style="padding: 00x;height: 35px;width: 1123px;" />
        </div>
        <a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;" href="register.php">
        <i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>
          Register
        </a>
        <a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="login.php">
        <i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>  
          Login
    </a>
</div>
</nav>

<br>


<?php 
    foreach($fetch_post as $post){?>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $post["post_title"] ;?></h4>
                <h6 class="text-muted card-subtitle mb-2"></h6>
                <p class="card-text"><?= $post['content'] ;?></p>
                <p>par : <?= $post['author'];?></p>
                <p>sur : <?= $sub_name;?></p>
            </div>
        </div>

    <?php } ?>
    
    
</body>
</html>

