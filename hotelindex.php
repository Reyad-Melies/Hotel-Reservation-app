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
   <?phpinclude('server.php') ?>


<!DOCTYPE html>
<html>


<head>
	<title>owner</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>




<div class="header">
	<h2>hotel details</h2>
</div>

<div class="content">

  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>


	 
  
  <form method="post" action="hotelindex.php">
  	<?php include('error.php'); ?>
    <p>Please fill all the fields.</p>
    <hr>

<div class="input-group">
    <label for="hname"><b>hotel name</b></label>
    <input type="text" placeholder="Enter hotel name" id="UN" name="hname" required>
</div>

    <div class="input-group">
    <label for="type"><b>type</b></label>
    <input type="text" placeholder="Enter type  of the rooms" id="ty" name="type" required>
</div>



<div class="input-group">
    <label for="price"><b>price</b></label>
    <input type="int" placeholder="Enter price" id="pc" name="price" >
    </div>





<div class="input-group">
    <label for="loc"><b>locaction</b></label>
    <input type="text" placeholder="Enter location" id="loc" name="loc" >
    </div>
	
	<div class="input-group">
    <label for="loc"><b>stars</b></label>
    <input type="int" placeholder="Enter stars" id="st" name="stars" >
    </div>
	

    <div class="input-group">
  		<button type="submit" class="btn" name="submit_hotel">submit</button>
  		<button type="submit" class="btn" name="login_user">finished</button>
  	</div>

  	
  

    	<p> <a href="hotelindex.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		</form>
</body>
</html>