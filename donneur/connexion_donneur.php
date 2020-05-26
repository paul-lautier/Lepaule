<?php require '../function/connexion_test.php'; ?>

<?php
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



if (isset ($_POST["connexion"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars(md5($_POST["password"]));
}

$query_verif = $pdo->prepare("SELECT * FROM companies WHERE username = ? AND password = ?");
$query_verif->execute([$username,$password]);

if (is_connected()){
    header('Location: ./home_donneur.php');
}

if (!empty($_POST['username']) && !empty($_POST['password'])){
    if ($query_verif->rowCount()>0){
        session_start();
        $_SESSION['connected'] = $username;
        header('Location: ./home_donneur.php');
        exit;

    }
    elseif ($query_verif->rowCount() == 0){
        echo "<script type='text/javascript'>alert(l identifiant et le mot de passe ne correspondent pas);</script>";
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
        <input type="username" placeholder="nom de l'entreprise" name ="username">
        <input type="password"placeholder="password" name="password">
        <button action="submit" name="connexion">se connecter</button>
    </form>
</body>
</html>