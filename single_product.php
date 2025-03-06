<?php
include 'admin/dbcon.php';  // config file

$p_id = $_GET['pid'];

// Fetch product details
$sql1 = "SELECT * FROM products WHERE id=$p_id";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
} else {
    echo '<div class="alert alert-danger">Product Not Found</div>';
    exit;
}

// Fetch category name
$sql2 = "SELECT pc.name as category_name FROM products p, product_categories pc WHERE pc.id=p.category_id AND p.id=$p_id";
$result2 = mysqli_query($con, $sql2);
$category = mysqli_num_rows($result2) > 0 ? mysqli_fetch_assoc($result2) : null;

// Fetch related products
$cat_id = $row['category_id'];
$sql3 = "SELECT * FROM products WHERE category_id=$cat_id AND id!=$p_id LIMIT 4";
$related_products = mysqli_query($con, $sql3);

include "include/header.php";
include "include/nav.php";
?>
<style>
    /* Product Detail Page Styles */
.product-detail-section {
  padding: 80px 0;
  background-color: #f8f9fa;
}

/* Breadcrumb */
.breadcrumb {
  background-color: transparent;
  padding: 0.75rem 0;
  margin-bottom: 2rem;
  border-bottom: 1px solid #e9ecef;
}

.breadcrumb-item a {
  color: #6c757d;
  text-decoration: none;
}

.breadcrumb-item.active {
  color: #343a40;
  font-weight: 600;
}

/* Product Image */
.product-image-container {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  text-align: center;
  margin-bottom: 20px;
}

#product-img {
  max-height: 500px;
  object-fit: contain;
}

/* Product Details */
.product-details {
  background-color: #fff;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.product-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  color: #212529;
}

.price-container {
  margin-bottom: 1.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #e9ecef;
}

.price-label {
  display: block;
  color: #28a745;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.price {
  font-size: 2rem;
  font-weight: 700;
  color: #212529;
}

/* Quantity Control */
.quantity-control {
  display: flex;
  align-items: center;
  border: 1px solid #ced4da;
  border-radius: 4px;
  overflow: hidden;
}

.btn-quantity {
  background-color: #f8f9fa;
  border: none;
  padding: 0.5rem 1rem;
  font-weight: bold;
}

.quantity-input {
  border: none;
  text-align: center;
  width: 50px;
  padding: 0.5rem 0;
}

/* Add to Cart Button */
.btn-add-to-cart {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  border-radius: 4px;
  width: 100%;
  transition: all 0.3s ease;
}

.btn-add-to-cart:hover {
  background-color: #c82333;
  transform: translateY(-2px);
}

/* Product Description */
.product-description {
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid #e9ecef;
}

.product-description h4 {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: #343a40;
}

.description-content {
  color: #6c757d;
  line-height: 1.6;
}

/* Product Features */
.product-features h4 {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: #343a40;
}

.features-list {
  padding-left: 1.5rem;
  list-style-type: none;
}

.features-list li {
  margin-bottom: 0.5rem;
  color: #6c757d;
}

.features-list li i {
  color: #28a745;
  margin-right: 0.5rem;
}

/* Related Products */
.related-products {
  margin-top: 4rem;
}

.section-title {
  font-size: 1.75rem;
  font-weight: 700;
  margin-bottom: 2rem;
  text-align: center;
  position: relative;
  padding-bottom: 1rem;
}

.section-title:after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background-color: #dc3545;
}

