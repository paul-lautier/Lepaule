<?php 
session_start();
$username = $_SESSION['connected'];
require '../bdd.php';
require '../function/connexion_test.php';
require '../function/kill_session.php';

if (!is_connected()){
    header('Location: ../connexion.php');

}
$query_get_subs = $pdo->prepare('SELECT * FROM subs');
$query_get_subs->execute();
$fetch_sub = $query_get_subs->fetchAll();

$query_already_follow = $pdo->prepare('SELECT * from subs_details where users_id = :user_id and sub_id = :sub_id');
$query_already_follow->bindParam(':user_id',$user_id);
$query_already_follow->bindParam(':sub_id',$sub_id);
$query_already_follow->execute();

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

        <th>nom des sub :</th>
        </tr>
        <?php 
        foreach($fetch_sub as $subs){?>

        <tr>
            <td> <?= $subs["sub_name"] ;?> </td>
            <td><a href="follow_sub.php?id=<?= $subs["sub_id"]; ?>">suivre le sub </a></td>
            <td><a href="unfollow_sub.php?id=<?= $subs["sub_id"]; ?>"> ne plus suivre le sub</a></td>
        </tr>

        <?php } ?>

    </table>


</body>
</html>   


