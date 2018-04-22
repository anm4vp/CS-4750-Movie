<?php session_start(); ?>
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
    <h1 id="logo"><a href="confirmation.php">MovieSearch</a></h1>                                                                                                         
                                                                                                                                                                         
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
   1) <a href="index.php" class=class2> Select a Movie</a>
         2) <a href="" class=class2> Movie Info</a>
               3) <a href="" class=class2> Purchase Tickets</a>
</center>
      <div id="search">

      </div>
    </div>
  </div>
  <div id="main">
    <!-- <div class="box">
        <div class="head">
          <h2>LATEST TRAILERS</h2>
          <p class="text-right"><a href="#">See all</a></p>
        </div>
        <div class="movie">
          <div class="rating">
            <p>RATING</p>
            <div class="stars">
              <div class="stars-in"> </div>
            </div>
            <span class="comments">12</span> </div>
        </div>
        <div class="cl">&nbsp;</div>
      </div> -->
    <div id="news">
      <div class="head">
   <?php if(isset($_GET['moviename'], $_GET['showtime'], $_GET['theater'])){
          $movie = $_GET['moviename'];
          $show = $_GET['showtime'];
          $theater = $_GET['theater'];
        }
        ?>
        <?php
        echo '<h6>'.$movie.'</h6> </br>

        <h3> Showing on Wed April 25 @ '.$show.' </h3> </br> </br>

        <h6>'.$theater.' </h6>

        ';
        ?>
        <!-- <h6>MOVIENAME</h6> </br>
        <h3> Showing on Wed April 25 @ 3:30 PM </h3> </br> </br>

        <h6>THEATERNAME </h6> -->

      </br>
      </div>
      <div>
        <h3> PURCHASE TICKETS: </h3>
      </br>

      <h5>
        Select the number and type of tickets you wish to buy. Please note seats are reserved on a best available basis.
        You can buy a maximum of 10 tickets per transaction.
      </h5>
	</br>
	<form method="POST" name="signup" action="purchasequery.php">

        <table style="width:100%">
          <tr>
            <td>Tickets</td>
            <td>Cost</td>
            <td>Qty</td>
            <td>Subtotal</td>
            <td></td>
          <tr>
          <tr>
            <td> Standard </td>
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
$sql="SELECT price FROM Sell_Tickets WHERE theater_name = '".$theater."' ";
$result = mysqli_query($con,$sql);
// Print the data from the table row by row
while($row = mysqli_fetch_array($result)) {
          print '
          <td>'.$row['price'].'</td>
         <input type = "hidden" value="'.$show.'" name="show">
         <input type = "hidden" value="'.$movie.'" name="movie">
          ';
           print ' 
            <td>
              <select name= "qty">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </td>
            <td> '.$row['price'].' </td>
             ';


  }
mysqli_close($con);
        ?>


            <td> <input type="submit" value="Submit"> </td>
          </tr>
        </table>
  </form>

      </div>
    </div>

    <div id="news">
      <div class="head">


      </br>
        <center>
          <?php
            print '
            <img width=200em height=100% src="css/images/'.$movie.'.jpg" alt="" />
            ';
          ?>
          <!-- <img width=200em height=100% src="css/images/movie1.jpg" alt="" /> -->
        </center>
      </div>
    </div>



    <div class="cl">&nbsp;</div>
  </div>
  <div id="footer">
    <p class="lf">Copyright &copy; 2010 <a href="#">SiteName</a> - All Rights Reserved</p>
    <p class="rf">Design by <a href="http://chocotemplates.com/">ChocoTemplates.com</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>
