<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>espace connexion</title>
</head>
<body>


    <form action="" method="post">
        <button name="co_user">connexion utilisateur</button>
        <button name="new_user">nouveau compte utilisateur</button>
        <button name="co_admin">connexion admin</button>

    </form>





</body>
</html>

<?php
if (isset($_POST['co_admin'])){
    header('Location: ./admin/connexion_admin.php');
}
if (isset($_POST['new_user'])){
    header('Location: ./users/new_users.php');
}
if (isset($_POST['co_user'])){
    header('Location: ./users/connexion_users.php');
}

?>