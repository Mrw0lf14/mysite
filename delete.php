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
	$file = $row[7];
	echo "$file";
	if (unlink($file)) {
		echo "success";
	} else
	{
		echo "error";
	}
	$query = "DELETE FROM $table WHERE id = $id";
	$res = mysqli_query($link ,$query);
	header("/homework/mysite.php");
	exit();
?>