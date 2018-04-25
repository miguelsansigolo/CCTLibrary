<html>
	<head>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

		<title>CCT Library</title>
		<?php
			session_start();
			if(!empty($_SESSION)){
				session_destroy();
			}
		?>
	</head>
	
	<body>
		<div class="header">
		<h1><a href="#">Login Page</a></h1></div>
		
		<form action="login.php" method="post">
			<div class="loginForm">
		<input type="text" name="username" class="text"/>
			</div>
			<div class="loginForm">
		<input type="password" name="password" class="text"/>
		</div>
		<div class="loginForm">
		<input type="submit" name="submit" placeholder="Login" class="btn"/>
		<a href="register.php"><input type="button" class="btn" value="Register"/></a>
		</div>
		
		<?php
		
		if($_POST){
			include 'model.php';
			connectDB('127.0.0.1','library','root','');
			login();
		}
		?>
		
		</form>
	</body>
</html>
