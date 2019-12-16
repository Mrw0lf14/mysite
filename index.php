<?php
	session_start();
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='models';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль
	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу

	
	if($_SESSION['search']){
		$query = $_SESSION['search'];
	} else{
		$query = "SELECT * FROM $table";
	}
	$res = mysqli_query($link ,$query);
	
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
			<div>
				<form action="search.php" method="post">
					<input placeholder = "Find with tag #" type="text" name="search">
					<button><img src=""></button>
				</form>
			</div>
			<?php
				
				if(isset($_SESSION['username'])){ 
					echo '<div><a href="mysite.php">My page</a></div>';
					echo '<div><a href="exit.php">Exit</a></div>';
				}
				else {
					echo '<div><a href="signin.php">Signin</a></div>';
					echo '<div><a href="signup.php">Signup</a></div>';
				}
			?>
				

		</div>
	</header>
	<div clear="both"></div>
	
	
	<article>

		<div class="content">
			<h1>Works</h1>
			<br><hr><br>
			<?php 
				while ($row = mysqli_fetch_row($res)) {//берем данные и переводим их в масси, функция просто переходит по строкам вывода, то есть сначала первая строчка ответа, потом вторая, пока не станет пустой
					$pict = $row[4];//pict
					$id ='card.php?id='.$row[0];//id
					echo "<a href='$id'><div class='box'><img src='$pict'></div></a>";
				}
			?>
		</div>
		
	</article>
	

	<hr>
	<footer>
		<div><h3>Created by Alexei</h3></div>
		<div><a href="">IU4-12</a></div>
	</footer>
</body>
</html>