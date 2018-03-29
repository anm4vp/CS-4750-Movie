<?php

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$alreadythere = 0;

$query = "select email_id from User";
$result = $con->query($query) or die ("Invalid selection " . $con->error);
$rows = $result->num_rows;
for($i = 0; $i < $rows; $i++){
	if ($result->fetch_array()['email_id'] == $_POST[Email]):
		$alreadythere = 1;
	endif;
}

if ($alreadythere == 0 ):
  // Form the SQL query (an INSERT query)
  $sql="INSERT INTO User (email_id, password, FirstN, LastN, phoneNumber)
  VALUES
  ('$_POST[Email]','$_POST[pw]','$_POST[FirstName]','$_POST[LastName]','$_POST[phone]')";

  if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
	session_start();
	$_SESSION['FirstN'] = $_POST[FirstName];
  $_SESSION['LastN'] = $_POST[LastName];
	$_SESSION['loggedin'] = TRUE;

  header("Location: index.php");

else:
  header("Location: signup.html");
endif;

mysqli_close($con);
?>
