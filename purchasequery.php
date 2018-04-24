f(isset($_SESSION['loggedin'])){
  if ($_SESSION['loggedin'] == TRUE){

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
   
$num = $_POST['qty'];
$show = $_POST['show'];
$movie = $_POST['movie'];
$email = $_SESSION['email'];
for($i=0; $i < $num; $i++) {
// Form the SQL query (an INSERT query)
$sql="INSERT INTO Purchase_Tickets (email_id, ticket_id, showtime, Quanity)
VALUES
('$email','','$_POST[show]','1')";

if (!mysqli_query($con,$sql))
  {
    die('Error: ' . mysqli_error($con));
  }
}

$alreadythere = 0;

$sql12 = "SELECT Moviename, Quanity FROM Tickets WHERE Moviename = '".$movie."'";
$result = mysqli_query($con,$sql12);
while($row20 = mysqli_fetch_array($result)) { 

  if ($row20['Moviename'] == $movie) { 
    $alreadythere = 1;
  }

  if($alreadythere == 1) {
    $qty = $row20['Quanity'] + $num;
    $sql11="UPDATE Tickets SET Quanity = $qty WHERE Moviename = '".$movie."'";
    
    if (!mysqli_query($con,$sql11))
      {
	die('Error: ' . mysqli_error($con));
      }
  }

}
if (!mysqli_query($con,$sql12))
  {
    die('Error: ' . mysqli_error($con));
  }

if($alreadythere == 0) {
    $sql13="INSERT INTO Tickets (ticket_id, showtime, Moviename, Quanity)                                                                                                                   
     VALUES                                                                                                                                                                                 
      ('','$show','$movie', '$num')";

    if (!mysqli_query($con,$sql13))
      {
	die('Error: ' . mysqli_error($con));
      }
}

$sql3="INSERT INTO Watch_Movies (email_id, Moviename, ticket_id)
VALUES 
('$email','$_POST[movie]', '')";


if (!mysqli_query($con,$sql3))
  {
    die('Error: ' . mysqli_error($con));
  }

$sql5 = "SELECT reward_id FROM Earn_Rewards WHERE email_id = '".$email."'";
$result5 = mysqli_query($con, $sql5); 
while($row5 = mysqli_fetch_array($result5)) { 
$sql6 = "SELECT points FROM Rewards WHERE reward_id = ' ".$row5['reward_id']."'";
$result6 = mysqli_query($con, $sql6);

$pointsVar = 0;
while($row6 = mysqli_fetch_array($result6)) {
  $pointsVar = $row6['points'] + ($num * 100);
  $sql4="UPDATE Rewards SET points = $pointsVar WHERE reward_id = ' ".$row5['reward_id']."'";
}
}
if (!mysqli_query($con,$sql4))
  {
    die('Error: ' . mysqli_error($con));
  }

if (!mysqli_query($con,$sql5))
  {
    die('Error: ' . mysqli_error($con));
  }
if (!mysqli_query($con,$sql6))
  {
    die('Error: ' . mysqli_error($con));
  }


  }
  if($pointsVar >= 1000){
	 header("Location: confirmation.php?receiveReward=true");
  }else{
	 header("Location: confirmation.php?receiveReward=false");
  }
}
else { 
  header("Location: login.html");
} 

mysqli_close($con);
?>

