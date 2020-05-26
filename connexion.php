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
        <button name="co_comp">connexion entreprise</button>
        <button name="new_comp">nouveau compte entreprise</button>
    </form>





</body>
</html>

<?php
if (isset($_POST['co_user'])){
    header('Location: ./demandeur/connexion_demandeur.php');
}
if (isset($_POST['new_user'])){
    header('Location: ./demandeur/new_demandeur.php');
}
if (isset($_POST['co_admin'])){
    header('Location: ./admin/connexion_admin.php');
}
if (isset($_POST['co_comp'])){
    header('Location: ./donneur/connexion_donneur.php');
}
if (isset($_POST['new_comp'])){
    header('Location: ./donneur/new_donneur.php');
}

?>