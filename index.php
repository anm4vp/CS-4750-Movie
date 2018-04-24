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

<div id="shell">
<!-- START PAGE SOURCE -->
  <!-- Header -->
  <div id="header">
    <h1 id="logo"><a href="index.php">MovieSearch</a></h1>

    <div id="navigation">
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li><a href="top.php">TOP SELLING MOVIES</a></li>
        <li><a href="login.html">LOG IN</a></li>
        <li><a href="signup.html">SIGN UP</a></li>
      </ul>
    </div>
<div id="sub-navigation">
   <center>
   1) <a href="index.php" class=class2> Select a Movie</a>         
   2) <a class=class2> Movie Info</a>
   3) <a class=class2> Purchase Tickets</a>
</center>
      <div id="search">
      </div>
    </div>

</div>

  <!-- End Header -->

  <!-- Main -->
  <div id="main">
    <div id="content">
      <div class="box">
        <div class="head">

        </div>
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
$sql="SELECT Moviename, releaseDate FROM Movies";
$result = mysqli_query($con,$sql);
$count = 0;
// Print the data from the table row by row                                                                                                                                              
while($row = mysqli_fetch_array($result)) {
  if ($count % 6 == 6) {
 print '                                                                                                                                                                                          
         <div class="movie ">                                                                                                                                                                      
           <div class="movie-image"> <span class="play"><a href="info.php?moviename='.$row['Moviename'].'"><span cl\                                                                              
ass="name">'.$row['Moviename'].'</span></a></span><img src="css/images/'.$row['Moviename'].'.jpg" alt="hi" /> </div\                                                                              
>                                                                                                                                                                                                 
           <div class="rating">                                                                                                                                                                   
             <p>'.$row['Moviename'].'</p></br>                                                                                                                                                    
             <p>'.$row['releaseDate'].'</p>                                                                                                                                                       
             </br>                                                                                                                                                                                
          </div>                                                                                                                                                                                  
        </div>                                                                                                                                                                                    
           ';
  }
  
   else { 
         print '
         <div class="movie last">
           <div class="movie-image"> <span class="play"><a href="info.php?moviename='.$row['Moviename'].'"><span class="name">'.$row['Moviename'].'</span></a></span><img src="css/images/'.$row['Moviename'].'.jpg" alt="hi" /> </div>
           <div class="rating">
             <p>'.$row['Moviename'].'</p></br>
             <p>'.$row['releaseDate'].'</p>
             </br>
          </div>
        </div>
           ';
   }
   $count++; 
}
         mysqli_close($con);
        ?>
    </div>
  </div>

  <div class="cl">&nbsp;</div>

</div>

<!-- End Main -->

<!-- END PAGE SOURCE -->
<!-- FOOTER -->
<div id="footer">
  <p class="lf">Copyright &copy; 2018 <a href="#">MovieSearch</a> - All Rights Reserved</p>
  <p class="rf">Design by <a href="#">MovieSearch Team</a></p>
<div style="clear:both;"></div>
</div>
</div>
</body>
</html>
