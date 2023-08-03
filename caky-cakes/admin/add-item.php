<?php

use function PHPSTORM_META\elementType;

include("partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD ITEM</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['uplaod']);
            }

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="title of the item" required></td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description" required> </textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" required>
                </td>
            </tr>

            <tr>
                <td>Select image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                        <?php
                            //display category
                            $sql = "SELECT * FROM t_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count =mysqli_num_rows($res);

                            if($count>=0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $id =$row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id ?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }
                            else{
                                ?><option value="1">NO category found</option><?php
                            }
                        ?>
                        <!-- <option value="1">Cake</option>
                        <option value="2">Cupcake</option>
                        <option value="3">Cokie</option> -->
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" value="ADD ITEM" name="submit" class="btn-secondry">
                </td>
            </tr>
        </table>


        
        </form>

        <?php
            if(isset($_POST['submit'])){
                $title =$_POST['title'];
                $description =$_POST['description'];
                $price =$_POST['price'];
                $category =$_POST['category'];

                if(isset($_POST['featured'])){
                    $featured =$_POST['featured'];
                }else{
                    $featured ="No";
                }

                if(isset($_POST['active'])){
                    $active =$_POST['active'];
                }else{
                    $active ="No";
                }

                //check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){
                    $image_name =$_FILES['image']['name'];
                    
                    //check whether image is selected or not
                    if($image_name!=""){
                        //image selected
                        //1)reaname the image
                        //get the extension .jpg
                        $ext = end(explode('.', $image_name));

                        //new image name
                        $image_name = "Item_Name_".rand(0000,9999).".".$ext;

                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../img/items/".$image_name;//destination
                        $upload = move_uploaded_file($src, $dst);

                        if($upload== false){
                            
                            $_SESSION['upload']="<div class='error'>Failed to uplaod image!</div";
                            header("location:".HOMEURL."admin/add-items.php");
                        }



                        //2)upload image

                    }else{
                        $image_name="";
                    }
                }
                else{
                    $image_name ="";
                }

                $sql2 = "INSERT INTO t_cake SET
                title = '$title',
                discription = '$description',
                price = $price,
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE){
                    #query executed
                    $_SESSION['add'] = "<div class='success'>Item added successfully</div>";
                    #redirect to items page
                    header("location:". HOMEURL."admin/manage-items.php");
                }
                else{
                    #failed to execute
                    $_SESSION['add'] = "<div class='error'>Failed to add Item</div>";
                    #redirect to items page
                    header("location:". HOMEURL."admin/add-item.php");
                }

            }

        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>