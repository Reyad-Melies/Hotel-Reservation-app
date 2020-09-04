<?php 
  session_start(); 
  
  if ((date("h:i:sa"))-$_SESSION['timenow']>30) {
  $query_insert = mysqli_query($conn,"UPDATE hotel SET approval = '1' WHERE hotelname = '$hname'" );
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system for hotel owners</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 18px;
   text-align: left;
     } 
  th {
   background-color: #5F9EA0;;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
  
</head>
<body>
  <div class="header">
  	<h1>hotel confirmation </h1>
  </div>
	
  <form method="post" action="broker.php">
	 <table>
 <tr>
  <th>hotelname</th> 
  <th>stars</th> 
  <th>rating</th>
    <th>location</th>
 </tr>
	<?php
		$db = mysqli_connect('localhost', 'root', '', 'hotel');
		$select=mysqli_query($db,"select hotelname, stars, rating , location FROM hotel WHERE approval=0");
		
		while ($hotel = mysqli_fetch_assoc($select))
		{
			
		echo( "<tr><td>". $hotel['hotelname']. "</td><td>" .$hotel['stars']. "</td><td>" .$hotel['rating']. "</td><td>" .$hotel['location']. "</td><td>"  );
		
		}
		echo "</table>";
	?>
	
	<div class="input-group">
    <label for="hotelname"><b>hotelname</b></label>
    <input type="text" placeholder="Enter username" id="hotelname" name="hotelname" required>
	</div>
	
	<button type="submit" class="btn" name="approved">approve</button>
	<button type="submit" class="btn" name="declined">decline</button>
		<button type="submit" class="btn" name="suspended">suspended</button>


   </form>
</body>
</html>


<?php
$conn = mysqli_connect('localhost', 'root', '', 'hotel');

if(isset($_POST['approved']))
{
	$hname =$_POST['hotelname']; 

$query_insert = mysqli_query($conn,"UPDATE hotel SET approval = '1' WHERE hotelname = '$hname'" );
}

if(isset($_POST['suspended']))
{
	$hname =$_POST['hotelname']; 

$query_insert = mysqli_query($conn,"UPDATE hotel SET approval = '2' WHERE hotelname = '$hname'" );
}
?>


<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 18px;
   text-align: left;
     } 
  th {
   background-color: #5F9EA0;;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
  <div class="header">
  	<h1>hotel history </h1>
  </div>
	
  <form method="post" action="broker.php">
  
	 <table>
 <tr>
  <th>hotel name  </th> 
  <th>  stars</th> 
  <th>rating</th>
    <th>location</th>
  <th>approval</th>
 </tr>
	<?php
		$db = mysqli_connect('localhost', 'root', '', 'hotel');
		$select=mysqli_query($db,"select hotelname, stars, rating , location, approval FROM hotel ");
		
		while ($hotel = mysqli_fetch_assoc($select))
		{
			
		echo( "<tr><td>". $hotel['hotelname']. "</td><td>" .$hotel['stars']. "</td><td>" .$hotel['rating']. "</td><td>" .$hotel['location']. "</td><td>" .$hotel['approval']. "</td></tr>" );
		
		}
		echo "</table>";
	?>
	


   </form>
</body>
</html>
