<?php 

  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: loginowner.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: loginowner.php");
  }

?>

<html>
<head>
 <link rel="stylesheet" type="text/css" href="style.css">
<form method="post">
 <div class="input-group">
			<p> <a href="ownerhome.php" style="color: blue;">home</a> </p>

  	</div>

  <div class="container">
    <h1>please enter the hotel's information</h1>
    <hr>


<div class="input-group">
    <label for="hotelname"><b>hotelname</b></label>
    <input type="text" placeholder="Enter username" id="hotelname" name="hotelname" required>
	
	<label for="type"><b>type</b></label>
    <input type="text" placeholder="Enter type  of the rooms" id="type" name="type" required>

    <label for="count"><b>count</b></label>
    <input type="int" placeholder="Enter no. of the rooms" id="count" name="count" required>
	
    <label for="price"><b>price</b></label>
    <input type="text" placeholder="Enter price" id="price" name="price" required>
	
	<label for="facilities"><b>facilities</b></label>
    <input type="text" placeholder="Enter facilities" id="facilities" name="facilities" required>
	
	<label for="image"><b>image</b></label>
    <input type="longblob" placeholder="Enter image" id="image" name="image" required>
	
	<label for="location"><b>location</b></label>
    <input type="text" placeholder="Enter location" id="location" name="location" required>
	
	<label for="stars"><b>stars</b></label>
    <input type="text" placeholder="Enter stars" id="stars" name="stars" required>
	
	<input name="submit" type="submit" >
	</div>
	
	<p> <a href="hotelinfo.php?logout='1'" style="color: red;">logout</a> </p>

</form>
</body>
</html>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'hotel_reservation');
		if (isset($_POST['ownerhome'])) {

		  	  header('location: ownerhome.php');
		}
			  
if(isset($_POST['submit']))
{
	$username = $_SESSION['username'];
	$hname = $_POST['hotelname'];
	$type = $_POST['type'];
	$count = $_POST['count'];
	$price = $_POST['price'];
	$facilities = $_POST['facilities'];
	$image = $_POST['image'];
	$location = $_POST['location'];
	$stars = $_POST['stars'];
	$query_select = mysqli_query($conn,"SELECT * FROM hotelrooms");
	while ($hotel = mysqli_fetch_assoc($query_select))
	{
		if ($hotel['hotelname'] === $hname && $hotel['type'] === $type)
		{
			die("hotel already exists");
		}
		
	}
	$result=mysqli_query($conn,"SELECT hotelname FROM hotelrooms WHERE hotelname='$hname'");
	$rowcount=mysqli_num_rows($result);
	echo($rowcount);
	$query_insert = mysqli_query($conn,"INSERT INTO hotel(owner_username,hotelname,location,stars)
	VALUES ('$username','$hname','$location','$stars')");
	$count=$count+1+$rowcount;
	$i=1+$rowcount;
	echo($i);
	echo($count);
	echo($rowcount);
	while($i < $count){

		$query = "INSERT INTO hotelrooms ( room_no,hotelname,type, price,facilities,image) 
  			  VALUES( '$i','$hname','$type', '$price','$facilities','$image')";
  	mysqli_query($conn, $query);
	$i++;
	
	}
	$_SESSION['hname'] = $hname;
  	  //$_SESSION['success'] = "You are now logged in";
  	  $_SESSION['timenow']=date("h:i:sa");
	  
	    	header('location: hotelinfo.php');

}
?>

