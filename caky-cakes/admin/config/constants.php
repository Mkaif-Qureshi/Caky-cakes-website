<?php
    //START SESSION
    session_start();

    define('LOCALHOST', 'localhost');
    define('DB_USERNAME',"root");
    define('DB_PASSWORD','');
    define('DB_NAME', 'caky-cakes');
    define('HOMEURL','http://localhost/caky-cakes/');
    //3) Execute Query and save data in database 
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));//database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));//selecting database
?>