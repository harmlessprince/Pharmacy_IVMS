<?php include('./includes/server.php') ?>
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
    <!-- <script type = "text/javascript" src ="./js/main.js"></script> -->

</head>
<body>
 <!-- Navbar -->
    <?php  include_once("./templates/header.php"); ?>
    <br/><br/>
    <div class = "container">
        


    <div class="card mx auto" style="width: 30rem; margin:0 auto">
        <div class ="card-header"> Register </div>
    <div class="card-body">
        <!-- <form id ="register_form"  method onsubmit="return false" autocomplete="off"> -->
        <form method ="post" action="register.php">
        <?php  include("errors.php"); ?>
            <div class="form-group">
                <label for="username">Full name  </label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Please Your Enter Full Name">
                <!-- <small id="u_error" class="form-text text-muted"></small> -->
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email"class="form-control" value="<?php echo $email; ?>" placeholder="Enter email">
                <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" name="password1"class="form-control" id="password1" placeholder="Password">
                <!-- <small id="p1_error" class="form-text text-muted"></small> -->
            </div>
            <div class="form-group">
                <label for="password2">Re-enter Password</label>
                <input type="password" name="password2"class="form-control" id="password2" placeholder="Password">
                <!-- <small id="p2_error" class="form-text text-muted"></small> -->
            </div>
            <div class="form-group">
                <label for="usertype">User-type</label>
                <select name="usertype" class="form-control">
                    <option value="">Choose user type</option>
                    <option value="admin">Admin</option>
                    <option value="user">Other User</option>
                </select>
                <small id="t_error" class="form-text text-muted"></small> 
            </div>
            <button type="submit" name="reg_user" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register</button>
            <span>Already a member ?<a href="index.php">Login</a></span>
        </form>
  </div>
  <div class="card-footer text-muted">
  </div>
</div>





    </div>
</body>
</html>

