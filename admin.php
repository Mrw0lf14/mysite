<?php 
session_start();
if($_SESSION['username'] != 'admin'){
	header("Location: index.php");
	exit;
}
$host='localhost'; // имя хоста (уточняется у провайдера)
$database='homework'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$table='models';//название таблицы
$table2='authorization';
$pswd='gavl228_A'; // заданный вами пароль
$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу
if(!$select){
	$query = "SELECT * FROM $table ORDER BY owner";
	$res = mysqli_query($link ,$query); 
}
?>
<!DOCTYPE html>
<html>
<head>
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
				if (isset($_SESSION['username'])){ 

				}
			?>
		</div>
</header>
<article>
	<h3>Models</h3>
	<table>
		<tr><td>id </td><td>tag</td><td>type</td><td>downloads</td><td>action</td></tr>
		<tr></tr>
	<?php 

	while ($row = mysqli_fetch_row($res)) {
		$tag = $row[2];
		$type = $row[3];
		$id = $row[0];
		$ndownloads = $row[7];
		echo "<tr><td>$id </td><td>$tag</td><td>$type</td><td>$ndownloads</td><td><a href = delete.php?id=$id>Delete</a></td></tr>";
	}

	?>
	</table>
	<h3>Clients</h3>
	<table>
		<tr><td>id </td><td>name</td><td>password</td><td>action</td></tr>
		<tr></tr>
	<?php 
	$query = "SELECT * FROM $table2";
	$res = mysqli_query($link ,$query);
	while ($row = mysqli_fetch_row($res)) {
		$tag = $row[2];
		$type = $row[3];
		$id = $row[0];
		$ndownloads = $row[7];
		echo "<tr><td>$id </td><td>$tag</td><td>$type</td><td><a href = delete.php?id=$id>Delete</a></td></tr>";
	}

	?>
	</table>
</article>
</body>
</html>