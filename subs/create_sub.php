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

if(isset($_POST['home'])){
    header('Location: ../users/home_users.php');
}
$description_sub = $_POST['description_sub'];
$sub_name = $_POST['sub_name'];

if(isset($_POST['create_sub'])){

    $check_sub_name = $pdo->prepare("SELECT sub_name FROM subs where sub_name = :sub");
    $check_sub_name->bindParam(':sub',$sub_name);
    $check_sub_name->execute();
    

    if($check_sub_name -> rowCount() > 0){
        echo "<script type='text/javascript'>alert('un sub porte déjà ce nom');</script>";
    }
    else{
        $query_add_sub = $pdo->prepare("INSERT INTO subs (sub_name, description_sub, createur) VALUES (:sub_name, :description_sub, :createur)");
        $query_add_sub->bindParam(':sub_name',$sub_name);
        $query_add_sub->bindParam(':description_sub',$description_sub);
        $query_add_sub->bindParam(':createur',$username);
        $query_add_sub->execute();

        $querry_get_sub_id = $pdo->prepare('SELECT sub_id from subs where createur = :username');
        $querry_get_sub_id->bindParam(':username',$username);
        $querry_get_sub_id->execute();
        $sub_id = implode($querry_get_sub_id->fetch());
    
        
        $query_add_créateur = $pdo->prepare("INSERT INTO createur_details (users_id, sub_id) VALUES (:users_id, :sub_id)");
        $query_add_créateur->bindParam(':users_id',$user_id);
        $query_add_créateur->bindParam(':sub_id',$sub_id);
        $query_add_créateur->execute();
    
    
        echo "<script type='text/javascript'>alert('le sub a bien été crée');</script>";

    }

    

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>create_sub</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-1.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-2.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-3.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs-4.css">
    <link rel="stylesheet" href="../assets/css/Material-Inputs.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
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
<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top border rounded float-none navigation-clean-button" style="height: 80px;background-color: #37434d;color: #ffffff;">
        <div class="container-fluid"><a class="navbar-brand" href="../users.home_users.php" style="filter: blur(0px);width: 182px;margin: -18px;">&nbsp;<img data-bs-hover-animate="bounce" src="shoulder_img.png">&nbsp; &nbsp;L'Epaule</a><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="float-left float-md-right mt-5 mt-md-0 search-area"><i class="fas fa-search float-left search-icon"></i><input class="float-left float-sm-right custom-search-input" type="search" placeholder="Type to filter by address" style="padding: 00x;height: 35px;width: 1123px;"></div><a class="d-xl-flex justify-content-xl-end"
            style="color: #ffffff;" href="../users/profile_users.php"><i class="fa fa-user" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Profil</a><a class="d-xl-flex justify-content-xl-end" style="color: #ffffff;width: 80;margin: 0;" href="#"><i class="fa fa-sign-in" style="height: -5px;width: 13px;padding: 4px;"></i>&nbsp; Log Out</a></div>
    </nav>
    <div>
        <div class="row">
            <div class="col-md-4 m-auto">
                <section class="card" style="margin: 75px;">
                    <h1>Création d'Aisselle</h1>
                    <form method="post">
                        <div class="md-input-group"><input class="form-control md-input" type="text" placeholder="Nom de l'Aisselle" name="sub_name">
                            <div class="md-messages"><span class="md-message src-only">User name is required</span></div>
                        </div>
                        <div class="md-input-group"><input class="form-control md-input" type="text" placeholder="Description" name="description_sub">
                            <div class="md-messages"><span class="md-message src-only">Password is requred</span></div>
                        </div>
                        <button class="btn btn-primary btn-block md-btn" name="create_sub">Valider</button></section>
                    </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Material-Inputs.js"></script>
</body>

