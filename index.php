<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
    <title>L'épaule</title>
</head>
<body>
<form action="" method="post">
    <button name="login">login</button> 
    <button name="register">register</button>
</form>

    
</body>
</html>

<?php

if (isset($_POST['login'])){
    header('Location: login.php');
    exit;
}
if (isset($_POST['register'])){
    header('Location: register.php');
    exit;
}
?>