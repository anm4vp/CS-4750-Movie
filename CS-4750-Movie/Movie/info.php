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
   1) <a href="index.php" class=class2> Select a Movie</a>    
	 2) <a href="" class=class2> Movie Info</a>
	       3) <a class=class2> Purchase Tickets</a>
</center>
      <div id="search">
        <!-- <form action="#" method="get" accept-charset="utf-8">
          <label for="search-field">SEARCH</label>
          <input type="text" name="search field" value="Enter search here" id="search-field" class="blink search-field"  />
          <input type="submit" value="GO!" class="search-button" />
        </form> -->
      </div>
    </div>
  </div>
  <div id="main">
    <!-- <div class="box">
        <div class="head">
          <h2>LATEST TRAILERS</h2>
          <p class="text-right"><a href="seeall.php">See All Theaters</a></p>
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
        <?php if(isset($_GET['moviename'])){
          $movie = $_GET['moviename'];
          echo "<h3>".$movie."</h3>";
        }
        ?>

      </br>
        <!-- <center> -->
          <?php
            print '
            <img width=200em height=100% src="css/images/'.$movie.'.jpg" alt="" />
            ';
          ?>
          <!-- <img width=200em height=100% src="css/images/movie1.jpg" alt="" /> -->
        <!-- </center> -->
      </div>
      <div class="content">
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
        $sql="SELECT Moviename, RottenTomatoLink, length, synopsis, releaseDate FROM Movies WHERE Moviename = '".$movie."' ";
        $result = mysqli_query($con,$sql);
        // Print the data from the table row by row
        while($row = mysqli_fetch_array($result)) {
          print '
          <p><b>Release Date:</b> '.$row['releaseDate'].' </p>
          <p><b>Length:</b> '.$row['length'].' mins </p>
          <p><b>Synopis:</b> '.$row['synopsis'].'</p>
          <a href="'.$row['RottenTomatoLink'].'">Click here to learn more</a>
          ';
        }
        mysqli_close($con);
        ?>
        <!-- <p class="date">10.04.09</p>
        <h4>The Box</h4>
        <p>Norma and Arthur Lewis are a suburban couple with a young child who receive an anonymous gift bearing fatal and irrevocable consequences.</p>
        <a href="#">Read more</a>  -->
      </div>
    </div>

    <div id="coming">
      <div class="head">
        <h3>Theaters</h3>
        <p class="text-right"><a href="seeall.php">See All Theaters</a></p>
      </div>
      <div class="content">
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
        $sql="SELECT DISTINCT theater_name FROM Show_Time WHERE Moviename = '".$movie."'";

        $result = mysqli_query($con,$sql);
        // Print the data from the table row by row

        while($row = mysqli_fetch_array($result)) {
          $sql2 = "SELECT showtime FROM Show_Time WHERE Moviename = '".$movie."' AND theater_name = '".$row['theater_name']."'";
          $result2 = mysqli_query($con, $sql2);
          echo '<h4> '.$row['theater_name'].' </h4>';
          while($row2 = mysqli_fetch_array($result2)) {
            $mov = array();
            $mov[] = $row2['showtime'];
            foreach($mov as $val) {
              print ' <a href="purchase.php?moviename='.$movie.'&showtime='.$val.'&theater='.$row['theater_name'].'" class="class1"> '.$val.' </a>';
            }
          }
        }
        mysqli_close($con);
        ?>
        <!-- <h4>The Princess and the Frog </h4>
        <a href="#"><img src="css/images/coming-soon1.jpg" alt="" /></a>
        <p>Walt Disney Animation Studios presents the musical &quot;The Princess and the Frog,&quot; an animated comedy set in the great city of New Orleans...</p>
        <a href="#">Read more</a> -->
      </div>
      <div class="cl">&nbsp;</div>
    </div>

    <div class="cl">&nbsp;</div>
  </div>
  <div id="footer">
    <p class="lf">Copyright &copy; 2018 <a href="#">MovieSearch</a> - All Rights Reserved</p>
    <p class="rf">Design by <a href="#">MovieSearch Team</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>
