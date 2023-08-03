<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>
        <br><br>
        <?php
            //get id
            $id = $_GET['id'];

            //sql query
            $sql= "SELECT * FROM t_admin WHERE ID=$id";

            //execute query
            $res = mysqli_query($conn, $sql);


            if($res==TRUE){
                $count = mysqli_num_rows($res);
                if($count==1){
                    //get data
                    $row =mysqli_fetch_assoc($res);

                    $f_name= $row['f_name'];
                    $username = $row['username'];
                }
                else{
                    //redirect to previouse page
                    header("location:".HOMEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="f_name" value="<?php echo $f_name; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value=<?php echo $id;?>>
                        <input type="submit" name="submit" value="Update admin" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit'])){
        $id =$_POST['id'];
        $f_name =$_POST['f_name'];
        $username =$_POST['username'];

        $sql = "UPDATE t_admin SET
        f_name ='$f_name',
        username= '$username'
        WHERE id  = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            // echo "success";
            $_SESSION['update'] = '<div class="success">Admin Updated successfully</div>';
            header("location:".HOMEURL.'admin/manage-admin.php');
        }
        else{
            // echo "failed";
            $_SESSION['update'] = '<div class="error">Failed to Update</div>';
            header("location:".HOMEURL.'admin/manage-admin.php');
        }

    }
?>

<?php include('partials/footer.php') ?>