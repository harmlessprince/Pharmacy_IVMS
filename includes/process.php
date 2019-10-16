<?php
include_once("../database/constants.php");
include_once("DBOperation.php");
include_once("manage.php");
include_once("manageforBrand.php");
include_once("PagmanageforProduct.php");
include_once("PagmanageforUser.php");
$connect = mysqli_connect('localhost', 'harmless', 'Nokia1680.', 'IVMDB');
// getAllRecords();
//To get Catgory
if (isset($_POST["getCategory"])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("categories");
    foreach ($rows as $row) {
       
        echo "<option value = '".$row["cid"]."'>".$row["category_name"]."</option>";
    }
    exit();
}

//To get Brand
if (isset($_POST["getBrand"])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("brands");
    foreach ($rows as $row) {
       
        echo "<option value = '".$row["bid"]."'>".$row["brand_name"]."</option>";
    }
    exit();
}

// Add Category
if(isset($_POST["category_name"]) AND isset($_POST["parent_cat"])){
    $obj = new DBOperation();
    $result = $obj->addCategory($_POST["parent_cat"], $_POST["category_name"]);
    echo $result;
    exit();
}




//Add Brand
if(isset($_POST["brand_name"])){
    $obj = new DBOperation();
    $result = $obj->addBrand($_POST["brand_name"]);
    echo $result;
    exit();
}

//Add Product
if(isset($_POST["added_date"]) AND isset($_POST["product_name"])){
    $obj = new DBOperation();
    $result = $obj->addProduct($_POST["select_cat"],
                                $_POST["select_brand"],
                                $_POST["product_name"],
                                $_POST["product_price"],
                                $_POST["product_qty"],
                                $_POST["added_date"]);
    echo $result;
    exit();
}
//Manage Category
if (isset($_POST["manageCategory"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("categories",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        
        $n=(($_POST["pageno"]-1)*5)+1;
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php if(isset($row["category"])){echo $row["category"];}else{echo $row["category_name"];}; ?></td>
                    <td><?= isset($row["parent"]) ? $row["parent"] : "It is a parent"; ?></td>
                    <td><a href="#" class = "btn btn-success btn-sm">Active</a></td>
                    <td>
                    <a href="#" did="<?php echo $row['cid']; ?>"  class = "btn btn-danger btn-sm del_cat">Delete</a>
                    <a href="#" eid="<?php echo $row['cid']; ?>" class ="btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#form_category">Edit</a>
                    </td>
                </tr>
            <?php
            $n++;
        }
        ?>
        
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>

        <?php
        exit();
    }
}

//Delete categroy
if (isset($_POST["deleteCategory"])){
    $m = new Manage();  
    $result= $m->deleteRecord("categories","cid",$_POST["id"]);
    echo $result;
    
}

//Update Category
if (isset($_POST["updateCategory"])){
    $m = new Manage();  
    $result= $m->getSingleRecord("categories","cid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_category"])) {
    $m = new Manage();
    $id = $_POST["cid"];
    $name = $_POST["update_category"];
    $parent = $_POST["parent_cat"];
    $result = $m->update_record("categories",["cid"=>$id],["parent_cat"=>$parent,"category_name"=>$name,"status"=>1]);
    echo $result;

}


//-----------------------------BRAND-------------------------
//Manage Brand
if (isset($_POST["manageBrand"])){
    $m = new manageforbrand();
    $result = $m->manageRecordWithPaginationBrand("brands",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        
        $n=(($_POST["pageno"]-1)*5)+1;
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $n; ?></td>
                <td><?php echo $row["brand_name"] ?></td>
                    <td><a href="#" class = "btn btn-success btn-sm">Active</a></td>
                    <td>
                    <a href="#" did="<?php echo $row['bid']; ?>"  class = "btn btn-danger btn-sm del_brand" >Delete</a>
                    <a href="#" eid="<?php echo $row['bid']; ?>" class ="btn btn-info btn-sm edit_brand" data-toggle="modal" data-target="#form_brand">Edit</a>
                    </td>
                </tr>
            <?php
            $n++;
        }
        ?>
        
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>

        <?php
        exit();
    }
}

//Delete Brand
if (isset($_POST["deleteBrand"])){
    $m = new Manage();  
    $result= $m->deleteRecord("brands","bid",$_POST["id"]);
    echo $result;
    
}

//Update Brand
if (isset($_POST["updateBrand"])){
    $m = new Manage();  
    $result= $m->getSingleRecord("brands","bid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_brand"])) { 
    $m = new Manage();
    $id = $_POST["bid"];
    $name = $_POST["update_brand"];
    $result = $m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
    echo $result;
    exit();

}



