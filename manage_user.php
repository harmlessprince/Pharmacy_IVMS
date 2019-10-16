<!-- New line of code starts here -->
<?php include('./includes/server.php') ?>
<?php 

// session_start(); 
//    var_dump($_SESSION);

if (!isset($_SESSION['email'] )) {
   $_SESSION['msg'] = "You must log in first";
   header('location: index.php');
}
if (isset($_GET['logout'])) {
   session_destroy();
   unset($_SESSION['email']);
   header("location: index.php");
}
?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title> Inventory management System </title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" type = "text/css" href ="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <script type = "text/javascript" src ="./js/manage.js"></script>

</head>
<body>

<!-- new line of code ends her  -->
<!-- Navbar -->
 <?php  include_once("./templates/header.php"); ?>
 <br/><br/>
 <div class="container">
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user_modal">
<i class="i fa fa-plus">&nbsp;</i>Add New User
</button>
 <!-- <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary"><i class="i fa fa-plus">&nbsp;</i>Add</a> -->
	<div class="card">
		<h5 class="card-header">User List</h5>
		<span id = "message"></span>
		<div class="card-body"  id ="user_data">
		</div>
	</div>
</div>

<?php
  include_once("./templates/addUser.php");
  // include_once("./templates/editUser.php");
?>

</body>
</html>

