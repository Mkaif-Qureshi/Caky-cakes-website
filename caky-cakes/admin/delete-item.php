<?php include('config/constants.php') ?>

<?php
    if(isset($_GET['id']) && isset($_GET['image_name'])){

        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //check image is there or not
        if($image_name != ""){
            $path = "../img/items/".$image_name;
            $remove = unlink($path);

            if($remove==FALSE){
                //SESSION MESSAGE
                $_SESSION['upload']='<div class="error">Failed to remove Item image</div>';

                //redirect page
                header("location:".HOMEURL."admin/manage-items.php");

                //STOP PROCESS
                die();
            }

            //delete from the category table
            $sql= "DELETE FROM t_cake WHERE id=$id ";
            
            // execute query
            $res=mysqli_query($conn, $sql);
            
            if($res==TRUE){
                
                $_SESSION['delete']='<div class="success">item Deleted successfully</div>';
                //redirect
                header("location:".HOMEURL.'admin/manage-items.php');
            }else{
                $_SESSION['delete'] = '<div class="error">Failed to Delete item</div>';
                //redirect page
                header("location:".HOMEURL.'admin/manage-items.php');
            }
        }

    }
    else{
        $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
        header("location:".HOMEURL."admin/manage-items.php");
    }
?>