//-----------------------------Product-------------------------
//Manage Product
if (isset($_POST["manageProduct"])){
    $m = new manageforProduct();
    $result = $m->manageRecordWithPaginationProduct("products",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        
        $n=(($_POST["pageno"]-1)*5)+1;
        foreach($rows as $row){
            $status='';
            if ($row["p_status"] == "Active") {
                $status = '<span class = "btn btn-success btn-sm">Active</span>';
            }else{
                $status = '<span class = "btn btn-danger btn-sm">Inactive</span>';
            }

            ?>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["product_name"] ?></td>
                    <td><?php echo $row["category_name"] ?></td>
                    <td><?php echo $row["brand_name"] ?></td>
                    <td><?php echo $row["product_price"] ?></td>
                    <td><?php echo $row["product_stock"] ?></td>
                    <td><?php echo $row["added_date"] ?></td>
                    <td><?php echo $status ?></td>
                    <td>
                    <span type="button" name="p_action" class="btn-info btn-sm p_action" data-product_id="<?php echo $row['pid']; ?>" data-product_status=<?php echo $row["p_status"]?>>Action</span>
                    <a href="#" did="<?php echo $row['pid']; ?>"  class = "btn btn-danger btn-sm del_product" >Delete</a>
                    <a href="#" eid="<?php echo $row['pid']; ?>" class ="btn btn-info btn-sm edit_product" data-toggle="modal" data-target="#form_products">Edit</a>
                    </td> 
                </tr>

            <?php

            $n++;
        }
        ?>
        
        
            <tr><td colspan="9"><?php echo $pagination; ?></td></tr>
        
        <?php
        exit();
    }
}

//Delete Product
if (isset($_POST["deleteProduct"])){
    $m = new Manage();  
    $result= $m->deleteRecord("products","pid",$_POST["id"]);
    echo $result;
    exit();
}

//Update Brand
if (isset($_POST["updateProduct"])){
    $m = new Manage();  
    $result= $m->getSingleRecord("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_product"])) { 
    $m = new Manage();
    $id = $_POST["pid"];
    $name = $_POST["update_product"];
    $cat = $_POST["select_cat"];
    $brand = $_POST["select_brand"];
    $price = $_POST["product_price"];
    $qty = $_POST["product_qty"];
    $date = $_POST["added_date"];
    $result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_stock"=>$qty, "added_date"=>$date]);
    echo $result;
    exit();

}

//-------------------------------------Order Processing------------------------

if (isset($_POST["getNewOrderItem"])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("products");
    ?>
        <tr>
            <td><b class="number">1</b></td>
            <td>
                
                <select name="pid[]" id="" class="form-control form-control-sm pid" required>
                <option value="">Choose Product</option>
                    <?php
                    foreach ($rows as $row) {
                        ?><option value="<?php echo $row ['pid'];?>"><?php echo $row["product_name"]?></option><?php
                    }
                    
                    ?>
                </select>
            </td>
            <td><input type="text" readonly name="tqty[]" class="form-control form-control-sm tqty"></td>
            <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required></td>
            <td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></span>
            <span><input type="text" name="pro_name[]" hidden class="form-control form-control-sm pro_name" readonly></td> 
            <td>#<span class="amt">0</span> </td>
        </tr>"
    <?php
    exit();
}


//Updating Userdata
// if (isset($_POST['username'])) {
//     if ($_POST['password1'] != '' ) {
//         // $password = $password1;
//         $query='UPDATE user SET username = "'.$_POST["username"].'", email = "'.$_POST["email"].'", password = "'.md5($_POST["password1"]).'", usertype = "'.($_POST["usertype"]).'" WHERE email = "'.$_SESSION["email"].'" ';
//     }else {
//         $query='UPDATE user SET username = "'.$_POST["username"].'", email = "'.$_POST["email"].'" WHERE email = "'.$_SESSION["email"].'" ';
//     }
//     $result = mysqli_query($connect, $query);
//     $affected_rows = mysqli_affected_rows($connect);
//     // $row = mysqli_fetch_assoc($result);
//     if (isset($affected_rows) > 0) {
//         echo '<div class="alert alert-success">Profile Updated</div>';
//     }
// }

//Get price and quantity of one item
if(isset($_POST["getPriceAndQty"])){
    $m = new Manage();
    $result = $m->getSingleRecord("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])){
    $orderdate = $_POST["order_date"];
    $cust_name = $_POST["cust_name"];
    


    //Now getting array from order_ford
    $ar_tqty  = $_POST["tqty"];
    $ar_qty = $_POST["qty"];
    $ar_price = $_POST["price"];
    $ar_pro_name = $_POST["pro_name"];
    $sub_total = $_POST["sub_total"];
    $gst = $_POST["gst"];
    $discount = $_POST["discount"];
    $net_total = $_POST["net_total"];
    $paid = $_POST["paid"];
    $due = $_POST["due"];
    $payment_type = $_POST["payment_type"];



    $m = new Manage();
    echo $result =  $m->storeCustomerOrderInvoice($orderdate,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
}

?>