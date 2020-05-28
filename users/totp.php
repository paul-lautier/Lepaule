<?php 
require '../function/connexion_test.php';
require '../function/kill_session.php';
session_start();
$username = $_SESSION['connected'];
?>


<?php


$database_host = 'localhost';
$database_port = '3306';
$database_dbname = 'lepaule';
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



if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}
else{

    $token = rand(1000,9999);
    $query_save_token = $pdo->prepare("UPDATE totp SET token = :token WHERE email = :email");
    $query_save_token->bindParam(':token',$token);
    $query_save_token->bindParam(':email',$email);
    $query_save_token->execute();
}



        


$query_get_email = $pdo->prepare('SELECT email FROM users WHERE username = :username');
$query_get_email->bindParam(':username',$username);
$query_get_email->execute();
$email = implode($query_get_email->fetch());


$vide ='';


// $objet = 'token de sécurité pour la connexion au site de lépaule';
// $message = "Votre token de sécurité est : " . $token;
// $headers = 'From: lepaule.ynov.com';
// var_dump($message);
// mail(implode($email),$objet,$message,$headers);



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<body>

<form action="totp.php" method="post">
    <input type="text" name="enter_token" placeholder="token">
    <button name="login">login</button>

</form>

    
</body>
</html>

<?php   

if(isset($_POST['login'])){
    $token_user = htmlspecialchars($_POST['enter_token']);

    $query_get_token = $pdo->prepare("SELECT token FROM totp WHERE email = :email");
    $query_get_token->bindParam(':email',$email);
    $query_get_token->execute();
    $token_server = implode($query_get_token->fetch());
        
    if ($token_user == $token_server){

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
var_dump($token_user);
var_dump($token_server);

?>