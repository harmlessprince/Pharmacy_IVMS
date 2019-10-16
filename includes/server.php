<?php
// include_once("../database/constants.php");
session_start();
$date = date ("Y-m-d h:i:sa");
// initializing variables
$username = "";
$email    = "";
$usertype = "";
// $user_status="";
// $message = "";
$errors = array();

// connect to the database
// connect to the database
$db = mysqli_connect('localhost', 'harmless', 'Nokia1680.', 'IVMDB');


//Add New User to system Under Manage_User.php page
    
if (isset($_POST['add_user'])) {

  
      // receive all input values from the form
      $username = mysqli_real_escape_string($db, $_POST['user_name']);
      $email = mysqli_real_escape_string($db, $_POST['user_email']);
      $password1 = mysqli_real_escape_string($db, $_POST['user_password1']);
      $password2 = mysqli_real_escape_string($db, $_POST['user_password2']);
      $usertype = mysqli_real_escape_string($db, $_POST['usertype']);
  
  if ($password1 != $password2) {
    array_push($errors, "The passwords do not match");
    }
    if (empty($usertype)) { array_push($errors, "User Type is required"); }

    $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
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
    if (count($errors) == 0) {
      $password = md5($password1);
      
      $query = "INSERT INTO user (username, email, password, register_date, last_login,usertype) 
      VALUES('$username', '$email', '$password','$date', '$date','$usertype')";
  mysqli_query($db, $query);
  header('location: manage_user.php');
    
    }
    

}
//New code Starts Ends Here Motherfucker


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $usertype = mysqli_real_escape_string($db, $_POST['usertype']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password1)) { array_push($errors, "Password is required"); }
  if (empty($usertype)) { array_push($errors, "User Type is required"); }
  if ($password1 != $password2) {
	array_push($errors, "The two passwords do not match");
  }
//   if (empty($usertype)) { array_push($errors, "User type is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
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
  	$password = md5($password1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, email, password, register_date, last_login,usertype) 
  			  VALUES('$username', '$email', '$password','$date', '$date','$usertype')";
  	mysqli_query($db, $query);
  	// $_SESSION['email'] = $email;
  	// $_SESSION['success'] = "You are now registered";
  	header('location: index.php');
  }

}
//////////////////////////////////////////////////////////
// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email'] );
    $password = mysqli_real_escape_string($db, $_POST['password']);

  
    if (empty($email)) {
        array_push($errors, "Email Address is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
       
        $query = "SELECT * FROM user WHERE email=? AND password=?";
        // //New line of code starts here
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss",$email,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


          if ($result->num_rows == 1 && $row['usertype']=="user") {
            if ($row['user_status'] == 'Active') {
              header("location: dashboard.php");
            }else {
              array_push($errors, "<div class='alert alert-success'>Your account has been disabled. Please contact admin</div>");
            }
            
          }elseif($result->num_rows == 1 && $row['usertype']=="admin"){
            if ($row['user_status'] == 'Active') {
              header("location: dashboard.php");
            }else {
              array_push($errors, "<div class='alert alert-success'>Your account has been disabled. Please contact admin</div>");
            }
          }else{
            array_push($errors, "Wrong email /password combination");
          }
       
        $_SESSION['email'] = $row["email"];
        $_SESSION['usertype'] = $row["usertype"];
    }
  }

?>