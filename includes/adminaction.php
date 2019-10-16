<?php

// include("../templates/editUser.php");

    if (isset($_POST["action"])) {
        
        include_once('../database/database_connection.php');

        if ($_POST["action"] == 'fetch'){
            $output='';
            $query = "SELECT * FROM user WHERE usertype='user' ORDER BY username ASC";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output .='
            <table class="table table-hover table-bordered">
            <thead>
              <tr>
              <th>User ID</th>
                <th>User Name</th>
                <th>email</th>
                <th>Role</th>
                <th>User Status</th>
                <th>Action</th>
              </tr>
            </thead>
            ';
            foreach ($result as $row) {
                $status='';
                if ($row["user_status"] == "Active") {
                    $status = '<span class = "btn btn-success btn-sm">Active</span>';
                }else{
                    $status = '<span class = "btn btn-danger btn-sm">Inactive</span>';
                }
                $output .= '
                <tbody>
                    <tr>
                        <td>'.$row["id"].'</td>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["email"].'</td>
                        <td>'.$row["usertype"].'</td>
                        <td>'.$status.'</td>
                        <td>
                        <button type="button" name="action" class="btn-info btn-sm action" data-user_id="'.$row["id"].'" data-user_status="'.$row["user_status"].'">Action</button>
                        <button type="button" class="btn btn-danger delete_user"  data-user_id="'.$row["id"].'">Delete</button>
                        
                        </td>
                    </tr>
                </tbody>
             ';
            } 

            $output .='</table>';
            echo $output;

        }
        if ($_POST["action"] == 'change_status'){
            // print_r($_POST);
            // die();
                $status = '';
            if($_POST['user_status']== 'Active'){
                $status = 'Inactive';
            }
            else{
                $status = 'Active';
            }
            $query = 'UPDATE user SET user_status =:user_status WHERE id =:user_id';
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':user_status'  =>  $status,
                    ':user_id'      =>  $_POST['id']
                )
            );
            $result = $statement->fetchAll();
            if (isset($result)) {
                echo '<div class="alert alert-success">User Status has been set to 
                <strong>'.$status.'</strong></div>';
            }
        }
    }
    //Deleting User using there id from d
    if (isset($_POST['delete_user']) && $_POST['delete_user'] == 1) {
        $db = mysqli_connect('localhost', 'harmless', 'Nokia1680.', 'IVMDB');
        $query = "DELETE FROM `user` WHERE id = ".$_POST['id'];
        $result = mysqli_query($db, $query);
        echo true;
    }
?>