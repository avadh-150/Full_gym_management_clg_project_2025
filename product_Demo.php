<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'admin/dbcon.php';
$category_id = $_GET['category'];


// Get category details
$category_name = "All Products";

if ($category_id) {
    $cat_sql = "SELECT name FROM product_categories WHERE id = ?";
    $cat_stmt = $con->prepare($cat_sql);
    $cat_stmt->bind_param("i", $category_id);
    $cat_stmt->execute();
    $cat_result = $cat_stmt->get_result();
    if ($cat_result->num_rows > 0) {
        $category = $cat_result->fetch_assoc();
        $category_name = $category['name'];
    }
}

$cid=3;
// Get products
$products = [];$sql = "SELECT * FROM products WHERE category_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $cid);

if (!$stmt->execute()) {
    die("Query Failed: " . $stmt->error);
}


$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No products found for category ID: " . $category_id;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category_name; ?> - FitPro Shop</title>
    <?php include "include/header.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ff5722;
            --secondary-color: #212529;
            --accent-color: #4CAF50;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --border-radius: 8px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        /* Category Header */
        .category-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/shop-banner.jpg');
            background-size: cover;
            background-position: center;
            padding: 60px 0;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .category-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .category-header p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        /* Breadcrumbs */
        .breadcrumb-wrapper {
            background-color: var(--light-gray);
            padding: 15px 0;
            margin-bottom: 40px;
        }
        
        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
            list-style: none;
            background-color: transparent;
        }
        
        .breadcrumb-item {
            display: flex;
            align-items: center;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .breadcrumb-item a:hover {
            color: var(--secondary-color);
        }
        
        .breadcrumb-item + .breadcrumb-item {
            padding-left: 10px;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            display: inline-block;
            padding-right: 10px;
            color: var(--dark-gray);
            content: "/";
        }
        
        .breadcrumb-item.active {
            color: var(--dark-gray);
        }
        
        /* Filter Section */
        .filter-section {
            margin-bottom: 30px;
        }
        
        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .filter-options {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .filter-label {
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .sort-select {
            padding: 8px 15px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            background-color: white;
            color: var(--secondary-color);
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .sort-select:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .view-options {
            display: flex;
            gap: 10px;
        }
        
        .view-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            color: var(--dark-gray);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .view-btn:hover, .view-btn.active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .results-count {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }
        
        /* Product Grid */
        .products-grid {
            margin-bottom: 50px;
        }
        
        .product-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            position: relative;
            border: none;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .product-image {
            position: relative;
            overflow: hidden;
            height: 250px;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 1;
        }
        
        .product-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1;
            opacity: 0;
            transform: translateX(20px);
            transition: var(--transition);
        }
        
        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateX(0);
        }
        
        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .action-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-category {
            font-size: 0.8rem;
            color: var(--dark-gray);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--secondary-color);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 50px;
        }
        
        .product-price {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .current-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .old-price {
            font-size: 0.9rem;
            color: var(--dark-gray);
            text-decoration: line-through;
        }
        
        .discount-percent {
            font-size: 0.8rem;
            background-color: var(--primary-color);
            color: white;
            padding: 3px 8px;
            border-radius: 20px;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 15px;
        }
        
        .rating-stars {
            color: #ffc107;
        }
        
        .rating-count {
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .add-to-cart-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .add-to-cart-btn:hover {
            background-color: #3d8b40;
            transform: translateY(-2px);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background-color: var(--light-gray);
            border-radius: var(--border-radius);
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: var(--dark-gray);
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        .empty-state p {
            color: var(--dark-gray);
            max-width: 500px;
            margin: 0 auto 20px;
        }
        
        /* Related Categories */
        .related-categories {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .category-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            text-align: center;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .category-image {
            height: 150px;
            overflow: hidden;
        }
        
        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .category-card:hover .category-image img {
            transform: scale(1.05);
        }
        
        .category-info {
            padding: 20px;
        }
        
        .category-info h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .category-info p {
            color: var(--dark-gray);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .category-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .category-link:hover {
            color: var(--secondary-color);
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .category-header {
                padding: 40px 0;
            }
            
            .category-header h1 {
                font-size: 2rem;
            }
            
            .filter-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-options {
                width: 100%;
                justify-content: space-between;
            }
            
            .results-count {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }
        }
        
        @media (max-width: 767px) {
            .product-image {
                height: 200px;
            }
            
            .product-actions {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @media (max-width: 575px) {
            .breadcrumb-wrapper {
                display: none;
            }
            
            .filter-options {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .view-options {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include "include/nav.php"; ?>
    
    <!-- Category Header -->
    <section class="category-header">
        <div class="container">
            <h1><?php echo $category_name; ?></h1>
            <p>Discover our premium selection of fitness products to enhance your workout experience</p>
        </div>
    </section>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-wrapper">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="gallery.php">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $category_name; ?></li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="container">
        <!-- Filter Section -->
        <section class="filter-section">
            <div class="filter-container">
                <div class="filter-options">
                    <div class="sort-by">
                        <span class="filter-label">Sort By:</span>
                        <select class="sort-select" id="sort-products">
                            <option value="newest">Newest</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="name-asc">Name: A to Z</option>
                            <option value="name-desc">Name: Z to A</option>
                        </select>
                    </div>
                    <div class="view-options">
                        <button class="view-btn active" data-view="grid"><i class="fas fa-th"></i></button>
                        <button class="view-btn" data-view="list"><i class="fas fa-list"></i></button>
                    </div>
                </div>
                <div class="results-count">
                       <?php echo $result->num_rows; ?> products
                </div>
            </div>
        </section>
        
        <!-- Products Grid -->
        <section class="products-grid">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                      
                        // // Calculate discount if applicable
                        // $discount = 0;
                        // $old_price = 0;
                        // if (isset($product['old_price']) && $product['old_price'] > $product['price']) {
                        //     $old_price = $product['old_price'];
                        //     $discount = round(($old_price - $product['price']) / $old_price * 100);
                        // }
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <?php if ($discount > 0): ?>
                            <div class="product-badge">-<?php //echo $discount; ?>%</div>
                            <?php endif; ?>
                            <img src="admin/uploads/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <div class="product-actions">
                                <a href="single_product.php?pid=<?php echo $product['id']; ?>" class="action-btn" title="Quick View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="action-btn wishlist-btn" title="Add to Wishlist" data-product-id="<?php echo $product['id']; ?>">
                                    <i class="far fa-heart"></i>
                                </button>
                                <button class="action-btn compare-btn" title="Compare" data-product-id="<?php echo $product['id']; ?>">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-category">
                                <?php echo $category_name; ?>
                            </div>
                            <h3 class="product-title">
                                <a href="single_product.php?pid=<?php echo $product['id']; ?>">
                                    <?php echo $product['name']; ?>
                                </a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">Rs.<?php echo number_format($product['price'], 2); ?></span>
                                <?php if ($old_price > 0): ?>
                                <span class="old-price">Rs.<?php echo number_format($old_price, 2); ?></span>
                                <span class="discount-percent"><?php echo $discount; ?>% off</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-rating">
                                <div class="rating-stars">
                                    <?php
                                    $rating = isset($product['rating']) ? $product['rating'] : rand(3, 5);
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fas fa-star"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <span class="rating-count">(<?php echo rand(5, 50); ?>)</span>
                            </div>
                            <form action="" method="POST" class="cart-form">
                                <input type="hidden" class="quantity-input" name="qty" value="1">
                                <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                <button type="button" class="add-to-cart-btn addTocart" value="<?php echo $product['id']; ?>">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                ?>
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3>No Products Found</h3>
                        <p>We couldn't find any products in this category. Please check back later or browse other categories.</p>
                        <a href="gallery.php" class="btn btn-primary">Browse All Products</a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </section>
        
        <!-- Related Categories -->
        <section class="related-categories">
            <h2 class="section-title">Browse Other Categories</h2>
            <div class="row">
                <?php
                // Get other categories
                $cat_sql = "SELECT * FROM product_categories WHERE id != ? ORDER BY RAND() LIMIT 3";
                $cat_stmt = $con->prepare($cat_sql);
                $cat_stmt->bind_param("i", $category_id);
                $cat_stmt->execute();
                $cat_result = $cat_stmt->get_result();
                
                while ($category = $cat_result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="admin/uploads/category/<?php echo $category['image'] ?? 'default.jpg'; ?>" alt="<?php echo $category['name']; ?>">
                        </div>
                        <div class="category-info">
                            <h3><?php echo $category['name']; ?></h3>
                            <p><?php echo substr($category['description'] ?? 'Explore our collection of ' . $category['name'], 0, 80); ?>...</p>
                            <a href="category.php?category=<?php echo $category['id']; ?>" class="category-link">
                                Browse Products <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </section>
    </div>
    
    <?php include "include/footer.php"; ?>
    
</body>
</html>





<!-- Old Product Layout of products  -->



<?php include "include/header.php";
//  session_start();
 ?>

 <!-- <link rel="stylesheet" href="css/plan.css"> -->
<style>
  
/* product css */
.product-card {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 15px;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  text-align: center;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  height: 100%;
}

.product-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.product-card img {
  /* width: 100%; */
  height: 200px;
  object-fit: cover;
  margin-bottom: 15px;
  border-radius: 10px;
}

.product-card h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.product-card p {
  font-size: 16px;
  color: #555;
  margin-bottom: 15px;
}

.add-to-cart-btn {
  background-color: #28a745;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: 100%;
}

.add-to-cart-btn:hover {
  background-color: #218838;
}

.row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.col-lg-4, .col-md-6, .col-sm-12 {
  display: flex;
  justify-content: center;
}
</style>
</head>

<body>

  <!-- Navigation -->
  <?php include "include/nav.php"; ?>


  <!-- Products Section -->
  <section class="section element-animate">
    <div class="container">
      <div class="row">
      <div class="col-md-12">
                <?php
                $cate = $_GET['category'] ;
                include 'admin/dbcon.php';
                $sql2 = "select pc.name AS category_name from products p,product_categories pc where pc.id=p.category_id AND pc.id=$cate";
                $result2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    $row2 = mysqli_fetch_assoc($result2);
                ?>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home </a> / </li> 
                        <li><a href="gallery.php">Category </a> / </li> 
                        <li><a href="#"> <?php echo $row2['category_name']; ?></a></li>
                    </ol>
                <?php
                } else {
                    echo '<div class="error-message">Category Not Found</div>';
                }
                ?>
            </div>
        <?php
        include 'admin/dbcon.php';
        $category = $_GET['category'] ?? '';
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          while ($product = $result->fetch_assoc()) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <a href="single_product.php?pid=<?=$product['id']?>">

                <div class="product-card product-details">
                  <img src="admin/uploads/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid">
                  <h4><?= substr($product['name'],0,50),'...' ?></h4>
                  <p>Price: Rs.<?= number_format($product['price'], 2) ?></p>
                  <form action="" method="POST" style="width: 100%;">
                    <input type="hidden" class="quantity-input" name="qty" value="1">
                    <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    <button type="submit" class="add-to-cart-btn addTocart"  value="<?= $product['id']?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>

                  </form>
                </div>
              </a>
            </div>
        <?php
          }
        } else {
          echo "<div class='col-12'><p class='text-center'>No products available in this category.</p></div>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include "include/footer.php"; ?>

</body>

</html>