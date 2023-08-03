<?php
    include('config/constants.php');
    echo $id = $_GET['id'];//get the id

    $sql="DELETE FROM t_admin WHERE id=$id";//sql query

    $res=mysqli_query($conn, $sql);//execute query

    if($res==TRUE){
        // echo "Admin Deleted Successfully";
        //create a session variable to display message
        $_SESSION['delete'] = '<div class="success">Admin Deleted successfully</div>';
        //redirect page
        header("location:".HOMEURL.'admin/manage-admin.php');
    }
    else{
        // echo "Failed to delete";
        //create a session variable to display message
        $_SESSION['delete'] = '<div class="error">Failed to Delete Admin</div>';
        //redirect page
        header("location:".HOMEURL.'admin/manage-admin.php');
    }

?>