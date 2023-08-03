<?php include('partials/menu.php') ?>

    <div class="main-content">
            <div class="wrapper">
                <h1>MANAGE ORDER</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['update'])){
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                ?>
                
            <table class="tbl-full" style="font-size: 11px;">
                <tr>
                    <th>Sr.No</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Customer name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM t_order ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count>0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
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
                            ?>
                            <tr>
                                <td><?php echo $sn;?></td>
                                <td><?php echo $food;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php echo $qty;?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date;?></td>

                                <td>
                                  <?php
                                    if($status == "Oredered"){
                                        echo "<label>$status</label>";
                                    }elseif($status == "On delivery"){
                                        echo "<label style='color:orange;'>$status</label>";
                                    }elseif($status == "Delivered"){
                                        echo "<label style='color:green;'>$status</label>";
                                    }elseif($status == "Cancelled"){
                                        echo "<label style='color:red;'>$status</label>";
                                    }
                                  ?>  
                                </td>

                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_address." ".$pincode; ?></td>
                                <td>
                                    <a href="<?php echo HOMEURL ?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondry">Update Order</a>
                                </td>
                            </tr>
                            <?php
                            $sn++;
                        }
                    }else{
                        echo "<tr><td colspan='12' class='error'>Order Not Found0</td></tr>";
                    }
                ?>
                
            </table>
        </div>
    </div>

<?php include('partials/footer.php') ?>