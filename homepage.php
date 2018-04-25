<!DOCTYPE>
  <html>
    <head>
      <?php
      include 'model.php';
      session_start();
      redirect();
      ?>
      <link rel="stylesheet" href="style.css">
      <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

      <title>CCT Library Homepage</title>
      <a href="login.php"><button class="btn" style="float:right;">Logout</button></a>
    
    </head>   
    
    <body>
      <div class="header">
        <h1><a href="homepage.php">CCT Library</a></h1>
        <form action="homepage.php" method="post" class="formSearch">
       <input name="searchbar" type="text" placeholder="Insert Keywords" class="text">
       <input name="searchbutton" type="button" value="Submit" class="btn">		
        </form>
      </div>
      <div class="topTable">
        <table class="table">
          <tbody>
          <tr>
            <th>Id</th>
            <th>Book</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Quantity</th>
            <th>Check-Out</th>
          </tr>
          <?php
          if(empty($_POST['searchbar'])){
            printTable("select * from books");
          }else{
            printTable("select * from books where Title LIKE '%".$_POST['searchbar']."%'");
          }
          ?>
          </tbody>
        </table>
        </div>
      <div class="header"><h1>Your Checked Out Books</h1></div>
      <div class="bottomTable">
        <table class="table">
          <tbody>
        <th>Book ID</th>
        <th>Student ID</th>
        <th>Checked Date</th>
        <th>Due Date</th>
        </tr>
        <?php
        printCheckedTable();
        ?>
        </tbody>
        </table>
      </div>
      <div class="footer">
      </div>
    </body>
    
  </html>