.product-card {
  background-color: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.product-card a {
  text-decoration: none;
  color: inherit;
}

.product-img-container {
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  background-color: #f8f9fa;
}

.product-img-container img {
  max-height: 100%;
  object-fit: contain;
}

.product-info {
  padding: 1rem;
}

.product-name {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #343a40;
  height: 2.5rem;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

.product-price {
  font-weight: 700;
  color: #dc3545;
  margin-bottom: 0;
}

/* Responsive Adjustments */
@media (max-width: 767.98px) {
  .product-detail-section {
    padding: 40px 0;
  }

  .product-title {
    font-size: 1.5rem;
  }

  .price {
    font-size: 1.5rem;
  }

  .product-actions .col-md-8 {
    margin-top: 1rem;
  }
}


</style>

<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container">
        <div id="message-container"></div>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="my-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <?php if ($category): ?>
                <li class="breadcrumb-item"><a href="gallery.php?category=<?php echo $category['category_name']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars(substr($row['name'], 0, 30)); ?></li>
            </ol>
        </nav>
        
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-4">
                <div class="product-image-container">
                    <img id="product-img" src="admin/uploads/products/<?php echo htmlspecialchars($row['image']); ?>" 
                         alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid rounded shadow-sm" />
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="product-details">
                    <h2 class="product-title"><?php echo htmlspecialchars($row['name']); ?></h2>
                    <div class="price-container">
                        <span class="price-label">Special Price:</span>
                        <span class="price">₹<?php echo number_format($row['price'], 2); ?></span>
                    </div>
                    
                    <div class="product-actions mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-4 col-6">
                                <div class="quantity-control">
                                    <button class="btn btn-quantity decrease-btn" type="button">-</button>
                                    <input type="number" class="form-control quantity-input" value="1" min="1" aria-label="Quantity">
                                    <button class="btn btn-quantity increase-btn" type="button">+</button>
                                </div>
                            </div>
                            <div class="col-md-8 col-12 mt-3 mt-md-0">
                                <button type="button" class="btn btn-add-to-cart addTocart" value="<?= $row['id']?>">
                                    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-description mt-4">
                        <h4>Product Description</h4>
                        <div class="description-content">
                            <?php echo html_entity_decode($row['description']); ?>
                        </div>
                    </div>
                    
                    <?php if (!empty($row['features'])): ?>
                    <div class="product-features mt-4">
                        <h4>Features</h4>
                        <ul class="features-list">
                            <?php 
                            $features = explode("\n", $row['features']);
                            foreach ($features as $feature):
                                if (trim($feature)):
                            ?>
                                <li><i class="fa-solid fa-check"></i> <?php echo htmlspecialchars(trim($feature)); ?></li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <?php if (mysqli_num_rows($related_products) > 0): ?>
        <div class="related-products mt-5">
            <h3 class="section-title">Related Products</h3>
            <div class="row">
                <?php while ($related = mysqli_fetch_assoc($related_products)): ?>
                <div class="col-md-3 col-6 mb-4">
                    <div class="product-card">
                        <a href="single_product.php?pid=<?php echo $related['id']; ?>">
                            <div class="product-img-container">
                                <img src="admin/uploads/products/<?php echo htmlspecialchars($related['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($related['name']); ?>" class="img-fluid">
                            </div>
                            <div class="product-info">
                                <h5 class="product-name"><?php echo htmlspecialchars(substr($related['name'], 0, 40)); ?></h5>
                                <p class="product-price">₹<?php echo number_format($related['price'], 2); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Custom JavaScript -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity controls
    const decreaseBtn = document.querySelector('.decrease-btn');
    const increaseBtn = document.querySelector('.increase-btn');
    const quantityInput = document.querySelector('.quantity-input');
    
    decreaseBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });
    
    increaseBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        quantityInput.value = value + 1;
    });
    
    // Add to cart functionality
    const addToCartBtn = document.querySelector('.addTocart');
    addToCartBtn.addEventListener('click', function() {
        const productId = this.value;
        const quantity = quantityInput.value;
        
        // AJAX call to add to cart
        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                $('#message-container').html('<div class="alert alert-success">Product added to cart successfully!</div>');
                // Scroll to message
                $('html, body').animate({
                    scrollTop: $("#message-container").offset().top - 100
                }, 500);
                
                // Update cart count if you have a cart counter
                // updateCartCount();
            },
            error: function() {
                $('#message-container').html('<div class="alert alert-danger">Failed to add product to cart. Please try again.</div>');
            }
        });
    });
});
</script> -->

<?php include 'include/footer.php'; ?>

