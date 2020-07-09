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
    //$id = $_POST["customers"];

    if (isset($_POST["customerEdit"]))
    {$_SESSION["customerEdit"] = $_POST["customerEdit"];}
$id = $_SESSION["customerEdit"];
echo "id at the top -- ".$id;
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $telcarrier = $_POST["telcarrier"];
    $phone = $_POST["phone"];
    $item1 = $_POST["item1"];
    $item2 = $_POST["item2"];
    $myDB = "bjekqemy_aleph";
    $customer = $_SESSION["customer"];

echo "<br>Edited User is --".$firstName;
    //echo $myDB;
$db = mysqli_connect('localhost', 'bjekqemy_higgy', 'Brett73085', $myDB);
/////////////////////////////////////////insert


if (isset($_POST["editUser"])) {
//connect to db
echo "<br>ID is-- ".$firstName;
$phone =  preg_replace("/[^0-9]/","", $phone);

//insert customer info into db
$sql = "UPDATE $customer SET firstName='$firstName', lastName='$lastName', email='$email', telcarrier='$telcarrier', phone='$phone'  WHERE id='$id'";
  	//$query = "INSERT INTO $customer (firstName, lastName, email, telcarrier, phone, item1, item2)
  			  //VALUES('$firstName', '$lastName', '$email', '$telcarrier', '$phone', '$item1', '$item2')";
  	mysqli_query($db, $sql);

  	//header('location: cust_input.php');
}

if (isset($_POST["delete"])) {

$sql = "DELETE FROM $customer WHERE id = $id";

if (mysqli_query($db, $sql)) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

}

if (isset($_POST["edit"])) {

  $sql = "SELECT * FROM $customer WHERE id = $id";

  $result=mysqli_query($db,$sql);
    if ($result->num_rows > 0)
              {

        // output data of each row
        while($row = $result->fetch_assoc()) {
 $firstName = $row["firstName"];
 $lastName = $row["lastName"];
 $id= $row["id"];
 $email = $row["email"];
 $phone = $row["phone"];
 $telcarrier = $row["telcarrier"];
 echo "<br>Id at the bottom -- ".$id;
?>
 <div class="item1">
   <form method="post" action="">
   	<?php include('errors.php'); ?>
   	<div class="input-group">
       <h1>Edit your SimpleShare Contact!</h1>
   		<label>First Name</label>
   		<input type="text" name="firstName" value="<?php echo $firstName;?>">
   	</div>
   	<div class="input-group">
   		<label>Last Name</label>
   		<input type="text" name="lastName" value="<?php echo $lastName;?>">
   	</div>
   		<div class="input-group">
   		<label>Email</label>
   		<input type="email" name="email" value="<?php echo $email;?>">
   	</div>
   		<div class="input-group">
   		<label>Phone Carrier - <?php echo $telcarrier;?></label>
   		<select name="telcarrier" required>
     <option value="" selected>Choose Carrier</option>
     <option value="@txt.att.net">AT&T</option>
     <option value="@vtext.com">Verizon</option>
     <option value="@messaging.sprintpcs.com">Sprint</option>
     <option value="tmomail.net">T-Mobile</option>
     <option value="@metropcs.sms.us">Metro</option>
     <option value="@mms.cricketwireless.net">Cricket</option>
     <option value="none yet">No Carrier</option>
   </select>
   	</div>
   		<div class="input-group">
   		<label>Phone Number</label>
   		<input type="tel" name="phone" value="<?php echo $phone;?>">
   	</div>
   <!--		<div class="input-group">
   		<label>Item One</label>
   		<input type="text" name="item1">
   	</div>
   		<div class="input-group">
   		<label>Item Two</label>
   		<input type="text" name="item2">
   	</div>-->
   	<div class="input-group">
   		<button type="submit" class="btn" name="editUser">Submit Customer Info</button>
   	</div>
   	 </form>

 </div>

<?php
   }
 }
}
?>
<html>
<head>
  <title>Simple Share</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h1>SimpleShare!</h1>
  	<h2>share your thoughts, products and ideas!</h2>

  </div>

  <form action="" method="POST">
 <div>

   <?php

   echo "<select id='customers' name='customerEdit'>";
   $sql = "SELECT *
   FROM $customer ORDER BY lastName";
   //$result = $conn->query($sql);

   $result=mysqli_query($db, $sql);
   if ($result->num_rows > 0)
       {

       // output data of each row
       while($row = $result->fetch_assoc())
          {
$firstName = $row["firstName"];
$lastName = $row["lastName"];
$id= $row["id"];
$email = $row["email"];
echo $id;

             echo "<option value='$id'>".$id." ".$lastName."--".$email."</option>";
             //echo "<option value='$phone'>".$firstName." ".$lastName."--".$phone."</option>";

          }
         }

 ?>
   </select>
 </div>

<div>

<input type='submit' name='edit' value='Edit'/>
<input type='submit' name='delete' value='Delete'/>

</div>
</form>

</body>
</html>
<?php

 ?>
