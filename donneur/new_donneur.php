<?php

require '../function/connexion_test.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$database_host = 'localhost';
$database_port = '3306';
$database_dbname = 'login';
$database_user = 'root';
$database_password = 'Paul@123';
$database_charset = 'UTF8';
$database_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

$pdo = new PDO(
    'mysql:host=' . $database_host .
    ';port=' . $database_port .
    ';dbname=' . $database_dbname .
    ';charset=' . $database_charset,
    $database_user,
    $database_password,
    $database_options
);

?>
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register entreprise</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

	<form method="post">


  	 
  	  <input type="text" name="username" placeholder="nom de l'entreprise"><br>
  	

  	  
  	  <input type="email" name="email" placeholder="Email"><br>
  	

  	  
  	  <input type="password" name="password_1" placeholder="mot de passe"><br>
  	

  	  <input type="password" name="password_2" placeholder="confirmer mot de passe"><br>
  	

  	  <button type="submit" name="connexion">se connecter </button><br>

  	
	</form>
	<a href="../index.php">retour au menu</a>
		
	</body>
</html>

<?php
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password_1"])&&isset($_POST["password_2"])){
	$username = htmlspecialchars($_POST["username"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password_1"]);
	$password_test = htmlspecialchars($_POST['password_2']);

	$query_verif_user = $pdo->prepare("select username from companies where username = ?");
	$query_verif_user->execute([$username]);

	
	$query_verif_mail = $pdo->prepare("select email from companies where email = ?");
	$query_verif_mail->execute([$email]);

	if ($password !== $password_test) {
		echo "<script type='text/javascript'>alert('les deux mot de passes ne correspondent pas');</script>";
	}

	elseif ($query_verif_user-> rowCount() > 0){
		echo "<script type='text/javascript'>alert('l utilisateur existe déjà');</script>";
		
	}
	elseif ($query_verif_mail->rowCount()>0){
		echo "<script type='text/javascript'>alert('cette email est déjà utilisé');</script>";
	
	}
	
	else {
		$password = md5($password);
		$query_add = $pdo->prepare("INSERT INTO companies (username, email, password) VALUES(:username, :email, :password)");
		$query_add->bindparam(":username", $username);
		$query_add->bindparam(":email", $email);
		$query_add->bindparam(":password", $password);
		$query_add->execute();
		header('Location: ./home_donneur.php');
	}
}
	



?>