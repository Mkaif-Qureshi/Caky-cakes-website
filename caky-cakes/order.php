<?php include('partials-front\menu.php'); ?>

<?php
    if(isset($_GET['food_id'])){
        $food_id = $_GET['food_id'];

        $sql = "SELECT * FROM t_cake WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        }else{
            header("location:".HOMEURL);
        }

    }else{
        header('location:'.HOMEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name == ""){
                                echo "<div class='error'>Image not avialable</div>";
                            }
                            else{
                                ?>
                                <img src="<?php echo HOMEURL ?>img/items/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo  $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title?>">
                        <p class="food-price"><?php echo $price ?>Rs</p>
                        <input type="hidden" name="price" value="<?php echo $price?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g.Sudhir Khanna" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. abc@xyz.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="order-label">Pincode</div>
                    <input type="pincode" name="pin" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" style="background-color:#8993db">
                </fieldset>

            </form>
            <?php
                if(isset($_POST['submit'])){
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Oredered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $pincode = $_POST['pin'];

                    $sql1 = "INSERT INTO t_order SET 
                    name = '$food',
                    price = '$price',
                    qty = '$qty',
                    total = '$total',
                    order_date = '$order_date',
                    status = '$status',
                    costumer_name = '$customer_name',
                    costumer_contact = '$customer_contact',
                    costumer_email= '$customer_email',
                    costumer_address = '$customer_address',
                    pincode = '$pincode'
                    ";

                    if(!preg_match('/^[0-9]{10}+$/', $customer_contact)){
                        $_SESSION['order'] = "<div class='error text-center'>Check Mobile no.</div>";
                        header("location:".HOMEURL);
                    }
                    elseif(!preg_match('/^[1-9][0-9]{5}$/', $pincode)){
                        $_SESSION['order'] = "<div class='error text-center'>Check pincode again</div>";
                        header("location:".HOMEURL);
                    }
                    else{
                        $res1 = mysqli_query($conn, $sql1);
    
                        if($res1 == true){
                            $_SESSION['order'] = "<div class='success text-center'>Ordered successfully</div>";
                            header("location:".HOMEURL);
                        }else{
                            $_SESSION['order'] = "<div class='error text-center'>Failed to order</div>";
                            header("location:".HOMEURL);
                        }
                    }


                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front\footer.php') ?>