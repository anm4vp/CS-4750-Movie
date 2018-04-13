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
        <li><a href="login.html">LOG IN</a></li>
        <li><a href="signup.html">SIGN UP</a></li>
      </ul>
    </div>


    <div id="sub-navigation">
      <div id="search">
        <form action="#" method="get" accept-charset="utf-8">
          <label for="search-field">SEARCH</label>
          <input type="text" name="search field" value="Enter search here" id="search-field" class="blink search-field"  />
          <input type="submit" value="GO!" class="search-button" />
        </form>
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
         // Print the data from the table row by row
         while($row = mysqli_fetch_array($result)) {
         print '
         <div class="movie">
           <div class="movie-image"> <span class="play"><a href="info.php"><span class="name">'.$row['Moviename'].'</span></a></span><img src="css/images/'.$row['Moviename'].'.jpg" alt="hi" /> </div>
           <div class="rating">
            <font-size="20em"><p>'.$row['Moviename'].'</p></font>
            <br>
             <p>'.$row['releaseDate'].'</p>
          </div>
        </div>
           ';
         }
         mysqli_close($con);
        ?>
    </div>
  </div>
</div>
</br>
</br>
<!-- End Main -->

<!-- END PAGE SOURCE -->
</div>
</body>
</html>
