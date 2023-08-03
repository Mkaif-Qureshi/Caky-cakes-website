<?php
    include('config/constants.php');

    //check id and image_nmae is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // echo "got the values";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove image from the folder
        if($image_name!=""){
            $path="../img/category/". $image_name;
            echo $remove= unlink($path);

            //IF FAILED TO REMOVE DO NOT DELETE DATA FROM DATABASE
            if($remove==FALSE){
                //SESSION MESSAGE
                $_SESSION['remove']='<div class="error">Failed to remove category image</div>';

                //redirect page
                header("location:".HOMEURL."admin/manage-category.php");

                //STOP PROCESS
                die();
            }
        }

        //delete from the category table
        $sql= "DELETE FROM t_category WHERE id=$id ";

        // execute query
        $res=mysqli_query($conn, $sql);

        if($res==TRUE){
            
            $_SESSION['delete']='<div class="success">Category Deleted successfully</div>';
            //redirect
            header("location:".HOMEURL.'admin/manage-category.php');
        }else{
            $_SESSION['delete'] = '<div class="error">Failed to Delete Category</div>';
            //redirect page
            header("location:".HOMEURL.'admin/manage-category.php');
        }

        //redirect to manage-admin 
    }else{
        header("location:".HOMEURL.'admin/manage-category.php');
    }
?>