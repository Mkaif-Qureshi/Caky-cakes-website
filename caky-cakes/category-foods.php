<?php include('partials-front\menu.php'); ?>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">E-Menu</h2>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="img/chocolate.jpeg" alt="Chicke Hawain Burger" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Premium chocolate Truffle Cake</h4>
                    <p class="food-price">₹450</p>
                    <p class="food-detail">
                        Premium chocolate truffle cake A combination of design and taste
                    </p>
                    <br>

                    <a href="<?php echo HOMEURL ?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="clearfix"></div>

            
        </div>

        <p class="text-center">
            <a href="#">See All</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front\footer.php') ?>