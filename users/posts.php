<?php
session_start();
require '../function/connexion_test.php';
if (!is_connected()){
    header('Location: ../connexion.php');
}
require '../bdd.php';
$username = $_SESSION['connected'];

$querry_get_id = $pdo->prepare('SELECT users_id from users where username = :username');
$querry_get_id->bindParam(':username',$username);
$querry_get_id->execute();
$user_id = implode($querry_get_id->fetch());

$query_is_modo = $pdo->prepare('SELECT is_modo from subs_details where users_id = :users_id');
$query_is_modo->BindParam(':users_id',$user_id);
$query_is_modo->execute();
$is_modo = $query_is_modo->fetch();

$query_sub_name = $pdo->prepare('SELECT * from subs where createur = :username');
$query_sub_name->BindParam(':username',$username);
$query_sub_name->execute();

$fetch_sub = $query_sub_name->fetchAll();




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'épaule</title>
</head>
<body>
    <table>
        <tr>

        <th>nom du sub :</th>
        <th>crée post :</th>
        </tr>
        <?php 
        foreach($fetch_sub as $sub){?>

        <tr>
            <td> <?= $sub["sub_name"] ;?> </td>
            <td><a href="../post/create_post.php?id=<?= $sub["sub_id"]; ?>">crée post</a></td>
        </tr>

        <?php } ?>

    </table>

    <?php 
    
    ?>
    <form action="select_subs.php" method="post">
        <button name="home">home</button>
    </form>
    
</body>
</html>