<?php
    include('config/constants.php');
    
    //distroy sessions
    session_destroy();

    //redirect to login page
    header("location:".HOMEURL.'admin/login.php')
?>