<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <style>
        .pagination-container {
            margin: 20px 0;
        }

        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }

        .pagination li {
            display: inline;
        }

        .pagination li a,
        .pagination li span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .pagination li.active a {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
        }

        .pagination li.disabled span {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <?php include 'includes/topheader.php'; ?>
    <?php $page = "orders";
    include 'includes/sidebar.php'; ?>
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="current">Orders List <i class="fa-solid fa-truck-fast"></i></a>
            </div>
            <!-- <h1 class="text-center">Orders List </h1> -->
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class='widget-box'>
                        <div class='widget-title'>
                            <span class='icon'> <i class='fas fa-th'></i> </span>
                            <h5 id='datatable2'>Orders Table</h5>
                        </div>
                        <div class='widget-content nopadding'>
                            <?php
                            // Add pagination logic
                            $records_per_page = 6;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $records_per_page;

                            // First, get total records for pagination
                            $count_query = "SELECT COUNT(DISTINCT o.tracking_id) as total FROM orders o";
                            $count_result = $con->query($count_query);
                            $total_records = $count_result->fetch_assoc()['total'];
                            $total_pages = ceil($total_records / $records_per_page);

                            // Modify your existing query to include LIMIT and OFFSET
                            $query = "SELECT o.tracking_id, 
                                      COALESCE(oi.product_id, 'N/A') AS product_id, 
                                      COALESCE(p.name, 'N/A') AS name, 
                                      COALESCE(oi.qty, 0) AS qty, 
                                      o.id AS id, 
                                      o.name AS cname, 
                                      o.phone AS cphone, 
                                      o.address AS caddress, 
                                      o.pincode AS cpincode, 
                                      o.create_at, 
                                      o.status, 
                                      o.delivery, 
                                      COALESCE(oi.price, 0) AS price, 
                                      u.name AS username 
                               FROM orders o 
                               LEFT JOIN order_items oi ON oi.order_id = o.id 
                               LEFT JOIN products p ON oi.product_id = p.id 
                               LEFT JOIN users u ON u.id = o.user_id 
                               ORDER BY o.tracking_id DESC
                               LIMIT $records_per_page OFFSET $offset";

                            $result = $con->query($query);

                            $orders = [];
                            while ($row = $result->fetch_assoc()) {
                                if (!isset($orders[$row['tracking_id']])) {
                                    $orders[$row['tracking_id']] = [
                                        'products' => [],
                                        'total_price' => 0,
                                        'create_at' => $row['create_at'],
                                        'status' => $row['status'],
                                        'delivery' => $row['delivery'],
                                        'cname' => $row['cname'],
                                        'id' => $row['id'],
                                        'cphone' => $row['cphone'],
                                        'caddress' => $row['caddress'],
                                        'cpincode' => $row['cpincode'],
                                        'username' => $row['username']
                                    ];
                                }
                                $orders[$row['tracking_id']]['products'][] = "<b>Product No:</b> {$row['product_id']}<br><b>Name:</b> " . substr($row['name'], 0, 30) . "...<br><b>Qty:</b> {$row['qty']}";
                                $orders[$row['tracking_id']]['total_price'] += $row['price'] * $row['qty'];
                                $orders[$row['tracking_id']]['total_qty'] = isset($orders[$row['tracking_id']]['total_qty']) ?
                                    $orders[$row['tracking_id']]['total_qty'] + $row['qty'] : $row['qty'];
                            }

                            if (!empty($orders)) {
                                echo "<table class='table table-bordered table-hover table-striped'>
                                        <thead>
                                            <tr>
                                                <th width='50px'>Order Tracking No</th>
                                                <th width='40px'>User Name</th>
                                                <th width='200px'>Product Details</th>
                                                <th width='70px'>Total Amount</th>
                                                <th width='200px'>Customer Details</th>
                                                <th width='120px'>Order Date</th>
                                                <th width='90px'>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";

                                foreach ($orders as $tracking_id => $order) {
                                    echo "<tr>
                                            <td class='text-center'>$tracking_id</td>
                                            <td class='text-center'>{$order['username']}</td>
                                            <td>" . implode('<hr>', $order['products']) . "</td>
                                            <td class='text-center'>Rs. {$order['total_price']}</td>
                                            <td>
                                            <b>Name: </b>{$order['cname']}<br>
                                            <b>Phone: </b>{$order['cphone']}<br>
                                            <b>Address: </b>{$order['caddress']}. 
                                            <br>{$order['cpincode']}<br>
                                            </td>
                                            <td class='text-center'>{$order['create_at']}</td>
                                            <td class='text-center'>";
                                    switch ($order['status']) {
                                        case 0:
                                            echo "<span class='label label-danger' style='background:#ffc107;'>Pending</span>";
                                            break;
                                        case 1:
                                            echo "<span class='label label-success' style='background:#28a745;'>Paid</span>";
                                            break;
                                    }
                                    echo "</td><td class='text-center'>";

                                    switch ($order['delivery']) {
                                        case '1':
                                            echo "<span>Delivered</span>";
                                            break;
                                        default:
                                            echo '<a class="btn btn-sm btn-primary order_complete" href="php_files/orders.php?complete=' . $order['id'] . '">Complete</a>';
                                    }
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";

                                // Add pagination controls after the table
                                echo "<div class='pagination-container' style='text-align: center; margin-top: 20px;'>";
                                echo "<ul class='pagination'>";
                                
                                // Previous button
                                $prev = $page - 1;
                                echo "<li class='" . ($page == 1 ? 'disabled' : '') . "'>";
                                if ($page > 1) {
                                    echo "<a href='?page=$prev'>&laquo; Previous</a>";
                                } else {
                                    echo "<span>&laquo; Previous</span>";
                                }
                                echo "</li>";

                                // Page numbers
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    echo "<li class='" . ($page == $i ? 'active' : '') . "'>";
                                    echo "<a href='?page=$i'>$i</a>";
                                    echo "</li>";
                                }

                                // Next button
                                $next = $page + 1;
                                echo "<li class='" . ($page == $total_pages ? 'disabled' : '') . "'>";
                                if ($page < $total_pages) {
                                    echo "<a href='?page=$next'>Next &raquo;</a>";
                                } else {
                                    echo "<span>Next &raquo;</span>";
                                }
                                echo "</li>";
                                
                                echo "</ul>";
                                echo "</div>";
                            } else {
                                echo "<p class='text-center'>No orders found.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>