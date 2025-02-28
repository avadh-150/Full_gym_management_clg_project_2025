<?php
session_start();
include '../admin/dbcon.php';
ob_clean();
header('Content-Type: application/json');

$response = ['cart_count' => 0];

if (isset($_POST['scope']) && $_POST['scope'] == "cart_count") {
    if (isset($_SESSION['auth_user']['user_id'])) {
        $user_id = intval($_SESSION['auth_user']['user_id']);
        $query = "SELECT SUM(product_qty) AS total_items FROM carts WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
            $response['cart_count'] = intval($data['total_items']);
        }
    }
}

echo json_encode($response);
exit;
?>
