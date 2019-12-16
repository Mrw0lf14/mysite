<?php 
	session_start();
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='models';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль

	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу
	$name = $_GET['owner'];
	if($_SESSION['username']==$name || ($_SESSION['username'] && !$name)){
		$name = $_SESSION['username'];
	}
	$query = "SELECT * FROM $table WHERE owner='$name'";
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
			<div><a href="index.php">New works</a></div>
			<div>
				<form action="search.php" method="post">
					<input placeholder = "Find with tag #" type="text" name="">
					<button><img src=""></button>
				</form>
			</div>
			<div><a href="exit.php">Exit</a></div>
		</div>

	</header>
	<article>
		<?php

		if($_SESSION['username']==$name || ($_SESSION['username'] && !$name)){ echo "
		<div class='content'>
			<h1>Your page</h1>
			<br><hr><br>
			<div class='box_create'>
				<h3>Publich Your work</h3>
				<hr>
				<form enctype='multipart/form-data' action='' method='post'>
					<div>
						<b>Give it tag</b>
							<hr>
						<select  name='tag'>
							<option value='default'> #tag </option>
	    					<option value='character'> #character </option>
	    					<option value='building'> #building </option>
	    					<option value='plants'> #plants </option>
	    					<option value='object'> #object </option>
  						</select>
					</div>
					
					<div>
						<b>Give it type</b>
							<hr>
						<select  name='type'>
							<option value='default'> #kind_of_work </option>
	    					<option value='character'> #lowpoly </option>
	    					<option value='building'> #highpoly </option>
  						</select>
  					</div>
					<div>
						<b>Download picture</b>
						<hr>
						<input type='file' name='picture'>
					</div>
					<div>
						<b>Download model</b>
						<hr>
						<input type='file' name='model'>
					</div><br>
					<button>Apply</button>
				</form>
			</div>
		</div>";
	  } ?>

		
		<div class='box_work'>
			
			<?php 
				if($_SESSION['username']==$name || ($_SESSION['username'] && !$name)){
					echo "
					<br><hr><br>
					<div class='line'>Your works</div>";
					$name = $_SESSION['username'];
				} else{
					echo "
					<h1>$name's page</h1>
					<br><hr><br>
					<div class='line'>His works</div>";
				}
			while ($row = mysqli_fetch_row($res)) {//берем данные и переводим их в масси, функция просто переходит по строкам вывода, то есть сначала первая строчка ответа, потом вторая, пока не станет пустой
					$pict = $row[4];//pict
					$tag = $row[2];
					$type = $row[3];
					$id = $row[0];
					$ndownloads = $row[7];
					$pict = $row[4];//pict
					$idlink ='card.php?id='.$row[0];//id
					echo "
						<div class='work_content'>
						<b>work N$id</b>
						<hr>
						<p>
						<b>#$type</b>
						<b>#$tag</b>
						</p>
						<a href='$idlink'><div class='box'><img src='$pict'></div></a>
						<form class='form'>";
					if ($_SESSION['username']=="admin" || $_SESSION['username']==$name){
						echo "	<a class='box_a' title='$ndownloads' href = download.php?id=$id>Download</a>
								<a class='box_a' href = delete.php?id=$id>Delete</a>";
					} 
					else if($_SESSION['username']){
						echo "	<a class='box_a' href = download.php?id=$id>Download</a>
								<a class='box_a' >Like</a>";
							}
					else
					{
						echo "	<a class='box_a' href = download.php?id=$id>Download</a>";
					}
							
						echo "</form>
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

	$uploaddir = '/var/www/html/uploads/';// путь, куда сохранить модель, тут он абсолютный для системы, начинается с корневой папки
	$uploadfile = $uploaddir . basename($_FILES['model']['name']);// соединяем путь и имя загруженного файла
	$dbmodel = '/uploads/'. basename($_FILES['model']['name']);// на сайте абсолютный путь начинается с папки хтмл, то есть она считается корневой
	$uploadpict = $uploaddir . basename($_FILES['picture']['name']);// соединяем путь и имя загруженного файла
	$dbpict = '/uploads/'. basename($_FILES['picture']['name']);// на сайте абсолютный путь начинается с папки хтмл, то есть она 
	$name = $_SESSION['username'];
	$y = $_FILES['model']['name'];
	if (preg_match("/[a-zA-Z0-9].obj/", $y) || preg_match("/[a-zA-Z0-9].fbx/", $y)){
	 	if (move_uploaded_file($_FILES['model']['tmp_name'], $uploadfile) && move_uploaded_file($_FILES['picture']['tmp_name'], $uploadpict)) {// если файл переместили
    		echo "Файл корректен и был успешно загружен.\n";
    		$type = $_POST['type'];
			$tag = $_POST['tag'];
			$query = "INSERT INTO $table(path,tag,type,pict,owner,apath) VALUES('$dbmodel','$tag','$type','$dbpict','$name','$uploadfile')";//сохраняем данные в бд
			$res = mysqli_query($link ,$query);//задаем вопрос
			echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";// вывод об ошибке
			}	
	}

	
		
?>