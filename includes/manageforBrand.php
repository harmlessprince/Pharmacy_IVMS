<?php


class manageforbrand{

    private $con;

    function __construct(){
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function manageRecordWithPaginationBrand($table,$pno){
        $a = $this->pagination($this->con,$table,$pno,5);
        if ($table == "brands") {
            $sql = "SELECT * FROM ".$table." ".$a["limit"];
        }

        $result = $this->con->query($sql) or die ($this->con->error);
        
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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


}

//

//  $mane = new manage();
//  echo "<prev>";
//  print_r($obj->manageRecordWithPagination("categories",1));
// print_r($obj->getSingleRecord('categories',"cid",1));
// echo $obj->deleteRecord("categories","cid",3);
// echo $mane->update_record("categories",["cid"=>1],["parent_cat"=>0,"category_name"=>"Electronics","status"=>1]);
?>