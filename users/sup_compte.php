<?php
require '../bdd.php';
require '../function/connexion_test.php';
require '../function/kill_session.php';
if (!is_connected()){
    header('Location: ../connexion.php');
}
$username = $_SESSION['connected']

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pol Emploie</title>
</head>
<body>
    <form action="" method="post">
        <button name="delete">supprimez votre compte</button>


    </form>
    
</body>
</html>

<?php
if (isset($_POST['delete'])){
    $querry_delete = $pdo->prepare("DELETE FROM users where username = :username");
    $querry_delete->bindParam(':username',$username);
    $querry_delete->execute();
    deconnect();
    header('Location: ../index.php');
}
?>