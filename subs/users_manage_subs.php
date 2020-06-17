<?php
session_start();
require '../bdd.php';
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}
$username = $_SESSION['connected'];
if(isset($_POST['del_sub'])){

    $query_compte_is_créateur = $pdo->prepare('SELECT createur FROM subs WHERE createur = :username');
    $query_compte_is_créateur->bindParam(':username',$username);
    $query_compte_is_créateur->execute();
    if($query_compte_is_créateur->rowCount() == 0){
        header('Location: ../users/profile_users.php');
    }
    else{
        header('Location: ./del_sub.php');
    }
        
    
   
}
if(isset($_POST['manage_modo'])){
    header('Location: ./manage_modo.php');
}
if(isset($_POST['change_info'])){
    header('Location: ./select_subs.php');
}
if(isset($_POST['home'])){
    header('Location: ../users/home_users.php'); 
}
if(isset($_POST['posts'])){
    header('Location: ../post/posts.php'); 
}
if(isset($_POST['add_sub'])){
    header('Location: ../subs/create_sub.php'); 
}
if(isset($_POST['del_posts'])){
    header('Location: ../post/del_post.php'); 
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>manage_contenu</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/Custom-Checkbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
</head>
<body>


    <form action="users_manage_subs.php" method="post">
        <button name="del_sub">supprimer un sub</button>
        <button name="manage_modo">gérer les modérateur</button>
        <button name="change_info">gérer les info du sub</button>
        <button name="home">home</button>


    
    </form>
</body>
<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top border rounded float-none navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;">
        <div class="container-fluid"><a class="navbar-brand" href="../users/home_users.php" style="filter: blur(0px);width: 182px;margin: -18px;">&nbsp;<img data-bs-hover-animate="bounce" src="../assets/img/shoulder_img.png">&nbsp; &nbsp;L'Epaule</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="float-left float-md-right mt-5 mt-md-0 search-area"><i class="fas fa-search float-left search-icon"></i><input class="float-left float-sm-right custom-search-input" type="search" placeholder="Type to filter by address" style="padding: 00x;height: 35px;width: 1123px;"></div><a class="d-xl-flex justify-content-xl-end"
            style="color: #ffffff;" href=""><i class="fa fa-user" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Profil</a><a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="#"><i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Log Out</a></div>
    </nav>
    <div class="features-boxed" style="height: 1080px;width: 1920;">
        <div class="container">
            
            <div class="intro"></div>
            <div class="row justify-content-center features" style="margin: 65px;padding: 100px;">
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-list-ul icon"></i>
                        <h3 class="name">Gérer vos Aisselles</h3>
                        <p class="description">Supprimer les Aisselles que vous avez créé<br><br><br></p><form method="post"><button class="btn btn-primary"name="del_sub">Aller à</button></form></div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-pencil icon"></i>
                        <h3 class="name">Gérer vos Posts</h3>
                        <p class="description">Voir et supprimer vos Posts</p><form method="post"><button class="btn btn-primary" name="del_posts">Aller à</button></form></div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-list-alt icon"></i>
                        <h3 class="name">Gérer les infos de vos Aisselles</h3>
                        <p class="description">Modifier la description ou le nom de vos Aisselles</p><form method="post"><button class="btn btn-primary" name="change_info">Aller à</button></form></div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-plus icon"></i>
                        <h3 class="name">Créer une Aisselle</h3>
                        <p class="description">Création d'un espace de discussion réunissant plusieurs posts autour d'un sujet</p><form method="post"><button class="btn btn-primary" name="add_sub">Aller à</button></form></div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-user icon"></i>
                        <h3 class="name">Gérer vos Modérateurs</h3>
                        <p class="description">Ajouter et/ou supprimer des modérateurs de vos Aisselles</p><form method="post"><button class="btn btn-primary" name="manage_modo">Aller à</button></form></div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-comment icon"></i>
                        <h3 class="name">Créer un Post</h3>
                        <p class="description">Création d'un post dans une Aisselle, relatif au sujet de cette dernière<br><br></p><form method="post"><button class="btn btn-primary" name="posts">Aller à</button></div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>


