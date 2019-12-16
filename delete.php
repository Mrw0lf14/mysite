<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
		<div class="header">
			<div>
				<form action="search.php" method="post">
					<input placeholder = "Find with tag #" type="text" name="">
					<button><img src=""></button>
				</form>
			</div>
			<?php
				session_start();
				if(isset($_SESSION['username'])){ 
					echo '<div><a href="mysite.php">My page</a></div>';
					echo '<div><a href="exit.php">Exit</a></div>';
				}
				else {
					echo '<div><a href="signin.php">Signin</a></div>';
					echo '<div><a href="signup.php">Signup</a></div>';
				};
			?>
		</div>
</header>
</body>
</html>
<?php 
	$id = $_GET['id'];
	echo "$id";

	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='models';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль

	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу
	$query = "SELECT * FROM $table WHERE id = $id";
	$res = mysqli_query($link ,$query);
	$row = mysqli_fetch_row($res);
	$file = $row[6];
	if (unlink($file)) {
		echo "success";
	} else
	{
		echo "error";
	}
	$query = "DELETE FROM $table WHERE id = $id";
	$res = mysqli_query($link ,$query);
	$query = "DELETE FROM comments WHERE id = $id";
	$res = mysqli_query($link ,$query);
?>