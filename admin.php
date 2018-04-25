<!DOCTYPE>
  <html>
    <head>
      <title>CCT Library Admin Page</title>
      <a href="login.php"><button class="btn" style="float:right;">Logout</button></a>
      <link rel="stylesheet" href="style.css">
      <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
      <?php
        session_start();
        
        if($_SESSION['username']==="Admin"){
          echo "<script>alert('Welcome Admin');</script>";
        }else{
          header('Location: login.php');
        }
      ?>

    </head>
    <body>
      <div class="header"><h1>Register Book</h1></div>
      <div class="registerBook">
        <form action="admin.php" method="post">
		<div class="loginForm">
		<input type="text" name="title" placeholder="Book Title" class="text"/>
		</div>
		<div class="loginForm">
		<input type="text" name="author" placeholder="Book Author" class="text"/>
		</div>
		<div class="loginForm">
		<input type="text" name="isbn" placeholder="ISBN" class="text"/>
		</div>
    <div class="loginForm">
		<input type="text" name="quantity" placeholder="Quantity" class="text"/>
		</div>
		<div class="loginForm">
		<input type="submit" name='registerBook' value= 'Register' class= "btn"/>
		</div>
		
		<?php
		if(!empty($_POST['registerBook'])){
			include 'model.php';
			connectDB('127.0.0.1','library','root','');
			registerBook();
		}
		?>
		
		
		</form>
      </div>
      <div class="topTable">
        <table class="table">
          <tbody>
          <tr>
            <th>Book ID</th>
            <th>Student ID</th>
            <th>Checked Date</th>
            <th>Due Date</th>
            <th>Check-In</th>
          </tr>
          <?php
            include "model.php";
            printCheckedOut("select * from checked_by");
          ?>
          </tbody>
        </table>
        
      </div>
    </body>
    
  </html>