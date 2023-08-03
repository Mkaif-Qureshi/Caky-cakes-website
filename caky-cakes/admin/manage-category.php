<?php include('partials/menu.php') ?>

    <div class="main-content">
            <div class="wrapper">
                <h1>MANAGE CATEGORY</h1>

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['no-category-found'])){
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                    
                ?>
                <br><br>
            <!-- button to add admin-->
            <a href="<?php echo HOMEURL ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sr.No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query
                    $sql= "SELECT * FROM t_category";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count=mysqli_num_rows($res);

                    $sn=1;

                    //check wheter we have data in table or not
                    if($count>0){
                        //we have data
                        while($rows=mysqli_fetch_assoc($res)){
                            $id= $rows['id'];
                            $title =$rows['title'];
                            $image_name= $rows['image_name'];
                            $featured=$rows['fetured'];
                            $active=$rows['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $title?></td>

                                <td>
                                    <?php
                                    // check if image name is avilable or not
                                    if($image_name!=""){
                                        ?>
                                        <img src="<?php echo HOMEURL; ?>img/category/<?php echo $image_name; ?>" width="100px" height="75px">
                                        <?php
                                    }else{
                                        echo "<div class='error>Image isn't avilable</div>";
                                    }
                                    
                                    ?>
                                </td>

                                <td><?php echo $featured ?></td>
                                <td><?php echo $active ?></td>
                                <td>
                                    <a href="<?php echo HOMEURL;  ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondry">Update Category</a>
                                    <a href="<?php echo HOMEURL;  ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                            

                            <?php
                        }
                        
                    }else{
                        //don't have data so, display message
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">NO category to display:(</div></td>
                        </tr>

                        <?php
                    }

                ?>
                
            </table>
        </div>
    </div>

<?php include('partials/footer.php') ?>