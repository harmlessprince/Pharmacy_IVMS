<?php

include_once("./database/constants.php");
if(isset($_SESSION["email"])){
    session_destroy();
}
header("location:".DOMAIN."/");
// if (session_destroy()){
//     header("location:index.php");
// }
?>