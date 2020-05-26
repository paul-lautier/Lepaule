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

    $query_username = $pdo->prepare('SELECT username from users ');
    $query_username->execute();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin utilisateur</title>
</head>
<body>

<table>
<?php 
echo 'nom utilisateur des comptes utilisateur :';
while($compte = $query_username->fetch()){
    echo '<tr>';
    
    foreach($compte as $compte_username){
        echo '<tr>'.' '.$compte_username.' '. '|'.'<tr>';

    }

    echo '</tr>';
    }
echo '</br>';
?>


</table>

<form action="" method="post">
    <input type="text" name="a_suppr" placeholder="utilisateur a supprimer">
    <button type="submit">supprimer ce compte</button>
</form>

<form action="" method="post">
    <button name="home">home</button>
</form>
</body>
</html>

<?php 
if(isset($_POST['home'])){
    header('Location: ./home_admin.php');
}

if(isset($_POST['a_suppr'])){
    $a_suppr = $_POST['a_suppr'];
    $query_del = $pdo->prepare("DELETE FROM users WHERE username = :a_suppr");
    $query_del->bindParam(':a_suppr',$a_suppr);
    $query_del->execute();
    header("Refresh:0");
}

?>