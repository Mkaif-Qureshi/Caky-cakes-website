<?php include('partials-front\menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">EXPLORE CAKES</h2>

            <?php
                $sql = "SELECT * FROM t_cake WHERE active='Yes' AND category_id = 14 ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="category-foods.html">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name==""){
                                    echo "<div class='error'>NO image</div>";
                                }else{
                                    ?>
                                        <img src="<?php echo HOMEURL?>img\items\<?php echo $image_name ?>" alt="BIRTHDAY" class="img-responsive img-curve" style="width: 125px;
    height: 120px;">
                                        <h3 class="float-text text-black"><?php echo $title?></h3>
                                    <?php
                                }
                            ?>
                        </div>
                        </a>
                        <?php
                    }

                }else{
                    echo "<div calss='error'>No data found</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2 class="text-center">EXPLORE Cookies</h2>

            <?php
                $sql = "SELECT * FROM t_cake WHERE active='Yes' AND category_id = 16 ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="category-foods.html">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name==""){
                                    echo "<div class='error'>NO image</div>";
                                }else{
                                    ?>
                                        <img src="<?php echo HOMEURL?>img\items\<?php echo $image_name ?>" alt="BIRTHDAY" class="img-responsive img-curve" style="width: 125px;
    height: 120px;">
                                        <h3 class="float-text text-black"><?php echo $title?></h3>
                                    <?php
                                }
                            ?>
                        </div>
                        </a>
                        <?php
                    }

                }else{
                    echo "<div calss='error'>No data found</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2 class="text-center">EXPLORE CUPCAKES</h2>

            <?php
                $sql = "SELECT * FROM t_cake WHERE active='Yes' AND category_id = 17 ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="category-foods.html">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name==""){
                                    echo "<div class='error'>NO image</div>";
                                }else{
                                    ?>
                                        <img src="<?php echo HOMEURL?>img\items\<?php echo $image_name ?>" alt="BIRTHDAY" class="img-responsive img-curve" style="width: 125px;
    height: 120px;">
                                        <h3 class="float-text text-black"><?php echo $title?></h3>
                                    <?php
                                }
                            ?>
                        </div>
                        </a>
                        <?php
                    }

                }else{
                    echo "<div calss='error'>No data found</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front\footer.php') ?>