
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
				<form action="" method="post">
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

<article>
	<div class="content">
		<div class="card">
			<?php
				$host='localhost'; // имя хоста (уточняется у провайдера)
				$database='homework'; // имя базы данных, которую вы должны создать
				$user='root'; // заданное вами имя пользователя, либо определенное провайдером
				$table='models';//название таблицы
				$pswd='gavl228_A'; // заданный вами пароль
				$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу
				$id=$_GET['id'];
				$query = "SELECT * FROM models WHERE id=$id";
				$res = mysqli_query($link ,$query); 
				$row = mysqli_fetch_row($res);
				$tag = $row[2];
				$type = $row[3];
				$pict = $row[4];
				$owner = $row[5];
				$author = "<a href =mysite.php?owner=$owner> author</a>";
				$download ="<a href=download.php?id=$id align='center'>download</a>";
			 
				echo "<img src=$pict>"
			?>
			<div class="head">
				<h3> card of model</h3>
				<hr>
				<b> <?php echo "#$tag"; ?></b> <b> <?php echo "#$type"; ?></b>
			</div>
			<div>
				<br>
				created by <?php echo "$owner"; ?>
			</div>
			<?php echo $download; ?>
			<?php echo $author; ?>
		</div>
	</div>
	
</article>
</body>
</html>
