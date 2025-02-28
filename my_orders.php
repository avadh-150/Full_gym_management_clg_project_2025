<?php include "include/header.php"; ?>

<body>

    <!-- Navigation -->
    <?php include "include/nav.php"; ?>

    <!-- Cart Section -->
    <section class="section element-animate" style="height:800px;">
        <div class="container" id="body">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a> / </li>
                    <li class="active">My_Orders</li>
                </ol>
            </div>
            <div class="col-md-12">
                <?php if (isset($_SESSION['auth_user'])) {
                    include 'admin/dbcon.php';
                ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Traking No</th>
                                <th width="130px">Price.</th>
                                <th width="120px">Date</th>
                                <th>Order Placed</th>
                                <th>Delivery Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch user cart
                            $status = '';
                            $user_id = $_SESSION['auth_user']['user_id'];
                            $sql = "SELECT * from orders WHERE user_id='$user_id'";
                            $result = mysqli_query($con, $sql);
                         
                            if (mysqli_num_rows($result) > 0) {

                                while ($product = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr class="product-content">
                                       
                                        <td><?= htmlspecialchars($product['id']) ?></td>
                                        <td><?= htmlspecialchars($product['tracking_id']) ?></td>
                                        <td>₹<?= number_format($product['total_price'], 2) ?></td>
                                        <td><?= htmlspecialchars($product['create_at']) ?></td>
                                        <td><?php echo date('d M, Y',strtotime($product['create_at'])); ?></td>
                                        <td><?php if($product['delivery']=='1')
                                        {
                                            $status = '<label style="background-color: #ffc107; color: #000; padding: 5px 10px; border-radius: 3px;">Dispatch</label>';
                                        }
                                        else{
                                            $status = '<label class="label label-primary" style="background-color:rgb(7, 139, 255); color: #000; padding: 5px 10px; border-radius: 3px;">In - Process</label>';                                        }
                                        ?>
                                        <b></b><?php  echo $status; ?>
                                        
                                    </td>
                                    
                                        <td>
                                            <a href="vieworder.php?order_number=<?= $product['tracking_id']?>" value="" class="btn btn-primary btn-sm">view detail..</a>
                                        </td>
                                        <td>
                                            <span><b>Delivery Expected By :</b> <?php echo date('d',strtotime($product['create_at']. ' +4 day')); ?> - <?php echo date('d F, Y',strtotime($product['create_at']. ' +7 day')); ?></span>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr height="200px">
                                    <td colspan="5" class="text-center alert alert-warning">
                                        <b>Your cart is empty.</b>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>



                <?php } else { ?>
                    <div class="alert alert-warning text-center">
                        <b>No products in your cart.</b>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
</body>

</html>