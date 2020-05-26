<?php



require '../function/connexion_test.php';


if (!is_connected()){
    header('Location: ../connexion.php');
}

session_start();


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

$query_compte = $pdo->prepare('select title  from offres where entreprise = :username');
$query_compte->bindParam(':username',$username);
$query_compte->execute();


$query_description = $pdo->prepare('select description from offres where entreprise = :username');
$query_description->bindParam(':username',$username);
$query_description->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table>

<?php 
echo 'intitulé des postes :';
while($compte1 = $query_compte->fetch()){
    echo '<tr>';
    
    foreach($compte1 as $compte_title){
        echo '<tr>'.' '.$compte_title.' '. '|'.'<tr>';

    }

    echo '</tr>';
    }
echo '</br>';

echo 'descriptions des postes :';
while($compte2 = $query_description->fetch()){
    echo '<tr>';
    
    foreach($compte2 as $compte_desc){
        echo '<tr>'.' '.$compte_desc.' '.'|'.'<tr>';

    }

    echo '</tr>';
    }

    
    ?>
</table>




    <a href="./home_donneur.php">retour home</a>
</body>
</html>