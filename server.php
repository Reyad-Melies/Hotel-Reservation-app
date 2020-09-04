<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$password_1  ="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'hotel_reservation');

// REGISTER owner
if (isset($_POST['submit_owner'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM hotelowner WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO hotelowner ( email,username, password) 
  			  VALUES( '$email','$username', '$password_1')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: hotelinfo.php');
  }
}


// ...

// LOGIN owners
if (isset($_POST['login_owner'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password_2)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	//$password = md5($password_2);
  	$query = "SELECT * FROM hotelowner WHERE username='$username' AND password='$password_2'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {		
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: hotelinfo.php');
  	}
      else {
  		array_push($errors, "Wrong username or password combination");
  	}
  }
}

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $ssn = mysqli_real_escape_string($db, $_POST['ssn']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($ssn)) { array_push($errors, "ssn is required"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO customers ( ssn,email,username, password) 
  			  VALUES( '$ssn','$email','$username', '$password_1')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: memindex.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password_2)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	//$password_3 = md5($password_2);
  	$query = "SELECT * FROM customers WHERE username='$username' AND password='$password_2'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
		
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: mesmindex.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


//members index
if (isset($_POST['reserve'])) {
  // receive all input values from the form
  $hname = mysqli_real_escape_string($db, $_POST['hname']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
  $location = mysqli_real_escape_string($db, $_POST['loc']);
  $stars = mysqli_real_escape_string($db, $_POST['stars']);


  // first check the database to make sure 
  // a user does not already exist with the same hotel name 
  $user_check_query = "SELECT * FROM hotel WHERE hname='$hname' and/or type='$type' and/or  price='$price' and/or location='$location' and/or stars='$stars'";
  $result = mysqli_query($db, $user_check_query);
  $hotel = mysqli_fetch_assoc($result);
  
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "hname: " . $row["hname"]. " - type: " . $row["type"]. "-price " . $row["price"]. "location" .$row["location"]. "-stars".$row["stars"] , "<br>";
    }
}
 else {
    echo "0 results";
}  
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "broker approved ";
  	header('location: reservation.php');
  }



?> 