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


require '../function/connexion_test.php';
require '../function/kill_session.php';
if (!is_connected()){
    header('Location: ../connexion.php');
}
$username = $_SESSION['connected']

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pol Emploie</title>
</head>
<body>
    <form action="" method="post">
        <button name="delete">supprimez votre compte</button>


    </form>
    
</body>
</html>

<?php



if (isset($_POST['delete'])){
    $querry_delete = $pdo->prepare("DELETE FROM users where username = :username");
    $querry_delete->bindParam(':username',$username);
    $querry_delete->execute();
    deconnect();
    header('Location: ../index.php');
}
?>