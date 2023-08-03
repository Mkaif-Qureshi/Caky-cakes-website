<?php include('partials/menu.php') ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
         
        $sql2 = "SELECT * FROM t_cake WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);

        //get vals
        $row2 = mysqli_fetch_assoc($res2);

        $title=   $row2['title'];
        $description = $row2['discription'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured =   $row2['featured'];
        $active =   $row2['active'];

    }else{
        header('location:'.HOMEURL.'admin/manage-items.php');
    }
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>UPDATE ITEM</h1>
            <br><br>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" id="" cols="30" rows="5" ><?php echo $description ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price"  value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current image: </td>
                        <td>
                        <?php
                            if($current_image!=""){
                                ?>
                                <img src="<?php echo HOMEURL; ?>\img\items\<?php echo $current_image?>" width="100px">
                                <?php
                            }
                            else{
                                echo "<div class='error'>Image not available</div>";
                            }
                        ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td> 
                            <select name="category">
                                <?php
                                    $sql = "SELECT * FROM t_category WHERE active='Yes'";

                                    $res =mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    //check category available or not
                                    if($count>0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            $category_title =$row['title'];
                                            $category_id = $row['id'];

                                            // echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                            <option <?php if($current_category == $category_id){ echo "selected"; } ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "<option value='0'>Item Not Available.</option>";
                                    }

                                ?>
                                <option value="0">Test category</option>
                            </select> 
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
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="UPDATE ITEM" class="btn-secondry">
                        </td>
                    </tr>
                    
                </table>

            </form>
            <?php
                if(isset($_POST['submit'])){
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image=$_POST['current_image'];
                    $category = $_POST['category'];

                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];
    
                        //check image is available or not
                        if($image_name!=""){
                            /*auto rename our image*/
                            //get the extension of our image 
                            $ext = end(explode('.', $image_name));
    
                            //rename the image
                            $image_name = "Item_Name".rand(0000,  9999).'.'.$ext;
    
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../img/items/". $image_name;
    
                            //upload th image
                            $upload=move_uploaded_file($source_path, $destination_path);
    
                            //img uploaded or not
    
                            //otherwise stop the process and redirect with error
                            if($upload==FALSE){
                                $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                                header("location:".HOMEURL.'admin/manage-items.php');
    
                                //stop
                                die();
                            }
                            if($current_image!=""){
                                //remove the image from the folder
                                $remove_path = "../img/items/".$current_image;
                                $remove =unlink($remove_path);
        
                                if($remove==FALSE){
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove image</div>";
                                    header("location:".HOMEURL.'admin/manage-items.php');
                                    die();
                                }
                            }
                        }else{
                            $image_name = $current_image;
                        }
    
                    }else{
                        $image_name = $current_image;
                    }


                    $sql3 = "UPDATE t_cake SET 
                    title = '$title',
                    discription = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";

                    $res3 = mysqli_query($conn, $sql3);

                    if($res3==TRUE){
                        $_SESSION['update'] = '<div class="success">Item Updated successfully</div>';
                        header("location:".HOMEURL.'admin/manage-items.php');
                    }
                    else{
                        $_SESSION['update'] = '<div class="error">Failed to Update</div>';
                        header("location:".HOMEURL.'admin/manage-items.php');
                    }
                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php') ?>