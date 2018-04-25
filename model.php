	<?php
	$username;
	$password;
	$rs;
	$conn;
	$stmt;
	$selectedBook;
	$selectedStudent;
	
	function connectDB($host, $dbname, $user, $pass){
		global $conn, $rs, $stmt;
		try{
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		}catch(PDOException $e){
			echo 'error' . $e;
		}
	}
	
	function login(){
					global $username, $password, $rs, $stmt, $conn;
					$username = $_POST['username'];
					$password = $_POST['password'];
					$hashedpass = md5(md5(sha1(sha1(md5($password)))));
					if($username === "Admin"&&$password === "Admin"){
						$_SESSION['username'] = "Admin";
						header('Location: admin.php');
					}else{
					$query = "select * from users where username = :username and password = :password LIMIT 1";
					$stmt = $conn->prepare($query);
					$stmt->bindValue(':username', $username);
					$stmt->bindValue(':password', $hashedpass);
					$stmt->execute();
					$rs = $stmt->fetch(PDO::FETCH_ASSOC);
					if(!empty($rs)){
						$_SESSION['username'] = $rs['username'];
						$_SESSION['password'] = $rs['password'];
						$_SESSION['id'] = $rs['student_id'];
						$message = 'Logged in as: '.$_SESSION['username'];
						echo "<SCRIPT>
						alert('$message');
						</SCRIPT>";
						header('Location: homepage.php');
					}else{
						
							$message = 'Sorry, login details are incorrect';
							echo "<SCRIPT>
							alert('$message');
							</SCRIPT>";
					}
					}
		}
		
		function redirect(){
			if(empty($_SESSION)){
				header('Location: login.php');
			}
			
		}
	
		function registerUser(){
			try{
			global $conn, $rs, $stmt;
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(strlen($_POST['username'])>=3&&strlen($_POST['student_id'])==7&&strlen($_POST['password'])>=6&&strlen($_POST['password']<=10)&&preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$student_id = $_POST['student_id'];
			$hashedpass = md5(md5(sha1(sha1(md5($password)))));
			$statement = "INSERT INTO `library`.`users` (`student_id`,`username`, `password`) VALUES (:student_id, :username, :password);";
			$stmt = $conn->prepare($statement);
			$stmt->bindValue(':username', $username);
			$stmt->bindValue(':password', $hashedpass);
			$stmt->bindValue(':student_id',$student_id);
			$stmt->execute();
			header('Location: login.php');
			}
			if(strlen($_POST['username'])<=2){
				echo "<h1>Username must have at least 3 characters.</h1>";
			}
			if(strlen($_POST['student_id'])!=7){
				echo "<h1>Student ID must contain exactly 7 characters.</h1>";
			}
			if(strlen($_POST['password'])<=5||strlen($_POST['password'])>=11){
				echo "<h1>Password must contain between 6 and 10 characters.</h1>";
			}
			if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])==False){
				echo "<h1>Password must contain letters and numbers.</h1>";
			}
			
			}catch(PDOException $e){
				echo $e;
			}
		}
		
		function registerBook(){
			try{
			global $conn, $rs, $stmt;
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(strlen($_POST['title'])>0&&strlen($_POST['author'])>0&&strlen($_POST['isbn'])==10){
			$title = $_POST['title'];
			$author = $_POST['author'];
			$isbn = $_POST['isbn'];
			$quantity = $_POST['quantity'];
			$statement = "INSERT INTO `library`.`books` (`Title`,`Author`, `ISBN`, `Quantity`) VALUES (:title, :author, :isbn, :quantity);";
			$stmt = $conn->prepare($statement);
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':author', $author);
			$stmt->bindValue(':isbn',$isbn);
			$stmt->bindValue(':quantity',$quantity);
			$stmt->execute();
			header('Location: admin.php');
			}
			if(strlen($_POST['title'])<1){
				echo "<h1>Title must contain at least 1 character.</h1>";
			}
			if(strlen($_POST['author'])<1){
				echo "<h1>Author must contain at least 1 character.</h1>";
			}
			if(strlen($_POST['isbn'])!=10){
				echo "<h1>ISBN must contain exactly 10 characters.</h1>";
			}
			
			
			}catch(PDOException $e){
				echo $e;
			}
		}
		
		function printTable($query){
			global $selectedBook;
			try{
				$conn = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");
			}catch(PDOException $e){
				echo 'error' . $e;
			}
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$title = [];
			$author = [];
			$book = [];
			$rs = $stmt->fetchAll();
			for($i = 0;$i<=sizeof($rs)-1;$i++){
				for($j = 0;$j<=sizeof($rs[$i])-6;$j++){
					echo "<td>".$rs[$i][$j]."</td>";
					
				}
				echo "<td> <form method='post'><input name='bookid' type='submit' id='bookid' value='Check Out' class='btn-check'/>";
				echo "<input type='hidden' name='selectedID' value='".$rs[$i][0]."'/></form></td>";
				echo "<tr>";
				
			}
			if(!empty($_POST['bookid'])){
				if($_POST['bookid']){
					
					$selectedBook = $_POST['selectedID'];
					checkOut();
					
				}
			}
			$conn = null;
		}
		
		
		function printCheckedOut($query){
			global $selectedBook, $selectedStudent;
			try{
				$conn = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");
			}catch(PDOException $e){
				echo 'error' . $e;
			}
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$rs = $stmt->fetchAll();
			for($i = 0;$i<=sizeof($rs)-1;$i++){
				for($j = 0;$j<=sizeof($rs[$i])-5;$j++){
					echo "<td>".$rs[$i][$j]."</td>";
					
				}
				echo "<td> <form method='post'><input name='bookid' type='submit' id='bookid' value='checkIn' class='btn-check'/>";
				echo "<input type='hidden' name='selectedStudentID' value='".$rs[$i][1]."'/>";
				echo "<input type='hidden' name='selectedID' value='".$rs[$i][0]."'/></form></td>";
				
				echo "<tr>";
				
			}
			if(!empty($_POST['bookid'])){
				if($_POST['bookid']){
					$selectedStudent = $_POST['selectedStudentID'];
					$selectedBook = $_POST['selectedID'];
					checkIn();
					
				}
			}
			$conn = null;
		}
		
		function checkOut(){
			global $selectedBook, $selectedStudent;
			try{
				$conn = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");
			}catch(PDOException $e){
				echo 'error' . $e;
			}
			$query = "select * from books where id = '".$selectedBook."'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			if($rs['Quantity']>0){
				$newQuantity = $rs['Quantity']-1;
				$sql = "UPDATE books SET Quantity='".$newQuantity."' WHERE id='".$selectedBook."'";
				$currentDate = date('Y-m-d H:i:s');
				$date = date('Y-m-d H:i:s');
				$date = date('Y-m-d H:i:s',strtotime($date.'+ 7 days'));
				$conn->query($sql);
				$sql = "INSERT INTO checked_by(bookid,studentid,checkDate,dueDate) VALUES ('".$selectedBook."','".$_SESSION['id']."','".$currentDate."','".$date."')";
				$conn->query($sql);
				echo "<SCRIPT>
				alert('Book checked out succesfully');
				</SCRIPT>";
				//header('Location: homepage.php');
			}else{
				echo "<SCRIPT>
				alert('Book is currently unavaiable');
				</SCRIPT>";
			}
			$conn=null;	
		}
		
		
		
		
		
		
		
		function logout(){
			session_destroy();
			header('Location: login.php');
			
			
		}
		
		function checkIn(){
			
			global $selectedBook, $selectedStudent;
			try{
				$conn = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");
			}catch(PDOException $e){
				echo 'error' . $e;
			}
			$query = "select * from books where id = '".$selectedBook."'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$newQuantity = $rs['Quantity']+1;
				$sql = "UPDATE books SET Quantity='".$newQuantity."' WHERE id='".$selectedBook."'";
				$conn->query($sql);
				$sql = "DELETE FROM checked_by where bookid = '".$selectedBook."' and studentid = '".$selectedStudent."'";
				$conn->query($sql);
				echo "<SCRIPT>
				alert('Book checked in succesfully');
				</SCRIPT>";
			$conn=null;	
		}
		
		function printCheckedTable(){
			global $selectedBook;
			try{
				$conn = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");
			}catch(PDOException $e){
				echo 'error' . $e;
			}
			$query = "select * from checked_by where studentid = '".$_SESSION['id']."'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$rs = $stmt->fetchAll();
			for($i = 0;$i<=sizeof($rs)-1;$i++){
				for($j = 0;$j<=sizeof($rs[$i])-5;$j++){
					echo "<td>".$rs[$i][$j]."</td>";	
				}
				echo "<tr/>";
			}
			$conn = null;
		}
	?>
	
	
