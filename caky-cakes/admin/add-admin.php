<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD ADMIN</h1>
        <br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name</td>
                    <td>
                        <input type="text" name="f_name" placeholder="Enter name" required>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username" required>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
    //get data from the form and save in datbase
    //check whether submit is cicked or nor
    if(isset($_POST['submit']))
    {
        //1)get data from form
        $f_name = $_POST['f_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);//md5 for encrypt the password

        //2)SQL query to save the data into database
        $sql= "INSERT INTO t_admin SET
        f_name='$f_name',
        username='$username',
        password='$password'";


        if(false){//!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&!\?]{8,20}$/',$password)){
                echo 'at least one lowercase char<br>
                at least one uppercase char<br>
                at least one digit<br>
                at least one special sign of @#-_$%^&!?';
        }
        else{
            //3)eecuting and saving the data
            $res= mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
            //4) check whether the (query is executed) data is inserted or not and display message.
            if($res==TRUE){
                //data inserted
                // echo "success";
    
                //create a session variable to display message
                $_SESSION['add'] = '<div class="success">Admin added successfully</div>';
                //redirect page
                header("location:".HOMEURL.'admin/manage-admin.php');
    
            }
            else{
                //failed 
                // echo "failed.";
    
                //create a session variable to display message
                $_SESSION['add'] = '<div class="success">Failed to add admin</div>';
                //redirect page
                header("location:".HOMEURL.'admin/add-admin.php');
            }
        }
}
//}  
// echo $sql;

?>