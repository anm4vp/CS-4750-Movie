<?php session_start(); ?>

<?php

$q = ($_POST[Email]);

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$sql="SELECT email_id, password, FirstN, LastN FROM User WHERE email_id = '".$q."' ";
$result = mysqli_query($con,$sql);

$email = trim($_POST[Email]);
$password = trim($_POST[pw]);


if($row['email_id'] != $email && $row['password'] != $password) { 
  header('Location: login.html');
}  

while($row = mysqli_fetch_array($result)){

  if (($_SERVER["REQUEST_METHOD"] == "POST")) {

    if ($email != NULL && $password != NULL)
    {
      if (isset($_POST[Email]))
      {
        $email = trim($row[Email]);
        $_SESSION['email_id'] = $email;
        $_SESSION['loggedin'] = TRUE;
	$_SESSION['user'] = $row['FirstN'];
	$_SESSION['email'] = $row['email_id'];
        // relocate the browser to another page using the header() function to specify the target URL
        header('Location: MovieSearch.php');

      }
      else
      header('Location: login.html');
    }

  }
}

if (!mysqli_query($con,$sql))
  {
    die('Error: ' . mysqli_error($con));
  }
?>
