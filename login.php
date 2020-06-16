<?php
require './bdd.php';
if (isset ($_POST["connexion"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars(md5($_POST["password"]));



}

$query_verif_user = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$query_verif_user->bindParam(':username',$username);
$query_verif_user->bindParam(':password',$password);
$query_verif_user->execute();

$query_verif_totp = $pdo->prepare("SELECT is_totp FROM users WHERE username = :username AND password = :password");
$query_verif_totp->bindParam(':username',$username);
$query_verif_totp->bindParam(':password',$password);
$query_verif_totp->execute();
$is_totp = $query_verif_totp->fetch();

$query_verif_admin = $pdo->prepare('SELECT * FROM admins WHERE username = :username AND password = :password');
$query_verif_admin->bindParam(':username',$username);
$query_verif_admin->bindParam(':password',$password);
$query_verif_admin->execute();

if (!empty($_POST['username']) && !empty($_POST['password'])){

    
    if ($query_verif_user->rowCount()>0 && $query_verif_admin->rowCount() == 0){


        
        if (implode($is_totp) === 'oui'){
            session_start();
            $_SESSION['connected'] = $username;
            header('Location: ./users/totp.php');
            exit();
        }
        elseif (implode($is_totp) === 'non'){
            session_start();
            $_SESSION['connected'] = $username;
            header('Location: ./users/home_users.php');
            exit;
        }

    }
    elseif ($query_verif_admin->rowCount() > 0 && $query_verif_user->rowCount() == 0){
        session_start();
        $_SESSION['connected'] = $username;
        header('Location: ./admin/home_admin.php');
        exit;

    }
    elseif ($query_verif_user->rowCount() == 0 && $query_verif_admin->rowCount() == 0){
        echo "<script type='text/javascript'>alert('l\'identifiant et le mot de passe ne correspondent pas');</script>";
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Form-Select---Full-Date---Month-Day-Year.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Box-En.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar.css">

 
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
        <a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="register.php">
        <i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>  
          Register
    </a>
</div>
</nav>
    <div class="register-photo">
        <div class="form-container"></div>
    </div>
    <div class="register-photo">
        <div class="form-container">
            <form method="post">
                <h2 class="text-center"><strong>Connexion</strong></h2>
                <div class="form-group"><input class="form-control" type="text" name="username" placeholder="username"></div>
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="connexion">Connexion au compte</button></div>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>
</html>