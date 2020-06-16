<?php

require './bdd.php';



if (isset ($_POST["connexion"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars(md5($_POST["password"]));
}

$query_verif_user = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$query_verif_user->bindParam(':username',$username);
$query_verif_user->bindParam(':password',$password);
$query_verif_user->execute();

$query_verif_totp = $pdo->prepare("SELECT is_totp FROM users WHERE username = :username AND password = :password");
$query_verif_totp->bindParam(':username',$username);
$query_verif_totp->bindParam(':password',$password);
$query_verif_totp->execute();
$is_totp = $query_verif_totp->fetch();

$query_verif_admin = $pdo->prepare('SELECT * FROM admins WHERE username = :username AND password = :password');
$query_verif_admin->bindParam(':username',$username);
$query_verif_admin->bindParam(':password',$password);
$query_verif_admin->execute();






if (!empty($_POST['username']) && !empty($_POST['password'])){

    
    if ($query_verif_user->rowCount()>0 && $query_verif_admin->rowCount() == 0){


        
        if (implode($is_totp) === 'oui'){
            session_start();
            $_SESSION['connected'] = $username;
            header('Location: ./users/totp.php');
            exit();
        }
        elseif (implode($is_totp) === 'non'){
            session_start();
            $_SESSION['connected'] = $username;
            header('Location: ./users/home_users.php');
            exit;
        }

    }
    elseif ($query_verif_admin->rowCount() > 0 && $query_verif_user->rowCount() == 0){
        session_start();
        $_SESSION['connected'] = $username;
        header('Location: ./admin/home_admin.php');
        exit;

    }
    elseif ($query_verif_user->rowCount() == 0 && $query_verif_admin->rowCount() == 0){
        echo "<script type='text/javascript'>alert('l\'identifiant et le mot de passe ne correspondent pas');</script>";
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
<form action="login.php" method="post">
        <input type="username" placeholder="username" name ="username">
        <input type="password"placeholder="password" name="password">
        <button action="submit" name="connexion">login</button><br>
       



        <button name="home">home</button>
        
    </form>
</body>
</html>

<?php 

if (isset($_POST['home'])){
    header('Location: index.php');
}
?>