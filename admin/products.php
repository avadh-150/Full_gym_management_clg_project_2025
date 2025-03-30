<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
</head>

<body>
    <!-- Header Part -->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>

    <!-- Top Header Menu -->
    <?php include 'includes/topheader.php'; ?>

    <!-- Sidebar Menu -->
    <?php $page = "products";
    include 'includes/sidebar.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="current">Product List <i class="fa-solid fa-dumbbell"></i></a>
            </div>
            <!-- <h1 class="text-center">Product List </h1> -->
        </div>
        <div class="container-fluid">
            <hr>
            <a href="product-entry.php"><button class="btn btn-primary">
                    <b>
                        <i class="fa-solid fa-plus"></i>
                    </b>
                </button></a>
            <div class="row-fluid">
                <div class="span12">
                    <div class='widget-box'>
                        <div class='widget-title'>
                            <span class='icon'> <i class='fas fa-th'></i> </span>
                            <h5>Products Table</h5>
                        </div>
                        <div class='widget-content nopadding'>
                            <!-- Search Form -->
                            <?php
                            // Get the search term from POST or GET
                            $search_term = '';
                            if (isset($_POST['search_products'])) {
                                $search_term = htmlspecialchars($_POST['search_products']);
                            } elseif (isset($_GET['search'])) {
                                $search_term = htmlspecialchars($_GET['search']);
                            }
                            ?>
                            <form action="" role="search" method="POST">
                                <div id="search" class="p-3">
                                    <input type="text" placeholder="Search Here.." name="search_products"
                                        value="<?php echo $search_term; ?>" />
                                    <button type="submit" class="tip-bottom" name="search_submit" title="Search">
                                        <i class="fas fa-search fa-white"></i>
                                    </button>
                                </div>
                            </form>

                            <?php
                            include "dbcon.php";

                            // Number of records to show per page
                            $records_per_page = 10;

                            // Get current page number
                            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($current_page - 1) * $records_per_page;

                            // Initialize variables
                            $search_query = '';
                            $where_clause = '';

                            // Check if a search has been submitted
                            if (isset($_POST['search_submit']) && !empty($_POST['search_products'])) {
                                // Sanitize the search input
                                $search_query = $con->real_escape_string(trim($_POST['search_products']));
                                // Store search in GET for pagination
                                $search_param = "&search=" . urlencode($search_query);
                            } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
                                // Get search from URL for pagination
                                $search_query = $con->real_escape_string(trim($_GET['search']));
                                $search_param = "&search=" . urlencode($search_query);
                            } else {
                                $search_param = "";
                            }

                            // Build the WHERE clause if the search query is not empty
                            if (!empty($search_query)) {
                                $where_clause = "WHERE p.name LIKE '%$search_query%' OR c.name LIKE '%$search_query%'";
                            }

                            // Count total records for pagination
                            $count_query = "SELECT COUNT(*) as total FROM products p 
                                JOIN product_categories c ON p.category_id = c.id 
                                $where_clause";

                            $count_result = $con->query($count_query);
                            $total_records = $count_result->fetch_assoc()['total'];

                            $total_pages = ceil($total_records / $records_per_page);

                            // Main query with pagination
                            $query = "SELECT p.id, p.name AS product_name, p.price, c.name AS category_name, 
                                            p.status, p.quantity, p.description, p.image
                                     FROM products p
                                     JOIN product_categories c ON p.category_id = c.id
                                     $where_clause
                                     LIMIT $offset, $records_per_page";

                            $result = $con->query($query);

                            if ($result->num_rows > 0) {
                                echo "<table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";

                                $cnt = $offset + 1;
                                while ($product = $result->fetch_assoc()) {
                                    // Truncate product name only if it's longer than 70 characters
                                    $product_name = $product['product_name'];
                                    if (strlen($product_name) > 70) {
                                        $product_name = substr($product_name, 0, 70) . '...';
                                    }

                                    // Set status badge with correct class
                                    if ($product['status'] == 1) {
                                        $status_badge = "<p class='badge badge-success text-center'>ACTIVE</p>";
                                    } else {
                                        $status_badge = "<p class='badge badge-warning text-center'>INACTIVE</p>";
                                    }

                                    echo "<tr>
                                        <td><div class='text-center'> GMPX00" . $cnt . "</div></td>
                                        <td><div class='text-center'>";
                                    if ($product['image']) {
                                        echo "<img src='uploads/products/" . $product['image'] . "' alt='Product Image' style='width: 50px; height: 50px;'>";
                                    } else {
                                        echo "No Image";
                                    }
                                    echo "</div></td>
                                        <td><div class='text-center'>" . $product_name . "</div></td>
                                        <td><div class='text-center'>Rs." . $product['price'] . "</div></td>
                                        <td><div class='text-center'>" . $product['category_name'] . "</div></td>
                                        <td><div class='text-center'>" . $product['quantity'] . "</div></td>
                                        <td><div class='text-center'>" . $status_badge . "</div></td>
                                        <td><div class='text-center'>
                                        <a href='edit-product.php?id=" . $product['id'] . "' class='text-success'><i class='fas fa-edit'></i></a>
                                        |
                                            <a href='actions/delete-product.php?id=" . $product['id'] . "' style='color:#F66;'><i class='fa fa-trash' aria-hidden='true'></i> </a>
                                        </div></td>
                                    </tr>";
                                    $cnt++;
                                }

                                echo "</tbody></table>";

                                // Pagination links with search parameter
                                echo "<div class='pagination pagination-centered'>
                                    <ul>";

                                // Previous page link
                                if ($current_page > 1) {
                                    echo "<li><a href='?page=" . ($current_page - 1) . $search_param . "'>Prev</a></li>";
                                }

                                // Page numbers
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $current_page) {
                                        echo "<li class='active'><a href='#'>$i</a></li>";
                                    } else {
                                        echo "<li><a href='?page=$i" . $search_param . "'>$i</a></li>";
                                    }
                                }

                                // Next page link
                                if ($current_page < $total_pages) {
                                    echo "<li><a href='?page=" . ($current_page + 1) . $search_param . "'>Next</a></li>";
                                }

                                echo "</ul></div>";
                            } else {
                                echo "<p class='text-center'>No products found" . ($search_query ? " for '$search_query'" : "") . ".</p>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
</body>

</html>