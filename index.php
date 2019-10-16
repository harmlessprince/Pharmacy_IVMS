<?php 
// include_once("./database/constants.php");
// include_once("./database/constants.php");
include('./includes/server.php') ;
//  
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
    <!-- <link rel="stylesheet" type ="text/css" href="../public_html/css/styles.css"> -->
    <script rel="stylesheet" type = "text/javascript" src ="./js/main.js"></script>
    <script rel="stylesheet" type = "text/javascript" src ="./js/manage.js"></script>

</head>
<body>
<!-- <div class="overlay"><div class ="loader"></div></div> -->
 <!-- Navbar -->
    <?php  include_once("./templates/indexheader.php"); ?>
    <br/><br/>
    <div class = "container">
       
        <div class="card mx-auto" style="width: 18rem;">
            <img src="./images/login.jpeg" class="card-img-top mx-auto" style="width:45%;" alt="Login Icon">
            <div class="card-body">
                <!-- <form id="form_login" onsubmit="return false"> -->
                <form method ="post" action ="<?php echo $_SERVER["PHP_SELF"];?>">
                
                    <?php include('errors.php'); ?>
                    <!-- <div id="message"></div> -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="log_email" placeholder="Enter email">
                        <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name ="password" id="log_password" placeholder="Password">
                        <!-- <small id="p_error" class="form-text text-muted"></small> -->
                    </div>
                    <button  type="submit" class="btn btn-primary loginBtn" name ="login_user">Login</button>
                    <span><h5 class="tex-danger text-center"><? $msg; ?></h5></span>
                    <!-- <span> Not yet a member? <a href="register.php">Register</a></span> -->
                </form>
            </div>
            <div class ="card-footer"> 
            
            <p><a href="#">Forget Password ?</a></p>
            <p class="alert text-primary" >
            NOTE: This server does not allow self registrations. If you need an account please contact the admin
            </p> 
            </div>
        </div>
    </div>
</body>
</html>

