<?php 

  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

?>
<link rel="stylesheet" type="text/css" href="style.css">
<form method="post">
	<div class="container">
    <h1>please enter the hotel's information</h1>
    <hr>


<div class="input-group">
    
	
	<label for="type"><b>type</b></label>
    <input type="text" placeholder="Enter type  of the rooms" id="type" name="type" >
	
    <label for="price"><b>price</b></label>
    <input type="text" placeholder="Enter price" id="price" name="price" >
	
	<label for="location"><b>location</b></label>
    <input type="text" placeholder="Enter location" id="location" name="location" >
	
	<label for="stars"><b>stars</b></label>
    <input type="int" placeholder="Enter stars" id="stars" name="stars" >
	
	<label for="rating"><b>rating</b></label>
    <input type="int" placeholder="Enter stars" id="rating" name="rating" >
	
	<input name="search" type="submit" >
	</div>
	<p> <a href="memindex.php?logout='1'" style="color: red;">logout</a> </p>

</form>
<?php
$db = mysqli_connect('localhost', 'root', '', 'hotel_reservation');
if (isset($_POST['search'])) {
  // receive all input values from the form
  $rating = mysqli_real_escape_string($db, $_POST['rating']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $location = mysqli_real_escape_string($db, $_POST['location']);
  $stars = mysqli_real_escape_string($db, $_POST['stars']);
   
  $sql ="CREATE TABLE toto (hotelname VARCHAR(50)
                   ,location VARCHAR(50)
		   ,owner_username VARCHAR(50)                 
         	   ,stars int(5)         
	           ,rating decimal(5)
                   ,type	VARCHAR(10)
               ,price	decimal(11)
		,room_no INT(5)
		,image LONGBLOB
		,facilities VARCHAR(200)
		,tt VARCHAR(50)
		
                  );";


if(mysqli_query($db, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
} 

$sql1 ="INSERT INTO toto (`hotelname`,`owner_username`,`location`,`stars`,`rating`,`room_no`,`tt`,`type`,`price`,`image`,`facilities`)
SELECT * FROM hotel INNER JOIN hotelrooms ON hotel.hotelname=hotelrooms.hotelname;";
mysqli_query($db,$sql1);
$sql2 = "ALTER TABLE toto drop tt;";
mysqli_query($db,$sql2);

	echo ('ssss');
	if (!empty($rating)){
		$query_select = mysqli_query($db,"delete from toto where rating<>$rating or rating is null");
		
	}
	if (!empty($location)){
		$query_select = mysqli_query($db,"delete from toto where location<>$location");
	}
	if (!empty($stars)){
		$query_select = mysqli_query($db,"delete from toto where stars<>$stars");
	}
	if (!empty($price)){
		$query_select = mysqli_query($db,"delete from toto where price<>$price");
	}
	if (!empty($type)){
		$query_select = mysqli_query($db,"delete from toto where type<>$type");
	}
  // first check the database to make sure 
  // a user does not already exist with the same hotel name 
    $query_select = mysqli_query($db,"SELECT * FROM toto ");
 echo('dodo');
    while($hotel = mysqli_fetch_assoc($query_select)) {
        echo ($hotel['hotelname']);
    }

  	/* $_SESSION['username'] = $username;
  	$_SESSION['success'] = "broker approved ";
  	header('location: memindex. php');*/
  }
?>