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

$hashed = md5($_POST['pw']);

if ($alreadythere == 0 ):
  // Form the SQL query (an INSERT query)
  $sql="INSERT INTO User (email_id, password, FirstN, LastN, phoneNumber)
  VALUES
  ('$_POST[Email]','$hashed','$_POST[FirstName]','$_POST[LastName]','$_POST[phone]')";
  $sql2="INSERT INTO Earn_Rewards(email_id, reward_id)
  VALUES
  ('$_POST[Email]', '')";
if (!mysqli_query($con,$sql2))
  {
    die('Error: ' . mysqli_error($con));
  }
$sql3="INSERT INTO Rewards(points, reward_id)                                                                                                                             
  VALUES                                                                                                                                                                           
  ('0', '')";
if (!mysqli_query($con,$sql3))
  {
    die('Error: ' . mysqli_error($con));
  }

  if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
	session_start();
	$_SESSION['user'] = $_POST['FirstName'];
	$_SESSION['loggedin'] = TRUE;
$_SESSION['email'] = $_POST['Email'];

  header("Location: MovieSearch.php");

else:
  header("Location: signup.html");
endif;

mysqli_close($con);
?>
