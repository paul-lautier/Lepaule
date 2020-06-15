<?php 
require '../function/connexion_test.php';
require '../function/kill_session.php';

if (!is_connected()){
    header('Location: ../connexion.php');

}
if (isset($_POST['logout'])){
    deconnect();
    header('Location: ../index.php');
}

if (isset($_POST['profile'])){
    header('Location: profile_users.php');
}

if (isset($_POST['voir_offres'])){
    header('Location: voir_offres.php');
}
if (isset($_POST['subs'])){
    header('Location: ./content.php');
}
if (isset($_POST['posts'])){
    header('Location: ./posts.php');
}
?>

<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>home</title>
</head>
<body>

    <form action="home_users.php" method="post">
        <button name="logout">log out</button>
        <button name="profile">accéder au profile</button>
        <button name="subs">afficher les subs</button>
        <button name="posts">crée une post</button>
    </form>




</body>
</html>
