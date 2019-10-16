<?php


$con = mysqli_connect('localhost', 'harmless', 'Nokia1680.', 'IVMDB');

function pagination ($con,$table,$pno,$n){
    $totalRecords =500;
    $pageno = $pno;
    $numberOfRecordsPerPage = $n;
    
    $last = ceil($totalRecords/$numberOfRecordsPerPage);

    $pagination = "<ul class = 'pagination'>";

    if ($last !=1 ) {
        if ($pageno>1) {
            $previous = "";
            $previous = $pageno -1 ;
            $pagination .= "<li class='page-item'><a class='page-link' href = 'pagination.php?pageno=".$previous. "' style='color:#333;'>Previous</a></li>";
        }
        for ($i= $pageno - 5; $i<$pageno ; $i++) {
            if ($i>0){
                $pagination .= "<li class='page-item'><a  class='page-link' href = 'pagination.php?pageno= ".$i."'>" .$i. "</a></li>";
            }
        }
        
        $pagination .= "<li class='page-item'><a  class='page-link' href = 'pagination.php?pageno=".$pageno."' style='color:#333;'>$pageno</a></li>";
        for ($i=$pageno + 1; $i<=$last ; $i++) {
            $pagination .= "<li class='page-item'><a  class='page-link' href = 'pagination.php?pageno=".$i."'>" .$i. "</a></li>";
            if ($i > $pageno + 4) {
                break;
            }
        }
        if ($last > $pageno) {
            $next = $pageno + 1;
            $pagination .= "<li class='page-item'><a  class='page-link' href = 'pagination.php?pageno=".$next."' style='color:#333;'>Next</a></li></ul>";
        }
    }
    //LIMIT 0,10
    //
    $limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage. ",".$numberOfRecordsPerPage;
    
    return ["pagination"=>$pagination,"limit"=>$limit];

}
if (isset($_GET["pageno"])) {
    $pageno = $_GET["pageno"];
    pagination($con,"xxx",$pageno,10);

  
}



?>