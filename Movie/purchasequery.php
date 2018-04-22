<?php

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Form the SQL query (an INSERT query)
$sql="INSERT INTO User (email_id, password, FirstN, LastN, phoneNumber)
VALUES
('ahihioh@gmail.com','password','password','mo','57575777')";

if (!mysqli_query($con,$sql))
{
die('Error: ' . mysqli_error($con));
}

header("Location: index.php");

else:
header("Location: signup.html");
endif;

mysqli_close($con);
?>
