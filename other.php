<?php
 session_start(); 
if (!isset($_SESSION['email']) || $_SESSION['usertype']!="user") {
    header("location:index.php");
}
if (!isset($_SESSION['usertype'] )) {
    // $_SESSION['msg'] = "You must log in first";
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
 <script type = "text/javascript" src ="./js/main.js"></script>

</head>
<body>


</div>
<!-- new line of code ends her  -->
<!-- Navbar -->
 <?php  include_once("./templates/header.php"); ?>
 <br/><br/>
 
 <div class = "container">



 <!-- new code ends here -->
     <div class = "row"> 
     <!-- Profile coloumn starts here-->
         <div class="col-md-4">
             <div class="card mx-auto">
                 <img src="./images/user.png" class="card-img-top mx-auto" style="width:45%" alt="User Icon">
                 <div class="card-body">
                     <h5 class="card-title">Profile Info</h5>
                     <p class="card-text"><i class="i fa fa-user">&nbsp;</i><?= $_SESSION['email']?></p>
                     <p class="card-text"><i class="i fa fa-user">&nbsp;</i><?= $_SESSION['usertype']?></p>
                     <p class="card-text">Last Login: xx-xx-xxx</p>
                     <a href="manage_user.php" class="btn btn-primary"><i class="i fa fa-edit">&nbsp;</i>Edit Profile</a>
                 </div>
             </div>
         </div>
     <!-- Profile coloumn ends here -->
         <div class="col-md-8">
         <div class="jumbotron" style=" width:100%; height: 100%">
                <!-- logged in user information -->
                 <?php  if (isset($_SESSION['email'])) : ?>
                     <p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>
                     <!-- <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p> -->
                 <?php endif ?>
             <div class="row">
                 <div class="col-sm-6">
                 <iframe src="http://free.timeanddate.com/clock/i6wka5th/n5324/szw160/szh160/hoc000/hbw2/hfceee/cf100/hncccc/fdi76/mqc000/mql10/mqw4/mqd98/mhc000/mhl10/mhw4/mhd98/mmc000/mml10/mmw1/mmd98" frameborder="0" width="160" height="160"></iframe>
                 </div>
                 <div class="col-sm-6">
                     <div class="card">
                         <div class="card-body">
                             <h5 class="card-title">New Orders</h5>
                             <p class="card-text">Here you can make invoices and create new orders</p>
                             <a href="new_order.php" class="btn btn-primary">New Orders</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
     </div>
 </div>
 <br/>
 </div>
</body>
</html>

