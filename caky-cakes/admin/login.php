<?php include('config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>login</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">LOGIN</h1> <br><br>
        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-msg'])){
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
        ?>
        <br>
        <!-- login form start -->
        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="Enter Username" class="input" required><br><br>

            Password:
            <input type="password" name="password" placeholder="Enter Password" class="input" required><br><br>

            <input type="submit" name="submit" value="LOGIN" class="btn-primary"><br><br>
        </form>
        <!-- login form ends -->
        
        <p class="text-center"><a href="caky-cakes.com">Caky-cakes</a></p>
    </div>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        //get data from the login form
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //sql query to check the username and password exits or not
        $sql = "SELECT * FROM t_admin WHERE username='$username' AND password='$password'";
        
        //execute sql query
        $res = mysqli_query($conn, $sql);

        //count rows
        $count = mysqli_num_rows($res);

        if($count>=1){
            //user available
            $_SESSION['login']="<div class='success'>Login Successful</div>";
            $_SESSION['user']= $username;

            //redirect to home page
            header("location:".HOMEURL."admin/");
        }
        else{
            //user not available
            $_SESSION['login']="<div class='error text-center'>Incorrect Username or Password</div>";
    
            //redirect to home page
            header("location:".HOMEURL."admin/login.php");
        }
    }
?>
