<?php

session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}

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
$username = $_SESSION['connected'];

$querry_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$querry_get_id->bindParam(':username',$username);
$querry_get_id->execute();
$user_id = implode($querry_get_id->fetch());

$query_is_modo = $pdo->prepare('SELECT is_modo from subs_details where users_id = :users_id');
$query_is_modo->BindParam(':users_id',$user_id);
$query_is_modo->execute();
$is_modo = $query_is_modo->fetch();

$query_sub_name = $pdo->prepare('SELECT sub_name from subs where createur = :username');
$query_sub_name->BindParam(':username',$username);
$query_sub_name->execute();

$query_compte_is_modo = $pdo->prepare('SELECT ')


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>


<?php echo 'nom de vos subs :';
while($sub1 = $query_sub_name->fetch()){
    echo '<tr>';
    
    foreach($sub1 as $sub_name){
        echo '<tr>'.' '.$sub_name.' '. '|'.'<tr>';

    }

    echo '</tr>';
    }
echo '</br>';


if(isset($_POST['del_sub'])){
   
    $a_suppr = $_POST['a_suppr'];
    $query_del = $pdo->prepare("DELETE FROM subs WHERE sub_name = :a_suppr");
    $query_del->bindParam(':a_suppr',$a_suppr);
    $query_del->execute();
    header("Refresh:0");
    
}
if(isset($_POST['home'])){
    header('Location: ../users/home_users.php');
}

?>
   

<form action="del_sub.php" method="post">
    <input type="text" placeholder="sub a supprimer" name="a_suppr">
    <button type="submit" name="del_sub">supprimer le sub</button>
    <button name="home">home</button>
</form>
    
</body>
</html>