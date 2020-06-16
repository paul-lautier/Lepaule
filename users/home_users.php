<?php 
session_start();
require '../function/connexion_test.php';
require '../function/kill_session.php';
require '../bdd.php';
$username = $_SESSION['connected'];

$query_affiche_post = $pdo->prepare('SELECT * FROM post');
$query_affiche_post->execute();
$fetch_post = $query_affiche_post->fetchAll();

?>

<!doctype html>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>L'épaule</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/Card-Group1-Shadow.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md sticky-top border rounded float-none navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="filter: blur(0px);width: 182px;margin: -18px;">
            &nbsp;<img data-bs-hover-animate="bounce" src="../assets/img/shoulder_img.png">
            &nbsp; &nbsp;L'Epaule
        </a><button class="navbar-toggler" data-toggle="collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span></button>
            <div class="float-left float-md-right mt-5 mt-md-0 search-area">
                <i class="fas fa-search float-left search-icon"></i>
                <input class="float-left float-sm-right custom-search-input" type="search" placeholder="Type to filter by address" style="padding: 00x;height: 35px;width: 1123px;">
            </div>
            <a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="./profile_users.php">
            <i class="fa fa-user" style="height: -5px;width: 13px;padding: 4px;"></i>
            &nbsp; Profile</a>
            <a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="../logout.php">
            <i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; LogOut</a></div>
    </nav>
    <section>
        <a href="../post/posts.php" style="margin: 24px;">
        <i class="fas fa-plus-circle"></i>Crée un Post</a>
        <a href="../subs/create_sub.php" style="margin: 24px;">
        <i class="fas fa-plus-circle"></i>Crée une aisselle</a>
        
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>

    <?php 
    foreach($fetch_post as $post){?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 box-shadow rounded-0">
                        <div class="card-body">
                            <h4 class="card-title"><?= $post["post_title"] ;?></h4>
                            <p class="card-text"><?= $post['content'] ;?></p>
                    </div>
                </div>
        </div>
    </div>
    </section>
    <?php } ?>
</body>

</html>