<?php
	session_start();
	if (isset($_SESSION['username'])){
		header("Location: index.php");
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
			<h1>Please sign in.</h1>
			<form action="" method="post">
				<div><input type="text" name="username" placeholder="Your name/mail"></div>
				<div><input type="password" name="password" placeholder="Password"></div>
				<div><button type="submit">Apply</button></div>
				<p><?php if ($alert){echo "$alert";}?></p>
			</form>
			<a href="signup.php">don't registered yet?</a>
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
<?php
	
	$username = $_POST['username'];
	$pass = $_POST['password'];
	
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='authorization';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль

	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу

	$mail_valid = preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $username);

	if($username){
		if ($mail_valid){
			$query = "SELECT * FROM $table WHERE mail ='$username'";
		} 
		else{
			$query = "SELECT * FROM $table WHERE name ='$username'";
		}
		echo "$query";
		$res = mysqli_query($link ,$query);//выполняем запрос
		if($res){
			$row = mysqli_fetch_array($res);//вытаскиваем данные из запроса
			if ( ($row['name']=="$username" or $row['mail']=="$username") && $row['password']=="$pass"){
				$_SESSION['username'] = $username;
		        // Redirect user to index.php
		     	header("Location: index.php");
			}
			else{
				$alert = "Wrong password or login";
			}
		}
	}

?>