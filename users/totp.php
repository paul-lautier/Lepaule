<?php


require '../bdd.php';
require '../function/connexion_test.php';
require '../function/kill_session.php';
session_start();
$username = $_SESSION['connected'];

if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}



$query_get_email = $pdo->prepare('SELECT email FROM users WHERE username = :username');
$query_get_email->bindParam(':username',$username);
$query_get_email->execute();
$email = implode($query_get_email->fetch());






?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<body>

<form action="totp.php" method="post">

    <button name="create_token">générer token</button>
    <input type="text" name="enter_token" placeholder="token">
    <button name="login" type="submit">login</button>

</form>

    
</body>
</html>

<?php   
    

if(isset($_POST['create_token'])){
    $token = rand(1000,9999);
    $query_save_token = $pdo->prepare("UPDATE totp SET token = :token WHERE email = :email");
    $query_save_token->bindParam(':token',$token);
    $query_save_token->bindParam(':email',$email);
    $query_save_token->execute();
}


if(isset($_POST["login"])){

    $token_user = htmlspecialchars($_POST['enter_token']);


    $query_get_token = $pdo->prepare("SELECT token FROM totp WHERE email = :email");
    $query_get_token->bindParam(':email',$email);
    $query_get_token->execute();
    $token_server = $query_get_token->fetch();



    if($token_user == implode($token_server)){

        $query_delete_token = $pdo->prepare("UPDATE totp SET token = 0 WHERE email = :email");
        $query_delete_token->bindParam(':email',$email);
        $query_delete_token->execute();
        
        header('Location: home_users.php');
        exit;
    }
    else{
        echo("le token de sécurité n'est pas valide");
        
    }
}



?>