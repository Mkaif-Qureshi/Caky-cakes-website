<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ORDER</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM t_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['name'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['costumer_name'];
                    $customer_contact = $row['costumer_contact'];
                    $customer_email = $row['costumer_email'];
                    $customer_address = $row['costumer_address'];
                    $pincode = $row['pincode'];
                }
                else{
                    header("location:".HOMEURL."admin/manage-order.php");
                }
            }
            else{
                // header("location:".HOMEURL."admin/manage-order.php");
            }

        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food;?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty;?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if($status=="ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On ordered"){echo "selected";}?> value="On delivery">On delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value=<?php echo $id;?>>
                        <input type="hidden" name="price" value=<?php echo $price;?>>

                        <input type="submit" name="submit" value="UPADTE ORDER" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                echo $sql2 = "UPDATE t_order SET
                    qty = '$qty',
                    total = '$total',
                    status = '$status',
                    costumer_name = '$customer_name',
                    costumer_contact = '$customer_contact',
                    costumer_email = '$customer_email',
                    costumer_address = '$customer_address'
                    WHERE id=$id
                    ";
                
                $res2 = mysqli_query($conn, $sql2);

                var_dump($res2);
                if($res2 == true){
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
                    header("location:".HOMEURL."admin/manage-order.php");

                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to Update</div>";
                    header("location:".HOMEURL."admin/manage-order.php");
                }

            }else{

            }
        ?>
    </div>
</div>
<?php include("partials/footer.php");?>