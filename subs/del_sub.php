<?php

session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
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

if(isset($_GET["delete"]) and !empty($_GET["delete"])){
    $sub_id = (int) $_GET["delete"];

    $sub_delete_link = $pdo->prepare('DELETE FROM subs_details WHERE sub_id = :sub_id');
    $sub_delete_link->bindParam(':sub_id',$sub_id);
    $sub_delete_link->execute();

    $createur_delete_link = $pdo->prepare('DELETE FROM createur_details WHERE sub_id = :sub_id');
    $createur_delete_link->bindParam(':sub_id',$sub_id);
    $createur_delete_link->execute();

    $sub_delete = $pdo->prepare('DELETE FROM subs WHERE sub_id = :sub_id');
    $sub_delete->bindParam(':sub_id',$sub_id);
    $sub_delete->execute();


    header('Location: del_sub.php');

}

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
    <th>supprimer:</th>
    </tr>
    <?php 
    foreach($fetch_sub as $sub){?>

    <tr>
        <td> <?= $sub["sub_name"] ;?> </td>
        <td><a href="del_sub.php?delete=<?= $sub["sub_id"]; ?>">supprimer</a></td>
    </tr>

    <?php } ?>

    <form action="users_manage_subs.php" >
        <button name="home">home</button>
    </form>

</table>
</body>
</html>