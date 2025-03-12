<?php
session_start();
error_reporting(0);
// ini_set(option: 'display_errors', 1);

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

// Get products
$products = [];
$sql = "SELECT * FROM products WHERE category_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $category_id);

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
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/pic16.jpg');
            /* background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%); */

            background-size: cover;
            background-position: center;
            padding: 60px 0;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .category-header h1 {

            margin-top: 28px;
            font-size: 2.5rem;
            font-weight: 700;
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

        .breadcrumb-item+.breadcrumb-item {
            padding-left: 10px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            display: inline-block;
            padding-right: 10px;
            color: var(--dark-gray);
            content: "/";
        }

        .breadcrumb-item.active {
            color: var(--dark-gray);
        }

        .container {
            /* margin-top: -20px; */
        }

        /* old product css */
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
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.8);
        }

        .product-card img {
            /* width: 100%; */
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .product-card:hover img {
            transform: scale(1.05);
        }
        .product-card h4 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .add-to-cart-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
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
            background-color: #ff5722;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-lg-4,
        .col-md-6,
        .col-sm-12 {
            display: flex;
            justify-content: center;
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

        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateX(0);
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
            /* width: 100%; */
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


        <!-- Products Section -->
        <section class="section element-animate">
            <div class="container">
                <div class="row">
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

                                <a href="single_product.php?pid=<?= $product['id'] ?>">

                                    <div class="product-card product-details">
                                        <img src="admin/uploads/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid">
                                        <div class="product-actions">
                                            <a href="single_product.php?pid=<?php echo $product['id']; ?>" class="action-btn" title="Quick View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <h4><?= substr($product['name'], 0, 50), '...' ?></h4>
                                        <div class="product-price">

                                            <p class="current-price"> Rs.<?= number_format($product['price'], 2) ?></p>
                                        </div>
                                        <form action="" method="POST" style="width: 100%;">
                                            <input type="hidden" class="quantity-input" name="qty" value="1">
                                            <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                            <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                            <button type="submit" class="add-to-cart-btn addTocart" value="<?= $product['id'] ?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>

                                        </form>
                                    </div>
                                </a>
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
                                <a href="products.php?category=<?php echo $category['id']; ?>" class="category-link">
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