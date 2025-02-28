<?php
include 'admin/dbcon.php';  //config file

$p_id = $_GET['pid'];

// Increment product views
// $sql = "UPDATE products SET product_views=product_views+1 WHERE id=$p_id";
// $result = mysqli_query($con, $sql);

$row = [];

// Fetch product details
$sql1 = "SELECT * FROM products WHERE id=$p_id";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
} else {
    echo '<div class="error-message">Product Not Found</div>';
    exit;
}

?>

<?php include "include/header.php" ?>

<?php include "include/nav.php" ?>
<br><br><br>
<div class="single-product-container">
    <div class="container">
<div id="massge"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="product-image">
                    <img id="product-img" src="admin/uploads/products/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-responsive" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="product-content">
                    <div class="row">

                        <div class="col-md-offset-5 col-md-7">
                            <?php
                            $sql2 = "select pc.name as category_name from products p,product_categories pc where pc.id=p.category_id AND p.id=$p_id";
                            // $sql2 = "SELECT * FROM product_categories WHERE id=$id_cate";
                            $result2 = mysqli_query($con, $sql2);
                            if (mysqli_num_rows($result2) > 0) {
                                $row2 = mysqli_fetch_assoc($result2);
                            ?>
                                <ol class="breadcrumb">
                                    <li><a href="index.php">Home</a>
                                    </li>/
                                    <li><a href="gallery.php"> <?php echo $row2['category_name']; ?> </a></li> /
                                    <li class="active"> <?php echo htmlspecialchars(substr($row['name'], 0, 20)), '...'; ?></li>
                                </ol>
                            <?php
                            } else {
                                echo '<div class="error-message">Category Not Found</div>';
                            }
                            ?>
                        </div>

                    </div>
                    <h3 class="title"><?php echo htmlspecialchars($row['name']); ?></h3>
                    <hr>
                    <p style="color:green;font-weight:600; margin-top:20px;">Special price:</p>
                    <span class="price "> ₹<?php echo number_format($row['price'], 2); ?></span>
                    <div class="row mt-2">
                        <div class="col-md-4 ">
                            <div class="input-group quantity-box">
                                <button class="btn btn-outline-secondary decrease-btn" type="button">-</button>
                                <input type="number" class="form-control quantity-input" value="1" min="1" aria-label="Quantity" disabled>
                                <button class="btn btn-outline-secondary increase-btn" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <br>
                    <!-- <a href="terms.php" class="terms-link addTocart" value="<?= $row['id']?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</a> -->
                    <button type="submit" class="terms-link addTocart" value="<?= $row['id']?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                    <hr>
                    <!-- <label>Descriptions</label> -->
                    <p class="description"><?php echo html_entity_decode($row['description']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<?php include 'include/footer.php'; ?>