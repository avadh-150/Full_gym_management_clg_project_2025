<?php
include "../dbcon.php";

if (isset($_GET['complete'])) {
    $order_id = intval($_GET['complete']); // Prevent SQL injection

    // Update order status to '1' (Delivered)
    $query = "UPDATE orders SET delivery = 1 WHERE id = $order_id";
    $result = mysqli_query($con, $query);

    if (mysqli_affected_rows($con) > 0) {
        echo "<script>
                alert('Order marked as complete successfully');
                window.location.href = '../orders.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating order status or already completed');
                window.location.href = '../orders.php';
              </script>";
    }
}
?>
