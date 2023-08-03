<?php include('partials/menu.php') ?>

    <div class="main-content">
            <div class="wrapper">
                <h1>MANAGE ITEMS</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unuthorized'])){
                        echo $_SESSION['unuthorized'];
                        unset($_SESSION['unuthorized']);
                    }
                ?>

                <br><br>
            <!-- button to add admin-->
            <a href="<?php echo HOMEURL ?>admin/add-item.php" class="btn-primary">Add ITEM</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sr.No</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query
                    $sql= "SELECT * FROM t_cake";

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
                            $price =$rows['price'];
                            $image_name= $rows['image_name'];
                            $featured=$rows['featured'];
                            $active=$rows['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $title?></td>
                                <td><?php echo $price?>Rs</td>

                                <td>
                                    <?php
                                    // check if image name is avilable or not
                                    if($image_name==""){
                                        echo "<div class='error>Image isn't avilable</div>";
                                    }else{
                                        ?>
                                        <img src="<?php echo HOMEURL; ?>img/items/<?php echo $image_name; ?>" width="100px" height="75px">
                                        <?php
                                    }
                                    
                                    ?>
                                </td>

                                <td><?php echo $featured ?></td>
                                <td><?php echo $active ?></td>
                                <td>
                                    <a href="<?php echo HOMEURL;  ?>admin/update-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondry">Update Item</a>
                                    <a href="<?php echo HOMEURL;  ?>admin/delete-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Item</a>
                                </td>
                            </tr>
                            

                            <?php
                        }
                        
                    }else{
                        //don't have data so, display message
                        ?>
                        <tr>
                            <td colspan="7"><div class="error">NO category to display:(</div></td>
                        </tr>

                        <?php
                    }

                ?>
                
            </table>
        </div>
    </div>

<?php include('partials/footer.php') ?>