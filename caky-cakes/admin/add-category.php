<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1><br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <!-- add category form start-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Title"required>
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td><input type="file" name="image" required></td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add category form end -->

        <?php
            if(isset($_POST['submit'])){
                //echo "clicked";
                //get the values from the form 
                $title= $_POST['title'];

                //redio buttons must clicked
                if(isset($_POST['featured']))
                {
                    $fetured = $_POST['featured'];
                }else{
                    $fetured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }

                //img is uploaded or not
                // print_r($_FILES['image']);
                // die();
                
                if(isset($_FILES['image']['name'])){
                    //to upload img we need image name, source path and destination path
                    $image_name=$_FILES['image']['name'];

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
                            header("location:".HOMEURL.'admin/add-category.php');

                            //stop
                            die();
                    }
                }
                }else{
                    $image_name="";
                }

                //sql query
                $sql = "INSERT INTO t_category SET
                title='$title',
                image_name = '$image_name',
                fetured='$fetured',
                active='$active'
                ";

                //excute query
                echo $res = mysqli_query($conn, $sql);

                if($res==TRUE){
                    #query executed
                    $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                    #redirect to category page
                    header("location:". HOMEURL."admin/manage-category.php");
                }
                else{
                    #failed to execute
                    $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                    #redirect to category page
                    header("location:". HOMEURL."admin/add-category.php");
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>