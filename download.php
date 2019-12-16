<?php
function file_force_download($file) {
  
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // читаем файл и отправляем его пользователю
    readfile($file);
    echo "good";
    exit;
 
}
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
	$downloads = $row[7] + 1;
	$file_download = $row[6];

	$query = "UPDATE $table SET downloads = $downloads WHERE id = $id";
	$res = mysqli_query($link ,$query);
	$row = mysqli_fetch_row($res);
	echo "$file_download";

	file_force_download($file_download);
?>