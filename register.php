<!DOCTYPE>

<html>

	<head>
	<link rel="stylesheet" href="style.css" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

		<title>CCT Library</title>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	
	<body>
		<div class="header">
        
        <h1><a href="register.php">Register Page</a></h1>
      </div>	
	<div class="loginDiv">
		
		<form action="register.php" method="post">
		<div class="loginForm">
		<input type="text" name="student_id" placeholder="Student ID" class="text"/>
		</div>
		<div class="loginForm">
		<input type="text" name="username" placeholder="Username" class="text"/>
		</div>
		<div class="loginForm">
		<input type="password" name="password" placeholder="Password" class="text"/>
		</div>
		<div class="g-recaptcha" data-sitekey="6LdqHT4UAAAAALsyiziEy239r2MuIIryH2uMP-Ml"></div>
		<div class="loginForm">
		<input type="submit" name='submit' value= 'Register' class= "btn"/>
		</div>
		</form>
	
		
		<?php
		if($_POST){
			include 'model.php';
			connectDB('127.0.0.1','library','root','');
			registerUser();
		}
		?>
		
		
		</form>
	</div>
	</div>
	</body>


</html>
