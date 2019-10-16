<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="dashboard.php"><i class="fas fa-clinic-medical">&nbsp;</i>Inventory MS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav" >
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"> Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- <i class="i fa fa-home">&nbsp;</i> -->
      <?php
      
        if (isset ($_SESSION["usertype"]) && $_SESSION['usertype'] == 'admin'){
          ?>
          <!-- <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="i fa fa-user">&nbsp;</i>Logout</a>
          </li> -->
         
          <li class="nav-item">
            <a class="nav-link text-white" href="manage_categories.php">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="manage_brand.php">Brand</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="manage_product.php">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="manage_user.php">View Users</a>
          </li>
          <?php
        }else{
          ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="logout.php"><i class="i fa fa-user">&nbsp;</i>Logout</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="new_order.php">Make New Order</a>
            </li>


          <?php
        }
        
      ?>
    </ul>

     
    <?php
      
      if (isset ($_SESSION["usertype"]) && $_SESSION['usertype'] == 'admin'){
        ?>
         <!-- right nav-bar start her -->
         <ul class="navbar-nav ml-auto ">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                      <b>Welcome <?php echo $_SESSION['email']; ?></b>
                    
                  </a>
                  <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item edit_profile text-dark" href="profile.php">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="i fa fa-user">&nbsp;</i>Logout</a>
                  </div>
                </li>
        </ul>
        <?php
      }else{
        ?>
           <!-- right nav-bar start her -->
        <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                      <b>Welcome <?php echo $_SESSION['email']; ?></b>
                    
                  </a>
                  <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                    <!-- <a class="dropdown-item edit_profile" href="profile.php">Edit Profile</a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item text-white" href="logout.php"><i class="i fa fa-user">&nbsp;</i>Logout</a>
                  </div>
                </li>
        </ul>


        <?php
      }
      
    ?>
  </div>
</nav>