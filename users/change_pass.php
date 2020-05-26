<?php
session_start();

require '../function/connexion_test.php';

if (!is_connected()){
    header('Location: ../connexion.php');
}


$database_host = 'localhost';
$database_port = '3306';
$database_dbname = 'login';
$database_user = 'root';
$database_password = 'Paul@123';
$database_charset = 'UTF8';
$database_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

$pdo = new PDO(
    'mysql:host=' . $database_host .
    ';port=' . $database_port .
    ';dbname=' . $database_dbname .
    ';charset=' . $database_charset,
    $database_user,
    $database_password,
    $database_options
);


$username = $_SESSION['connected'];

?>

    <form method="post">
        
        <input type="password" name="old_pass" placeholder="mot de passe actuel">
        
        <input type="password" name="new_pass" placeholder="nouveau mot de passe">

        <input type="password" name="new_pass_verif" placeholder="comfirmation nouveau mot de passe">

        <button type="submit">changer le mot de passe</button>
    </form>
    

<?php

if (isset($_POST["old_pass"]) && isset($_POST["new_pass"]) && isset($_POST["new_pass_verif"])){
  
    $old_pass = htmlspecialchars(md5($_POST['old_pass']));
    $new_pass = htmlspecialchars(md5($_POST['new_pass']));
    $new_pass_verif = htmlspecialchars(md5($_POST['new_pass_verif']));
    
   

    $query_verif_old_pass = $pdo->prepare("SELECT password from users where password = :password");
    $query_verif_old_pass->bindParam(':password',$old_pass);
    $query_verif_old_pass->execute();

    if (!isset($_POST["old_pass"]) && !isset($_POST["new_pass"]) && !isset($_POST["new_pass_vérif"])){
        echo "<script type='text/javascript'>alert('veuillez remplir les champs');</script>";
    }

    if ($query_verif_old_pass->rowCount() == 0){
        echo "<script type='text/javascript'>alert('votre ancien mot de passe ne correspond pas');</script>";
        }

    if ($new_pass !== $new_pass_verif) {
        echo "<script type='text/javascript'>alert('les deux mot de passes ne correspondent pas');</script>";
    }

    else{
        

        $querry_change_info = $pdo->prepare("UPDATE users SET password = :password WHERE password = :old_pass");
        $querry_change_info->bindparam(":password", $new_pass);
        $querry_change_info->bindparam(":old_pass", $old_pass);
        $querry_change_info->execute();
        echo "<script type='text/javascript'>alert('changement éffectué');</script>";
        }

    }


?>