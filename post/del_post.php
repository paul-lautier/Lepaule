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

    $query_delete_likes = $pdo->prepare('DELETE FROM likes');
    $query_delete_likes->execute();

    $query_delete_dislikes = $pdo->prepare('DELETE FROM dislikes');
    $query_delete_dislikes->execute();

    $post_details_delete = $pdo->prepare('DELETE FROM posts_details WHERE post_id = :post_id');
    $post_details_delete->bindParam(':post_id',$post_id);
    $post_details_delete->execute();

    $post_delete = $pdo->prepare('DELETE FROM post WHERE post_id = :post_id');
    $post_delete->bindParam(':post_id',$post_id);
    $post_delete->execute();

    header('Location: ./del_post.php');

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>select_sub</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/Grid-and-List-view-V10-1.css">
    <link rel="stylesheet" href="../assets/css/Grid-and-List-view-V10.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-1.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-2.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-3.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-4.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs.css">
    <link rel="stylesheet" href="../assets/css/Card-Group1-Shadow.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="../assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="../assets/css/Search-Input-responsive.css">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md sticky-top border rounded float-none navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;">
        <div class="container-fluid"><a class="navbar-brand" href="../users/home_users.php" style="filter: blur(0px);width: 182px;margin: -18px;">&nbsp;<img data-bs-hover-animate="bounce" src="../assets/img/shoulder_img.png">&nbsp; &nbsp;L'Epaule</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="float-left float-md-right mt-5 mt-md-0 search-area"><i class="fas fa-search float-left search-icon"></i><input class="float-left float-sm-right custom-search-input" type="search" placeholder="Type to filter by address" style="padding: 00x;height: 35px;width: 1123px;"></div><a class="d-xl-flex justify-content-xl-end"
            style="color: #ffffff;" href="../users/profile_users.php"><i class="fa fa-user" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Profil</a><a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="#"><i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Log Out</a></div>
    </nav>
    <div>
    
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="font-size: 25px;">Titre des posts&nbsp; &nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($fetch_post as $post){?>
                        <tr>
                            <td style="font-size: 20px;line-height: 60px;"><?= $post["post_title"] ;?></td>
                            <td><button class="btn btn-primary active text-center d-block pull-right" type="button" style="height: 61px;background-color: rgb(0,105,217);"><a href="del_post.php?delete=<?= $post["post_id"]; ?>">supprimer</a></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Grid-and-List-view-V10.js"></script>
    
</body>
</html>