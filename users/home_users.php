<?php 
require '../function/connexion_test.php';
require '../function/kill_session.php';

if (!is_connected()){
    header('Location: ../connexion.php');

}
?>

<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>home</title>
</head>
<body>

    <form action="" method="post">
        <button name="logout">log out</button>
        <button name="profile">accéder au profile</button>
    </form>

</body>
</html>

<?php
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
?>