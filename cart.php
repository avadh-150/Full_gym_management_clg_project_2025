<?php include "include/header.php";


?>

<body>

    <!-- Navigation -->
    <?php include "include/nav.php"; 
    
    if (!isset($_SESSION['auth_user'])) {
        echo "<script>alert('Please login firsr to access this side');
        window.location.href = 'login.php';
        exit();
        </script>";
        }
    
    ?>

    <!-- Cart Section -->
    <section class="section element-animate">
        <div class="container" id="body">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a> / </li>
                        <li class="active">Cart</li>
                    </ol>
                </div>

                <div class="col-md-12">
                    <?php if (isset($_SESSION['auth_user'])) {
                         include 'admin/dbcon.php';                        
                        ?>
                        <form action="" method="post" class="checkout-form">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th width="180px">Qty.</th>
                                        <th width="120px">Product Rent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   

                                    // Fetch user cart
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $sql = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name as name, p.image as image, p.price as price 
                                            FROM carts c 
                                            INNER JOIN products p ON c.product_id = p.id 
                                            WHERE c.user_id='$user_id' 
                                            ORDER BY cid DESC";
                                    $result = mysqli_query($con, $sql);

                                    $cart_empty = true; // Flag to check if the cart is empty

                                    if (mysqli_num_rows($result) > 0) {
                                        $cart_empty = false; // Set to false if products exist

                                        while ($product = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr class="product-details">
                                                <td>
                                                    <img src="admin/uploads/products/<?= htmlspecialchars($product['image']) ?>"
                                                        alt="<?= htmlspecialchars($product['name']) ?>"
                                                        class="img-fluid" width="90px">
                                                </td>
                                                <td><?= htmlspecialchars($product['name']) ?></td>
                                                <td>
                                                    <div class="input-group quantity-box">
                                                        <input type="hidden" value="<?= $product['product_id'] ?>" class="product_id">
                                                        <button class="btn btn-outline-secondary decrease-btn updateQty" type="button">-</button>
                                                        <input type="number" name="qty" class="form-control quantity-input" value="<?= $product['product_qty'] ?>" disabled>
                                                        <button class="btn btn-outline-secondary increase-btn updateQty" type="button">+</button>
                                                    </div>
                                                </td>
                                                <td>₹<?= number_format($product['price'], 2) ?></td>
                                                <td>
                                                    <button type="button" value="<?= $product['cid'] ?>" class="btn btn-danger btn-sm deleteItems">Remove</button>
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

                            <div class="text-end">
                                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                                <a href="<?= $cart_empty ? 'javascript:void(0);' : 'checkout.php' ?>"
                                    class="btn btn-success" style="float:right;"
                                    <?= $cart_empty ? 'onclick="alert(\'Your cart is empty!\');"' : '' ?>>
                                    Proceed to Checkout
                                </a>
                            </div>

                        </form>
                    <?php } else { ?>
                        <div class="alert alert-warning text-center">
                            <b>No products in your cart.</b>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "include/footer.php"; ?>

</body>

</html>