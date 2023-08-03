<?php

use function PHPSTORM_META\elementType;

include('partials-front\menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">E-Menu</h2>

            <?php 
                $sql = "SELECT * FROM t_cake WHERE active='Yes'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['discription'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                    ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name == ""){
                                        echo "<div class='error'>NO IMAGE FOUND</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo HOMEURL?>img/items/<?php echo $image_name ?>" alt="Chicke Hawain Burger" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title ?></h4>
                                <p class="food-price"><?php echo $price ?></p>
                                <p class="food-detail">
                                    <?php echo $description ?>
                                </p>
                                <br>

                                <a href="<?php echo HOMEURL ?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php

                }
            }
                else{
                    echo "<div class='error'>CAKES NOT FOUND</div>";
                }
            ?>

            <div class="clearfix"></div> 

        </div>

        <!-- <p class="text-center">
            <a href="#">See All</a>
        </p> -->
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front\footer.php'); ?>