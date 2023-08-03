<?php include('partials/menu.php');
include('partials/login-check.php'); ?>

    <!-- Main content starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBORD</h1>
            <br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br>
            <div class="col-4 text-center">
                <?php
                    $sql ="SELECT * FROM t_category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count ?></h1><br>
                Categories

            </div>

            <div class="col-4 text-center">
                <?php
                    $sql1 ="SELECT * FROM t_cake";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                ?>
                <h1><?php echo $count1 ?></h1><br>
                Items

            </div>

            <div class="col-4 text-center">
                <?php
                    $sql2 ="SELECT * FROM t_order";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2 ?></h1><br>
                Orders

            </div>

            <div class="col-4 text-center">
            <?php
                    $sql3 ="SELECT SUM(total) AS Total FROM t_order WHERE status='Delivered'";
                    $res3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($res3);
                    $total_revenue = $row3['Total'];
                ?>
                <h1><?php echo $total_revenue; ?> ₹</h1><br>
                Revenue Generated

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Menu section starts-->

    <?php include('partials/footer.php') ?>