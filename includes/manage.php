<?php
class manage{

    private $con;

    function __construct(){
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function manageRecordWithPagination($table,$pno){
        $a = $this->pagination($this->con,$table,$pno,5);
        if ($table == "categories") {
            $sql = "SELECT p.category_name as category,p.cid as cid, c.category_name as parent, p.category_status FROM categories p, categories c WHERE p.parent_cat = c.cid ".$a["limit"];

            $sql2 = "SELECT * FROM categories WHERE categories.parent_cat = '0' ".$a["limit"];
            // die($sql2);
        } elseif ($table="brands") {
            # code...
        }

        $result = $this->con->query($sql) or die ($this->con->error);
        $result2 = $this->con->query($sql2) or die ($this->con->error);
        
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
            }
        }
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
               $rows[] = $row;
            }
        }
        return ["rows"=>$rows,"pagination"=>$a["pagination"]];
    }

    private function pagination($con,$table,$pno,$n){

        $query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
    
        $row = mysqli_fetch_assoc($query);
    
        //$totalRecords = 100000;
    
        $pageno = $pno;
    
        $numberOfRecordsPerPage = $n;
    
    
        $last = ceil($row["rows"]/$numberOfRecordsPerPage);

        // echo "Total pages ".$last."<br>";

        $pagination = "<ul class = 'pagination justify-content-center'>";
    
    
        if ($last != 1) {
    
            if ($pageno > 1) {
    
                $previous = "";
    
                $previous = $pageno - 1;
    
                $pagination .= "<li class='page-item '> <a class='page-link' pn='".$previous."' href='#' style='color:#333;'> Previous </a></li>";
    
            }
    
            for($i=$pageno - 5;$i< $pageno ;$i++){
    
                if ($i > 0) {
    
                    $pagination .= "<li class='page-item'> <a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
    
                }
    
                
            }
    
            $pagination .= "<li class='page-item '> <a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
    
            for ($i=$pageno + 1; $i <= $last; $i++) { 
    
                $pagination .= "<li class='page-item '> <a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
    
                if ($i > $pageno + 4) {
    
                    break;
    
                }
    
            }
    
            if ($last > $pageno) {
    
                $next = $pageno + 1;
    
                $pagination .= "<li class='page-item '> <a class='page-link' pn='".$next."' href='#' style='color:#333;'> Next </a> </li>";
    
            }
    
        }
    
    //LIMIT 0,10
    
        //LIMIT 20,10
    
        $limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;
    
    
        return ["pagination"=>$pagination,"limit"=>$limit];
    
    }

    public function deleteRecord($table,$pk,$id){
        if ($table == "categories"){
            $pre_stmt = $this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
            $pre_stmt->bind_param("i",$id);
            $pre_stmt->execute();
            $result = $pre_stmt->get_result() or die($this->con->error);
            if ($result->num_rows > 0) {
                return "DEPENDENT_CATEGORY";
            } else {
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if ($result){
                    return "CATEGORY_DELETED";
                }
            } 
        }else {
           $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
            $pre_stmt->bind_param("i",$id);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result){
               return "DELETED";
            }
        }
    }

    //GET Single record
    public function getSingleRecord($table,$pk,$id){
        $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ? LIMIT 1");
        
        // var_dump($pre_stmt);
        // die();
        $pre_stmt->bind_param("i",$id);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();
        }
        return $row;
    }


    public function update_record($table,$where,$fields){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            $sql .= $key . "='".$value."', ";
        }
        // var_dump($sql);
        // die();
        $sql = substr($sql, 0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        // var_dump($sql);
        // die();
        if (mysqli_query($this->con,$sql)){
           
            return "Update Successful";
        }
    }

    public function storeCustomerOrderInvoice($cust_name,$orderdate,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){
        $pre_stmt = $this->con->prepare("INSERT INTO `invoice`(`customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?,?)");
        $pre_stmt->bind_param("ssdddddds",$cust_name,$orderdate,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
        $pre_stmt->execute() or die($this->con->error);
        $invoice_no = $pre_stmt->insert_id;
        if ($invoice_no != null) {
            for ($i=0; $i < count($ar_price); $i++) { 

                //Here we are finding the remaining quantity after giving customer goods
                $rem_qty = $ar_tqty[$i] - $ar_qty[$i];
                if ($rem_qty<0){
                    return "ORDER_FAIL_TO_COMPLETE";
                }else{
                    //Update Product stock
                    $sql = "UPDATE products SET product_stock = '$rem_qty' WHERE product_name = '".$ar_pro_name[$i]."'";
                    $this->con->query($sql);
                }


                $insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES (?,?,?,?)");
                $insert_product->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
                $insert_product->execute() or die($this->con->error);
            }
            
            return $invoice_no;

        }
    }

}



//

//  $mane = new manage();
//  echo "<prev>";
//  print_r($obj->manageRecordWithPagination("categories",1));
// print_r($obj->getSingleRecord('categories',"cid",1));
// echo $mane->deleteUserRecord("user",11);
// echo $mane->update_record("categories",["cid"=>1],["parent_cat"=>0,"category_name"=>"Electronics","status"=>1]);
?>