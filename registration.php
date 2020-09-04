<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system for users</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h1>Register for users</h1>
  </div>
	
  <form method="post" action="registration.php">
  	<?php include('error.php'); ?>

 <div class="input-group">
    <label for="ssn"><b>ssn</b></label>
    <input type="int" placeholder="Enter ssn" id="ssn" name="ssn" required>
</div>


<div class="input-group">
    <label for="username"><b>username</b></label>
    <input type="text" placeholder="Enter username" id="UN" name="username" value="<?php echo $username; ?>" required>
    </div>


<div class="input-group">
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" id="mail" name="email" value="<?php echo $email; ?>" required>
</div>

<div class="input-group">
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="pw" name="password" required>
    </div>
	
   <div class="input-group">
  	  <button type="submit" class="btn" name="submit">Register</button>
  	</div>
	
  	 <p>  		Already a member? <a href="login.php">Sign in</a>  	</p>

     <p>  already an owner ? <a href="loginowner.php">Sign in</a>  	</p>

     <p>  Not yet an owner? <a href="registrationowner.php">Sign up</a>     </p>

  </form>
</body>
</html>

