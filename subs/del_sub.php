<?php

session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}

$username = $_SESSION['connected'];

$query_is_modo = $pdo->prepare('SELECT modérateur from users where username = :username');
$query_is_modo->BindParam(':username',$username);
$query_is_modo->execute();
$is_modo = $query_is_modo->fetch();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>

<form action="del_sub.php" method="post">

</form>
    
</body>
</html>