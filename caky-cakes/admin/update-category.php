<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE CATEGORY</h1><br><br>

        <?php
            if(isset($_GET['id'])){
                //get id
                $id = $_GET['id'];

                //sql query
                $sql= "SELECT * FROM t_category WHERE id=$id";

                //execute query
                $res = mysqli_query($conn, $sql);


                if($res==TRUE){
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        //get data
                        $rows =mysqli_fetch_assoc($res);
                        
                        $title= $rows['title'];
                        $current_image=$rows['image_name'];
                        $featured = $rows['fetured'];
                        $active = $rows['active'];
                    
                    }else{
                        $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
                        //redirect to previouse page
                        header("location:".HOMEURL.'admin/manage-category.php');
                    }

                }
            }
            else{
                    //redirect to previouse page
                    header("location:".HOMEURL.'admin/manage-category.php');
                }
        ?>
    
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image!=""){
                                ?>
                                <img src="<?php echo HOMEURL; ?>img/category/<?php echo $current_image?>" width="100px">
                                <?php
                            }
                            else{
                                echo "<div calss='error'>Image not availabel</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                    <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current-image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                // echo "clicked";
                $id=$_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //check new image is selected or not
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    //check image is available or not
                    if($image_name!=""){
                        /*auto rename our image*/
                        //get the extension of our image 
                        $ext = end(explode('.', $image_name));

                        //rename the image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../img/category/". $image_name;

                        //upload th image
                        $upload=move_uploaded_file($source_path, $destination_path);

                        //img uploaded or not

                        //otherwise stop the process and redirect with error
                        if($upload==FALSE){
                            $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                            header("location:".HOMEURL.'admin/manage-category.php');

                            //stop
                            die();
                        }
                        if($current_image!=""){
                            //remove the image from the folder
                            $remove_path = "../img/category/".$current_image;
                            $remove =unlink($remove_path);
    
                            if($remove==FALSE){
                                $_SESSION['failed-remove']="<div class='error'>Failed to remove image</div>";
                                header("location:".HOMEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image;
                    }

                }else{
                    $image_name = $current_image;
                }

                //sql query
                echo $sql2= "UPDATE t_category SET 
                        title = '$title',
                        image_name = '$image_name',
                        fetured = '$featured',
                        active = '$active'
                        WHERE id = $id
                        ";

                //execute
                $res2=mysqli_query($conn, $sql2);

                if($res2==TRUE){
                    $_SESSION['update'] = '<div class="success">Category Updated successfully</div>';
                    header("location:".HOMEURL.'admin/manage-category.php');
                }
                else{
                    $_SESSION['update'] = '<div class="error">Failed to Update</div>';
                    header("location:".HOMEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>