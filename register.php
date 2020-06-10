<?php
require './bdd.php';



if (isset($_POST['home'])){
	header('Location: index.php');
}

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["birthdate"]) && isset($_POST["password_1"]) && isset($_POST["password_2"])){
	$username = htmlspecialchars($_POST["username"]);
	$email = htmlspecialchars($_POST["email"]);
	$birthdate = htmlspecialchars($_POST["birthdate"]);
	$password = htmlspecialchars($_POST["password_1"]);
	$password_test = htmlspecialchars($_POST['password_2']);


	$query_verif_user = $pdo->prepare("SELECT username from users where username = ?");
	$query_verif_user->execute([$username]);

	
	$query_verif_mail = $pdo->prepare("SELECT email from users where email = ?");
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
		$money = 0;
		$is_totp = 'non';
		$password = md5($password);
		$query_add = $pdo->prepare("INSERT INTO users (username, email,birthdate, password,money,is_totp) VALUES(:username, :email, :birthdate, :password, :money, :is_totp)");
		$query_add->bindparam(":username", $username);
		$query_add->bindparam(":email", $email);
		$query_add->bindparam(":birthdate", $birthdate);
		$query_add->bindparam(":password", $password);
		$query_add->bindparam(":is_totp", $is_totp);
		$query_add->bindparam(":money", $money);
		$query_add->execute();
		session_start();
        $_SESSION['connected'] = $username;
		header('Location: ./users/home_users.php');
	}
}


?>
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register entreprise</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

	<form action="" method="post">



  	  <input type="text" name="username" placeholder="Username"><br>
  	
	  <input type="email" name="email" placeholder="Email"><br>

	  <input type="date" name="birthdate" placeholder="date de naissance"><br>
		
  	  <input type="password" name="password_1" placeholder="Password"><br>
  	
  	  <input type="password" name="password_2" placeholder="Verify Password"><br>

	  <button type="submit" name="connexion">create account</button><br>
	
	  <button name="home">home</button> 

  	
	</form>
	
	</body>
</html>
