<?php
// session_start();
include "include/header.php";
include "configuration.php";
include "admin/dbcon.php";

// $Publishable_key = "your_stripe_publishable_key"; // Replace with actual key

if (!isset($_SESSION['auth_user'])) {
    echo "<script>alert('Please login firsr to access this side');
    window.location.href = 'login.php';
    exit();
    </script>";
    }
?>

<body>

    <!-- Navigation -->
    <?php include "include/nav.php"; ?>

    <!-- Cart Section -->
    <section class="section element-animate">
        <div class="container" id="body">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a> / </li>
                    <li><a href="cart.php">Cart</a> / </li>
                    <li class="active">Checkout</li>
                </ol>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="include/place_order.php" method="POST">
                        <div class="row">
                            <div class="col-md-7">
                                <h5>Basic Details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Name</label>
                                        <input type="text" name="name" placeholder="Enter your full name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">E-mail</label>
                                        <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Phone</label>
                                        <input type="text" name="phone" placeholder="Enter your phone number" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Pin Code</label>
                                        <input type="text" name="pincode" placeholder="Enter your pin code" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Address</label>
                                        <textarea name="address" class="form-control" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h5>Order Details</h5>
                                <hr>

                                <?php
                                if (isset($_SESSION['auth_user'])) {
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $sql = "SELECT c.id as cid, c.product_id as product_id, c.product_qty, 
                                                   p.id as pid, p.name as name, p.image as image, p.price as price 
                                            FROM carts c 
                                            INNER JOIN products p ON c.product_id = p.id 
                                            WHERE c.user_id='$user_id'";
                                    $result = mysqli_query($con, $sql);

                                    $grand_total = 0;
                                    $cart_empty = true; // Assume cart is empty

                                    if (mysqli_num_rows($result) > 0) {
                                        $cart_empty = false; // Cart has items

                                        while ($product = mysqli_fetch_assoc($result)) {
                                            $subtotal = $product['price'] * $product['product_qty'];
                                            $grand_total += $subtotal;
                                ?>
                                            <div class="mb-1 border p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">
                                                        <img src="admin/uploads/products/<?= htmlspecialchars($product['image']) ?>" 
                                                             alt="<?= htmlspecialchars($product['name']) ?>" 
                                                             class="img-fluid" width="60px">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label><?= htmlspecialchars(substr($product['name'], 0, 20)) ?>...</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>₹<?= number_format($product['price'], 2) ?></label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>x<?= $product['product_qty']; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                    if ($cart_empty) {
                                        echo '<div class="alert alert-warning text-center">
                                                <strong>No products in your cart.</strong>
                                              </div>';
                                    }
                                ?>

                                <hr>
                                <h5>Total Amount: <span class="float-end fw-bold" style="float:right;">₹<?= number_format($grand_total, 2) ?></span></h5>
                                <hr>
                                <div>
                                    <a href="cart.php" class="btn btn-primary">Back to Cart</a>
                                    <button type="submit" name="place_order" class="btn btn-info" style="float:right;" <?= $cart_empty ? 'disabled' : '' ?>>
                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="<?= $Publishable_key ?>"
                                        data-amount="<?= $grand_total * 100 ?>"
                                        data-name="Fitness Club"
                                        data-description="Place the Order"
                                        data-currency="inr">
                                </script>
                                    </button>
                                </div>

                               

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "include/footer.php"; ?>

</body>
</html>