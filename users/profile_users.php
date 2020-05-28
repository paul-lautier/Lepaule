<?php
session_start();


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

require '../function/connexion_test.php';

// if (!is_connected()){
//     header('Location: connexion.php');
// }

$username = $_SESSION['connected'];

$querry_get_info = $pdo->prepare("SELECT email FROM users WHERE username = :username");
$querry_get_info->bindParam(':username',$username);
$querry_get_info->execute();
$email = implode($querry_get_info->fetch());


$set_totp = 'oui';
$del_totp = 'non';
$vide = '';
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pol Emploie</title>
</head>
<body>
    nom d'utilisateur : <?php echo $username?><br>
    addresse email : <?php echo $email?><br>



    <form action="" method="post">
        <button name="change_pass">changer son mot de passe</button>
        <button name="sup_compte">supprimer votre compte</button>
        <button name="totp">activer l'authentification à deux facteurs</button>
        <button name="home">home</button>

    </form>
<a href="./change_pass.php"></a><br>
<a href="./sup_compte.php"></a>
    
</body>
</html>

<?php
if (isset($_POST['change_pass'])){
    header('Location: change_pass.php');
}

if (isset($_POST['sup_compte'])){
    header('Location: sup_compte.php');
}
if (isset($_POST['home'])){
    header('Location: home_users.php');
}
if (isset($_POST['totp'])){
    $query_add_totp = $pdo->prepare("UPDATE users SET is_totp = :new_totp WHERE username = :username");
    $query_add_totp->bindParam(':new_totp',$set_totp);
    $query_add_totp->bindParam(':username',$username);
    $query_add_totp->execute();

    $query_add_token = $pdo->prepare("INSERT INTO totp (email,token) VALUES(:email,:token)");
    $query_add_token->bindParam(':email',$email);
    $query_add_token->bindParam(':token',$vide);
    $query_add_token->execute();

    echo "<script type='text/javascript'>alert('le double authantification est maitenant activé');</script>";
}
?>