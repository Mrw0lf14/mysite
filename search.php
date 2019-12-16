<?php 
session_start();
if (isset($_POST['search'])){
	$search = $_POST['search'];
	if ($search == 'help'){
		echo "string";
		header("Location: help.php");
	}
	$pieces = explode(" ", $search);
	$query = "SELECT * FROM models ";
	if (strlen($pieces)<50){
		foreach ($pieces as $piece) {
			if (strlen($piece)<20) {
				echo "srlen";
				$piece = str_replace('?','WHERE name = ',$piece);
				$piece = str_replace('#','WHERE tag = ',$piece);
				$piece = str_replace('*','WHERE type = ',$piece);
				$piece = str_replace('!','ORDER BY ',$piece);
				$query = $query . " " . $piece;
			}	
		}
		//echo "$query";
		$_SESSION['search']=$query;
		echo $_SESSION['search'];
		//header("Location: index.php");
	}
}
else{
	//header("Location: index.php");
}
?>