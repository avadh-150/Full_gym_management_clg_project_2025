<?php include "include/header.php"; ?>

<body>

    <!-- Navigation -->
    <?php include "include/nav.php"; ?>
    <?php
    if (isset($_SESSION['auth_user'])) {
        include 'admin/dbcon.php';
        if ($_GET['order_number']) {
            $user_id = $_SESSION['auth_user']['user_id'];
            $order_no = $_GET['order_number'];
            $sql = "select * from orders where tracking_id=$order_no AND user_id = $user_id";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) < 0) {
    ?>
                <div class="alert alert-warning text-center">
                    <h4>Something went wrong</h4>
                </div>
        <?php
                die();
            }
        }
    } else { ?>
        <div class="alert alert-warning text-center">
            <h4>Login to continue</h4>
        </div>
    <?php
        die();
    }

    $data = mysqli_fetch_array($result);

    ?>


    <!-- Cart Section -->
    <section class="section element-animate">
        <div class="container" id="body">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a> / </li>
                    <li><a href="my_orders.php">My Orders</a> / </li>
                    <li class="active">View Details</li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-3" style="font-size:18px;">
                        View Details
                        <a href="my_orders.php" class="btn btn-info" style="float:right"><i class="fa fa-reply"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Delivery Details</h4>
                                <hr>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold" style="font-weight:bold;">Name</label>
                                    <div class="border p-1">
                                        <?= $data['name'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label style="font-weight:bold;">Email</label>
                                    <div class="border p-1">
                                        <?= $data['email'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label style="font-weight:bold;">Phone</label>
                                    <div class="border p-1">
                                        <?= $data['phone'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label style="font-weight:bold;">Tracking_id</label>
                                    <div class="border p-1">
                                        <?= $data['tracking_id'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label style="font-weight:bold;">Address Details</label>
                                    <div class="border p-1">
                                        <?= $data['address'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label style="font-weight:bold;">Pin Code</label>
                                    <div class="border p-1">
                                        <?= $data['pincode'] ?>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $userid = $_SESSION['auth_user']['user_id'];
                                        $sql1 = "select o.id as oid,o.tracking_id,o.user_id,oi.*,p.* from orders o, order_items oi,products p where oi.order_id=o.id and oi.product_id=p.id and user_id=$userid and o.tracking_id ='$order_no'";

                                        $result1 = mysqli_query($con, $sql1);

                                        if (mysqli_num_rows($result1) > 0) {
                                            foreach ($result1 as $row1) {

                                        ?>


                                                <tr>

                                                    <td class="align-middle">
                                                        <img src="admin/uploads/products/<?= $row1['image']; ?>"
                                                            alt="<?= $row1['name']; ?>"
                                                            class="img-fluid" width="50px">
                                                            <?= substr($row1['name'],0,20),'..'; ?>
                                                    </td>
                                                    <td class="align-middle">₹<?= number_format($row1['price'], 2) ?></td>
                                                    <td class="align-middle">x<?= number_format($row1['qty']) ?></td>

                                                </tr>


                                        <?php                                             }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr>
                                <h5>Total Amount: <span class="float-end fw-bold" style="float:right;">₹<?= number_format($data['total_price'], 2) ?></span></h5>
                                <hr>
                                <label style="font-weight:bold;">Payment Method</label>
                                <div class="border p-1 mb-3">
                                    <?= $data['payment_method']?>
                                </div>
                                <label style="font-weight:bold;">Payment Status</label>
                                <div class="border p-1 mb-3">
                                    <?php 
                                    if($data['status'] ==0) {
                                        echo "Under Process";
                                    }
                                    else if($data['status'] ==1) {
                                        echo "Completed";
                                    }
                                    
                                    else if($data['status'] ==2) {
                                        echo "Cancelled";
                                    }
                                    
                                    
                                    
                                    ?>
                                </div>
                                <?php 
                                $userID=$_SESSION['auth_user']['user_id'];
                                $order_id=$data['id'];
                                $sql="select * from payments where user_id=$userID and order_id=$order_id";
                                $result=mysqli_query($con,$sql);
                                $row=mysqli_fetch_array($result);
                                ?>
                                <label style="font-weight:bold;">Payment Transaction ID</label>
                                <div class="border p-1 mb-3">
                                    <?= $row['transaction_id']?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
</body>

</html>