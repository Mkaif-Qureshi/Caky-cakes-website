<?php include('partials/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>MANAGE ADMIN</h1>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-mtc']))
                {
                    echo $_SESSION['pwd-not-mtc'];
                    unset($_SESSION['pwd-not-mtc']);
                }
                if(isset($_SESSION['pwd-chg']))
                {
                    echo $_SESSION['pwd-chg'];
                    unset($_SESSION['pwd-chg']);
                }
            ?>
            <br> 

            <!-- button to add admin-->
            <br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sr.No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM t_admin";

                    $res= mysqli_query($conn, $sql);
                    $sn=1;

                    if($res==TRUE){
                        $count=mysqli_num_rows($res);
                        if($count>0){
                            //data is available
                            while($rows=mysqli_fetch_assoc($res)){
                                $id=$rows['id'];
                                $f_name=$rows['f_name'];
                                $username=$rows['username'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $f_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo HOMEURL;  ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Update Password</a>
                                        <a href="<?php echo HOMEURL;  ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondry">Update Admin</a>
                                        <a href="<?php echo HOMEURL;  ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            //data not available

                        }
                    }
                ?>
            </table>
        </div>
</div>

<?php include('partials/footer.php') ?>