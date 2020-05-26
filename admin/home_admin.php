<?php 
require '../function/connexion_test.php';
require '../function/kill_session.php';

if (!is_connected()){
    header('Location: ../connexion.php');

}
session_start();
?>

<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
    



    <form action="" method="post">
        <button name="profile">accéder a votre profile</button>
 
    </form>

    <form action=""method="post">
        <button name="admin_users">compte utilisateurs</button>
    </form>

    <form action=""method="post">
        <button name="admin_comps">compte entreprise</button>
    </form>

    <form action=""method="post">
        <button name="logout">log out</button>
    </form>

    <form action=""method="post">
        <button name="voir_offre">voir les offres</button>
    </form>

    <form action=""method="post">
        <button name="del_offre">suppimer des offres</button>
    </form>

</body>
</html>

<?php
if (isset($_POST['logout'])){
    deconnect();
    header('Location: ../index.php');
}

if (isset($_POST['profile'])){
    header('Location: ./profile_admin.php');
}

if (isset($_POST['admin_users'])){
    header('Location: ./admin_users.php');
}

if (isset($_POST['admin_comps'])){
    header('Location: ./admin_comps.php');
}

if (isset($_POST['voir_offre'])){
    header('Location: ./voir_offres.php');
}

if (isset($_POST['del_offre'])){
    header('Location: ./del_offre.php');
}
?>