
<?php
// include_once("./includes/server.php");
$db = mysqli_connect('localhost', 'harmless', 'Nokia1680.', 'IVMDB');
session_start();
if (!isset($_SESSION['usertype'])) {
    header("location:index.php");
}
$user_check_query = "SELECT * FROM user WHERE email = '".$_SESSION["email"]."'";
$result = mysqli_query($db, $user_check_query);
$row = mysqli_fetch_assoc($result);
// $query = "SELECT * FROM user WHERE email = '".$_SESSION["email"]."'";
// $statement = $db->prepare($query);
// $statement->execute();
// $Setresult = $statement->get_result();
// $result = $Setresult->fetch_all();
// print_r($result);
$name = $row['username'];
$email = $row['email'];
$role = $row['usertype'];
// echo $name;
// echo $email;
// echo $role;
// die();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Inventory management System </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type = "text/css" href ="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type = "text/javascript" src ="./js/main.js"></script>

</head>
<body>
 <!-- Navbar -->
    <?php  include_once("./templates/header.php"); ?>
    <br/><br/>
    <div class = "container">
        


    <div class="card mx auto" style="width: 30rem; margin:0 auto">
        <div class ="card-header"> Edit Profile </div>
    <div class="card-body">
        <!-- <form id ="register_form"  method onsubmit="return false" autocomplete="off"> -->
        <form method ="post" id="edit_profile_form">
        <!-- <?php  include("errors.php"); ?> -->
            <span id="message"></span>
            <div class="form-group">
                <label for="username">Full name  </label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $name; ?>" placeholder="Please Your Enter Full Name" required>
                <!-- <small id="u_error" class="form-text text-muted"></small> -->
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id ="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter email" required>
                <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" name="password1"class="form-control" id="password1" placeholder="Password" required>
                <!-- <small id="p1_error" class="form-text text-muted"></small> -->
            </div>
            <div class="form-group">
                <label for="password2">Re-enter Password</label>
                <input type="password" name="password2"class="form-control" id="password2" placeholder="Password" required>
                <small id="error_password" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="usertype">User-type</label>
                <select name="usertype" class="form-control" required>
                    <option value="">Choose user type</option>
                    <option value="admin">Admin</option>
                    <option value="user">Other User</option>
                </select>
                <small id="t_error" class="form-text text-muted"></small> 
            </div>
            <button type="submit" name="edit_profile" id="edit_profile" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Update Profile</button>
        </form>
  </div>
  <div class="card-footer text-muted">
  </div>
</div>

</div>
</body>
</html>
