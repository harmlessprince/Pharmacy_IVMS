<!-- New line of code starts here -->
<?php 

session_start(); 
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
 <script type = "text/javascript" src ="./js/order.js"></script>

</head>
<body>

   <!-- notification message -->
   <!-- <?php if (isset($_SESSION['success'])) : ?>
   <div class="error success" >
       <h3>
       <?php 
           echo $_SESSION['success']; 
           unset($_SESSION['success']);
       ?>
       </h3>
   </div>
   <?php endif ?> -->

</div>
<!-- new line of code ends her  -->
<div class="overlay"><div class="loader"></div></div>
<!-- Navbar -->
<?php include_once("./templates/header.php"); ?>
 <br/><br/>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                <div class="card-header">
                  <h4>  New Orders </h4>
                </div>

                <div class="card-body">
                    <form id="get_order_data" onsubmit="return false">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" align="right"> Order Date </label>
                            <div class="col-sm-6">
                                <input type="text" id ="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date('Y-d-m');?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" align="right"> Customer Name* </label>
                            <div class="col-sm-6">
                                <input type="text" id ="cust_name" name="cust_name" class="form-control form-control-sm" required/>
                            </div>
                        </div>
                        <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                                <div class="card-body">
                                    <h3>Make a order list</h3>
                                    <table align="center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="text-align:center;">Item Name</th>
                                                <th style="text-align:center;">Total Quantity</th>
                                                <th style="text-align:center;">Quantity</th>
                                                <th style="text-align:center;">Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice_item">
                                            <!------<tr>
                                                <td id="number"><b>1</b></td>
                                                <td>
                                                    <select name="pid[]" id="" class="form-control form-control-sm" required>
                                                        <option value="">Machine</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" readonly name="tqty[]" class="form-control form-control-sm"></td>
                                                <td><input type="text" name="qty[]" class="form-control form-control-sm" required></td>
                                                <td><input type="text" name="price[]" class="form-control form-control-sm" readonly></td>
                                                <td>#15,000</td>
                                            </tr>--->
                                        </tbody>
                                    </table> <!----Table ends------>
                                    <center style="padding:1%">
                                        <button id ="add" style ="width:20%;"  class="btn btn-success">Add</button>
                                        <button id ="remove" style ="width:20%;"  class="btn btn-danger">Remove</button>
                                    </center>
                                </div> <!----Card Body ends here------>
                            </div> <!---Order List ends here---->
                            <p></p>
                            <div class="form-group row">
                                <label for ="sub_total" class="col-sm-3 col-form-label" align="right"> Sub Total </label>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_total" class="form-control form-control-sm" readonly id="sub_total" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for ="gst" class="col-sm-3 col-form-label" align="right"> Goods and Services Tax </label>
                                <div class="col-sm-6">
                                    <input type="text" name="gst" readonly class="form-control form-control-sm" id="gst" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for ="discount" class="col-sm-3 col-form-label" align="right"> Discount </label>
                                <div class="col-sm-6">
                                    <input type="text" name="discount" class="form-control form-control-sm" id ="discount" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for ="net_total" class="col-sm-3 col-form-label" align="right"> Net Total </label>
                                <div class="col-sm-6">
                                    <input type="text" name="net_total" readonly class="form-control form-control-sm" id="net_total" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for ="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                <div class="col-sm-6">
                                    <input type="text" name="paid" class="form-control form-control-sm" id="paid" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for ="due" class="col-sm-3 col-form-label" align="right"> Due </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for ="payment_method" class="col-sm-3 col-form-label" align="right"> Payment Method </label>
                                <div class="col-sm-6">
                                    <select name="payment_type" class="form-control form-control-sm" id="payment_type" required>
                                        <option>Cash</option>
                                        <option>Card</option>
                                        <option>Draft</option>
                                        <option>Cheque</option>
                                    </select>
                                </div>
                            </div>
                        <center style="padding:1%">
                            <input type="submit" id ="order_form" style ="width:20%;"  class="btn btn-info" value="Order">
                            <input type="submit" id ="print_invoice" style ="width:20%;"  class="btn btn-success d-none" value="Print Invoice">
                        </center>
                    </form>
                </div>
            </div>      



        </div>
    </div>
</div>
</body>
</html>

