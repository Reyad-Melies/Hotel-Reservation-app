<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>login for hotel owners </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login for owners</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('error.php'); ?>
  
    <p>Please fill all the fields.</p>
    <hr>

    <div class="input-group">
    <label for="username"><b>username</b></label>
    <input type="text" placeholder="Enter username" id="UN" name="username" required>
</div>

<div class="input-group">
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="pw" name="password" required>
    </div>

    <div class="input-group">
  		<button type="submit" class="btn" name="login_owner">Login</button>
  	</div>
  	 <p>  Not yet an owner? <a href="registrationowner.php">Sign up</a>     </p>

     <p>  want to be a member? <a href="registration.php">Sign up</a>   </p>

     <p>  if you are a member? <a href="login.php">Sign in</a>  	</p>
  </form>
</body>
</html>