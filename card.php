
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
					<input placeholder = "Find with tag #" type="text" name="search">
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
				$query = "SELECT * FROM $table WHERE id=$id";
				$res = mysqli_query($link ,$query); 
				$row = mysqli_fetch_row($res);
				$tag = $row[2];
				$type = $row[3];
				$pict = $row[4];
				$owner = $row[5];
				$ndownloads = $row[7];
				$author = "<a href =mysite.php?owner=$owner> author</a>";
				$download ="<a title='download $ndownloads times' href=download.php?id=$id align='center'>download</a>";
			 
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
		<div class="line"> Coments</div>
		<?php
			
			if(isset($_SESSION['username'])){ 
				echo "
				<form action='' method='post'>
				<textarea name='comment' class='comment' placeholder='write your opinion'></textarea><br>
				<div class='formcom'>
				<select name='like' class='like'>
					<option>
						good
					</option>
					<option>
						bad
					</option>
				</select>

				<button class='combutton' type='submit'>Send</button>
				</div>
				</form>
				";
			}
		?>
		<?php  
			$query = "SELECT * FROM comments WHERE id=$id";
			$res = mysqli_query($link ,$query); 
			while($row = mysqli_fetch_row($res)){
				$comtext = $row[1];
				$comname = $row[2];
				$comlike = $row[3];
				
				echo "
				<div class='coments'>
					<h3>$comname</h3>
					<div class='text'>
					$comtext
					</div>
					<div class='likes'>opinion: $comlike </div>
				</div>";

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
<?php
	if (isset($_POST['comment'])){
		$comtext = $_POST['comment'];
		$comlike = $_POST['like'];
		$comname = $_SESSION['username'];
		$query = "SELECT * FROM comments WHERE id = $id";
		$res = mysqli_query($link ,$query); 
		if ($row = mysqli_fetch_row($res) ){
			$query = "UPDATE comments SET ctext = '$comtext', own = '$comname', likes = '$comlike' WHERE id=$id";
			$res = mysqli_query($link ,$query); 
		}
		else{
			$query = "INSERT INTO comments VALUES ($id,'$comtext','$comname','$comlike')";
			$res = mysqli_query($link ,$query); 
		}
	}

?>