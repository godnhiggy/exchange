<?php
include('server.php');
ob_start();
  session_start();


/* if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: video_login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: video_login.php");
  }
*/
//set variables
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $telcarrier = $_POST["telcarrier"];
    $phone = $_POST["phone"];
    $item1 = $_POST["item1"];
    $item2 = $_POST["item2"];
    $myDB = "bjekqemy_aleph";
    $customer = $_SESSION["customer"];
    //echo $myDB;
$db = mysqli_connect('localhost', 'bjekqemy_higgy', 'Brett73085', $myDB);
if (isset($_POST["firstName"])) {
//connect to db
$phone =  preg_replace("/[^0-9]/","", $phone);
//connect_db($myDB);


//insert customer info into db

  	$query = "INSERT INTO $customer (firstName, lastName, email, telcarrier, phone, item1, item2)
  			  VALUES('$firstName', '$lastName', '$email', '$telcarrier', '$phone', '$item1', '$item2')";
  	mysqli_query($db, $query);

  	header('location: cust_input.php');
}
?>
<html>
<head>
  <title>Hitting the Highlights</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h1>SimpleShare</h1>
  	<h2>share your thoughts, products and ideas!</h2>

  </div>

  <form action="customer_email.php" method="POST">
 <div>
   <h1>Video Finalized...Now SimpleShare with your lists!</h1>

   <h3>Customer Email List</h3>

   <?php

   echo "<select id='customers' name='customers[]' multiple>";
   $sql = "SELECT *
   FROM $customer ORDER BY lastName";
   //$result = $conn->query($sql);

   $result=mysqli_query($db, $sql);
   if ($result->num_rows > 0)
             {

       // output data of each row
       while($row = $result->fetch_assoc()) {
$firstName = $row["firstName"];
$lastName = $row["lastName"];
//$phone= $row["phone"];
$email = $row["email"];


             echo "<option value='$email'>".$firstName." ".$lastName."--".$email."</option>";
             //echo "<option value='$phone'>".$firstName." ".$lastName."--".$phone."</option>";

}
}

 ?>
   </select>
 </div>
 <div>
   <h3>Customer Text List</h3>
   <?php
   echo "<select id='customers' name='customers[]' multiple>";
   $sql = "SELECT *
   FROM $customer ORDER BY lastName";
   //$result = $conn->query($sql);

   $result=mysqli_query($db, $sql);
   if ($result->num_rows > 0)
             {

       // output data of each row
       while($row = $result->fetch_assoc()) {
   $firstName = $row["firstName"];
   $lastName = $row["lastName"];
   $phone = $row["phone"];
   $telcarrier = $row["telcarrier"];
   $text = $phone.$telcarrier;


             echo "<option value='$text'>".$firstName." ".$lastName."--".$text."</option>";
             //echo "<option value='$phone'>".$firstName." ".$lastName."--".$phone."</option>";

   }
   }
   ?>
   </select>
 </div>

<div>

<input type='submit' name='submit' value='Send Video!'/>


</div>
</form>







</body>
</html>
<?php
//unset($_SESSION["videotracker"]);
 ?>
