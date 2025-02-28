<?php
session_start();
include "../admin/dbcon.php";

if (isset($_SESSION['auth_user']['user_id'])) {
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $pro_id = $_POST['pro_id'];
                $pro_qty = $_POST['pro_qty'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $sql = "select * from carts where product_id = $pro_id and user_id = $user_id";
                $result1 = mysqli_query($con, $sql);
                if (mysqli_num_rows($result1) > 0) {
                    echo "Product is already added to cart";
                } else {
                    $add = "INSERT INTO carts (product_id, product_qty, user_id) VALUES ('$pro_id', '$pro_qty', '$user_id')";
                    $result = mysqli_query($con, $add);

                    if ($result) {
                        echo "Product added successfully to cart";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                }
                break;

            case "update":
                $pro_id = $_POST['pro_id'];
                $pro_qty = $_POST['pro_qty'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $sql = "select * from carts where product_id = $pro_id and user_id = $user_id";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $update = "UPDATE carts SET product_qty=$pro_qty where product_id = $pro_id AND user_id = $user_id";
                    $result2 = mysqli_query($con, $update);
                    if ($result2) {
                        echo "Product Quantity Updated successfully ";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                break;


            case "delete":
                $c_id = $_POST['cid'];
                $user_id = $_SESSION['auth_user']['user_id'];
                $sql = "select * from carts where id = $c_id and user_id = $user_id";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $delete = "DELETE FROM carts WHERE id = $c_id";
                    $result2 = mysqli_query($con, $delete);
                    if ($result2) {
                        echo "Product deleted successfully ";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                break;
                default:
                    echo "Something went wrong, it's in default";
                        }
    } else {
        echo "Something went wrong"; // Scope not found
    }
} else {
    echo "Login to continue"; // User not logged in
}
