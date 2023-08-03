<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>CHANGE PASSWORD</h1>
        <br><br>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30" style="width:35%;">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="old_password" placeholder="Old Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value=<?php echo $id;?>>
                        <input type="submit" name="submit" value="change password" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $id =$_POST['id'];
        $current_password =md5($_POST['current_password']);
        $new_password =md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        $sql = "SELECT * FROM t_admin WHERE id=$id AND password='$current_password'";
        $res= mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                // echo "found";
                if($new_password==$confirm_password){
                    // echo "matched";
                    $sql1= "UPDATE t_admin SET
                    PASSWORD='$new_password'
                    WHERE id=$id";

                    $res1= mysqli_query($conn, $sql1);

                    if($res1==TRUE)
                    {
                        $_SESSION['pwd-chg']= "<div class='success'>Password Changed Successfully</div>";
                        header("location:".HOMEURL.'/admin/manage-admin.php');
                    }
                }
                else{
                    $_SESSION['pwd-not-mtc']= "<div class='error'>Password didn't Matched</div>";
                    header("location:".HOMEURL.'/admin/manage-admin.php');
                }
            }
            else{
                $_SESSION['user-not-found']= "<div class='error'>User Not Found</div>";
                header("location:".HOMEURL.'/admin/manage-admin.php');
            }
        }
    }
 ?>

<?php include('partials/footer.php') ?>