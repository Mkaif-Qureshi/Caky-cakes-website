<?php
    if(!isset($_SESSION['user'])){
        //if user session is not set
        $_SESSION['no-login-msg']="<div class='error text-center'>Please login to Access Admin Panal</div>";
        header("location:".HOMEURL.'admin/login.php');
    }
?>