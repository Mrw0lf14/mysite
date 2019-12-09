<?php 
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='models';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль
	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу
	$name = $_SESSION['username'];

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
				<form action="index.php" method="get">
					<input placeholder = "Find with tag #" type="text" name="">
					<button><img src=""></button>
				</form>
			</div>
			<div><a href="exit.php">Exit</a></div>
		</div>

	</header>
	<article>
		<div class="content">
			<h1>Your page</h1>
			<br><hr><br>
			<div class="box_create">
				<h3>Publich your work</h3>
				<hr>
				<form enctype="multipart/form-data" action="" method="post">
					<div>
						<b>Give it tag</b>
							<hr>
						<select  name="tag">
							<option value="default"> #tag </option>
	    					<option value="character"> #character </option>
	    					<option value="building"> #building </option>
	    					<option value="plants"> #plants </option>
	    					<option value="object"> #object </option>
  						</select>
					</div>
					
					<div>
						<b>Give it type</b>
							<hr>
						<select  name="type">
							<option value="default"> #kind_of_work </option>
	    					<option value="character"> #lowpoly </option>
	    					<option value="building"> #highpoly </option>
  						</select>
  					</div>
					<div>
						<b>Download picture</b>
						<hr>
						<input type="file" name="picture">
					</div>
					<div>
						<b>Download model</b>
						<hr>
						<input type="file" name="model">
					</div><br>
					<button>Apply</button>
				</form>
			</div>
		</div>

		<div class="line">Your works</div>
		<div class="box_work">
			<div class="work_content">
				<b>WorkN</b>
				<hr>
				<p>
					<b>#character</b>
					<b>#lowpoly</b>
				</p>
				<div class="box"><img src="images/3.jpg"></div>
				<form class="form">
					<button>Download</button>
					<button>Like</button>
					<button>Delete</button>
				</form>
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
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='models';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль
	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу

	$uploaddir = '/var/www/html/uploads/';// путь, куда сохранить модель, тут он абсолютный для системы, начинается с корневой папки

	$uploadfile = $uploaddir . basename($_FILES['model']['name']);// соединяем путь и имя загруженного файла
	$dbmodel = '/uploads/'. basename($_FILES['model']['name']);// на сайте абсолютный путь начинается с папки хтмл, то есть она считается корневой
	$uploadpict = $uploaddir . basename($_FILES['picture']['name']);// соединяем путь и имя загруженного файла
	$dbpict = '/uploads/'. basename($_FILES['picture']['name']);// на сайте абсолютный путь начинается с папки хтмл, то есть она 

	$y = $_FILES['model']['name'];
	if (preg_match("/[a-zA-Z0-9].obj/", $y) || preg_match("/[a-zA-Z0-9].fbx/", $y)){
	 	if (move_uploaded_file($_FILES['model']['tmp_name'], $uploadfile) && move_uploaded_file($_FILES['picture']['tmp_name'], $uploadpict)) {// если файл переместили
    		echo "Файл корректен и был успешно загружен.\n";
    		$type = $_POST['type'];
			$tag = $_POST['tag'];
			$query = "INSERT INTO $table(path,tag,type,pict) VALUES('$dbmodel','$tag','$type','$dbpict')";//сохраняем данные в бд
			$res = mysqli_query($link ,$query);//задаем вопрос
			echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";// вывод об ошибке
			}	
	}

	
		
?>