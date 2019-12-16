<?php
	session_start();
	$mail = $_POST['mail'];
	$username = $_POST['username'];
	$pass = $_POST['password'];
	
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='authorization';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль

	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу

	$mail_valid = preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail) && preg_match("/(?:[a-zA-Z0-9])/i", $mail);
	
	$uppercase = preg_match('/[A-Z]+/', $pass);
	$lowercase = preg_match('/[a-z]+/', $pass);
	$number    = preg_match('/[0-9]+/', $pass);
	//$special = preg_match('/[%$#@&*^|\/~[]{}._-]+/',$pass);
	$password_valid = $uppercase && $lowercase && $number && strlen($pass) > 8 && strlen($pass) < 16;

	$login_valid = preg_match('/[A-Za-z_]/', $username) && strlen($username) > 6 && strlen($pass) < 16;

	if(!$password_valid) {
  		$alert = 'This password is too easy. Use 1 number 1 uppercase and 1 lowercase word. The length of pass should be hiher than 8';
	} 
	if (!$mail_valid){
		$alert = 'The mail is not valid';
	}
	if (!$login_valid){
		$alert = 'The login is not valid';
	}
	if (!$mail_valid && !$password_valid && !$login_valid)
	{
		// Redirect user to index.php
		//header("Location: index.php");
	} else{
		$query = "SELECT * FROM $table WHERE mail='$mail' OR name='$username'";//формируем запрос
		$res = mysqli_query($link ,$query);//задаем вопрос
		if ($res){
			$alert = "This account is already exist";
		}
		else{
			$query = "INSERT INTO $table (mail, name, password) VALUES ('$mail','$username','$pass')";
			$result = mysqli_query($link ,$query);
			$_SESSION['username'] = $username;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hello</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<div class="header">
			<div><a href="index.php">New works</a></div>
		</div>
	</header>
	<div clear="both"></div>
	
	
	<article>
	<div class="content">
		<div class="signupin">
			<h1>Please sign up.</h1>
			<form action="" method="post">
				<div><input type="text" name="mail" placeholder="Email"></div>
				<div><input type="text" name="username" placeholder="Your name"></div>
				<div><input type="password" name="password" placeholder="Password"></div>
				<div><button type="submit">Apply</button></div>
			</form>
			<a href="signin.php">Or Sign in.</a>
			<p><?php if($alert){ echo "$alert";} ?></p>
		</div>

	</div>
	</article>
	

	<hr>
	<footer>
		<div><h3>Created by Alexei</h3></div>
		<div><a href="">IU4-12</a></div>
	</footer>
</body>
</html>
