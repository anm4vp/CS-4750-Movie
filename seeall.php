<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MovieSearch</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-func.js"></script>
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>
<body>
<!-- START PAGE SOURCE -->

<div id="shell">
  <div id="header">
  <?php
   if(isset($_SESSION['loggedin'])){
     if ($_SESSION['loggedin'] == TRUE){
       $username = $_SESSION['user'];
       echo '<div id="header">
    <h1 id="logo"><a href="MovieSearch.php">MovieSearch</a></h1>

    <div id="navigation">
      <ul>
        <li><a class="active" href="MovieSearch.php">HOME</a></li>
        <li><a href="history.php">HISTORY</a></li>
        <li><a href="rewards.php">REWARDS</a></li>
        <li><a href="top.php">TOP SELLING MOVIES</a></li>
        <li><a href="logout.php">LOG OUT</a></li>
      </ul>
    </div>';
     }
   } else {
       echo'<div id="header">
    <h1 id="logo"><a href="index.php">MovieSearch</a></h1>

    <div id="navigation">
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li><a href="top.php">TOP SELLING MOVIES</a></li>
        <li><a href="login.html">LOG IN</a></li>
        <li><a href="signup.html">SIGN UP</a></li>
      </ul>
    </div>';
   }
      ?>
    <div id="sub-navigation">
      <center>
      <h1> List of All Movie Theaters </h1>
    </center>
      <div id="search">
      </div>
    </div>
  </div>


  <div id="main">
    
      <br>
      <div id="content">
        <div class="box">
         <?php
   require_once('./library.php');
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo("Can't connect to MySQL Server. Error code: " .
       mysqli_connect_error());
  return null;
}
// Form the SQL query (a SELECT query)
$sql="SELECT theater_name, address, directions, website, description FROM Movie_Theater";
$result = mysqli_query($con,$sql);
// Print the data from the table row by row
while($row = mysqli_fetch_array($result)) {
  print '<h3>  '.$row['theater_name'].' </h3>
                 <p> '.$row['description'].' </p>
              <p class="date"> Address: '.$row['address'].' </p>
              <a href="'.$row['website'].'"> Website</a> </br>
            <a href="'.$row['directions'].'"> Directions</a>       
     <br><br><br>
             ';  
  
}
mysqli_close($con);
        ?>
        </div>
      </div>


  </div>

<div id="footer">
  <p class="lf">Copyright &copy; 2018 <a href="#">MovieSearch</a> - All Rights Reserved</p>
  <p class="rf">Design by <a href="#">MovieSearchTeam</a></p>
  <div style="clear:both;"></div>
</div>

<!-- END PAGE SOURCE -->
</body>
</html>
