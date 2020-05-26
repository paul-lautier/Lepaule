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

$query_compte = $pdo->prepare('select title from offres ');
$query_compte->execute();



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
   
    ?>
</table>

<form action="" method="post">
    <input type="text" name="a_suppr" placeholder="offre a supprimer">
    <button type="submit">supprimer cette offre</button>
</form>


    <a href="./home_admin.php">retour home</a>
</body>
</html>

<?php
if(isset($_POST['a_suppr'])){
    $a_suppr = $_POST['a_suppr'];
    $query_del = $pdo->prepare("DELETE FROM offres WHERE title = :a_suppr");
    $query_del->bindParam(':a_suppr',$a_suppr);
    $query_del->execute();
    header("Refresh:0");
}
?>