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
	<div class="help">
		<h3>Help</h3>
		<hr><br>
		<p><b>#</b> - find with tag</p>
		<p><b>?</b> - find with owner</p>
		<p><b>*</b> - find with type</p>
		<p><b>!</b> - find in order by something</p>
	</div>
</article>
<footer>
	<div><h3>Created by Alexei</h3></div>
	<div><a href="">IU4-12</a></div>
</footer>
</body>
</html>