<?php


    $db = mysqli_connect('localhost', 'harmless', 'Nokia1680.', 'IVMDB');  // Establishing Connection with Server
if (isset($_POST['update'])){
     
    $mail = $_POST['email'];
    $query = "UPDATE 'user' SET username ='$_POST[username]',email ='$_POST[email]',password1 ='$_POST[password1]', password2 ='$_POST[password2]' WHERE email='$_POST[email]' ";
    $query_run = mysqli_query($db,$query);
}



?>