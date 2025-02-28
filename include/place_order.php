<head>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />

</head>
<script>
    alertify.set('notifier', 'position', 'top-right');
    <?php

    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');


        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    } ?>
</script>
<?php
session_start();
include "../admin/dbcon.php";


include "../configuration.php";
// Check if Stripe token exists
if (isset($_SESSION['auth_user'])) {

    // Collect all details
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $pin = mysqli_real_escape_string($con, $_POST['pincode']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($address) || empty($phone) || empty($pin)) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: ../checkout.php");
        exit();
    }



    $user_id = $_SESSION['auth_user']['user_id'];
    $cart_sql = "SELECT c.id as cid, c.product_id as product_id, c.product_qty, 
                            p.id as pid, p.name as name, p.image as image, p.price as price 
                     FROM carts c 
                     INNER JOIN products p ON c.product_id = p.id 
                     WHERE c.user_id='$user_id'";
    $cart_result = mysqli_query($con, $cart_sql);

    $grand_total = 0; // Initialize grand total
    $cart_items = [];

    while ($row = mysqli_fetch_assoc($cart_result)) {
        $subtotal = $row['price'] * $row['product_qty'];
        $grand_total += $subtotal;
        $cart_items[] = $row; // Store cart items in an array
    }


    if (isset($_POST['stripeToken'])) {
        $token = $_POST['stripeToken'];

        echo "<script>
        alert('Order is collected');
        </script>";
        try {
            // Process payment with Stripe
            $charge = \Stripe\Charge::create([
                "amount" => $grand_total,
                "currency" => "inr",
                "description" => "Place the Order",
                "source" => $token,
            ]);
            // Check if payment succeeded
            if ($charge->status === 'succeeded') {
                $txn_id = $charge->balance_transaction; // Stripe transaction ID
                $payment_status = '1'; // Payment success
                $amount_inr = $grand_total; // Convert to INR
                // $txn = $txn_id;

                if (!empty($cart_items)) {
                   
                    $tracking_id = mt_rand(100000000, 9999999999) . substr($phone, -2); // Use last 2 digits instead of first 2
                    $insert_order = "INSERT INTO orders (tracking_id, user_id, name, email,phone, address, pincode, total_price) 
                             VALUES ('$tracking_id', '$user_id', '$name', '$email','$phone' ,'$address', '$pin', '$grand_total')";

                    if (mysqli_query($con, $insert_order)) {
                        $order_id = mysqli_insert_id($con);

                        foreach ($cart_items as $product) {
                            $pro_id = $product['product_id'];
                            $qty = $product['product_qty'];
                            $product_price = $product['price'];

                            $order_items = "INSERT INTO order_items (order_id, product_id, qty, price) 
                                    VALUES ('$order_id', '$pro_id', '$qty', '$product_price')";
                            mysqli_query($con, $order_items);


                            // There is pending the qty update to decrease here write code of update qty of product
                            //     $qty_update="select * from products where id='$pro_id' limit 1";
                            //     $qty_update_query=mysqli_query($con, $qty_update);

                            //     $prodata=mysqli_fetch_assoc($qty_update_query);
                            //     $currect_qty=$prodata['quantity'];

                            //     $new_qty=$currect_qty- $prodata['quantity'];
                            //     $update_qty="UPDATE products SET quantity='$new_qty' WHERE id='$pro_id'";
                            //    $update_qty_query= mysqli_query($con, $update_qty);
                        }

                        echo "<script>
                alert('Payment is Initiated');
                </script>";
                        // payment process

                        $payment_date = date('Y-m-d H:i:s');
                        $payment_query = "INSERT INTO payments (amount,payment_date,payment_method,transaction_id, payment_status,payment_type,order_id,user_id) 
                VALUES ('$grand_total', '$payment_date','Visa Card','$txn_id', '$payment_status','product','$order_id','$user_id')";

                        $payment_result = mysqli_query($con, $payment_query);
                        if (mysqli_affected_rows($con) > 0) {
                            $payment_result = mysqli_query($con, "SELECT * FROM payments WHERE order_id='$order_id' LIMIT 1");

                            $pay_result = mysqli_fetch_assoc($payment_result);
                            if ($pay_result) {
                                $payment_id = $pay_result['id'];
                                $pay_status = $pay_result['payment_status'];
                                $payment_method = $pay_result['payment_method'];
                                $update_order = "UPDATE orders SET payment_id='$payment_id',status='$pay_status',payment_method='$payment_method' WHERE id = '$order_id'";
                                $update_pay_order = mysqli_query($con, $update_order);
                                if ($update_pay_order) {
                                    mysqli_query($con, "DELETE FROM carts WHERE user_id = '$user_id'");

                                    $_SESSION['message'] = "Order placed successfully!";
                                    header("Location: ../my_orders.php");
                                } else {
                                    $_SESSION['message'] = "Something went wrong!";
                                }
                            }
                        } else {
                            $_SESSION['message'] = "Something went wrong!";
                            echo "<script>
                alert('payment is not inserted');
                </script>";
                        }

                        // Clear cart after order placement
                    }
                } else {
                    echo "<script>
            alert('payment is not inserted');
            </script>";
                    $_SESSION['message'] = "Something went wrong!";
                    unset($_SESSION['message']);
                }
            } else {
                echo "<script>
        alert('payment failed');
        </script>";
                die("Payment failed.");
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "<script>
        alert('stripe error: " . $e->getMessage() . "');
        </script>";
            die("Stripe error: " . $e->getMessage());
        }
    } else {
        echo "<script>
        alert('stripe token is missing');
        </script>";
        die("Error: Stripe token is missing.");
    }
} else {
    echo "<script>
    alert('user is not logged in');
    </script>";
    header("Location: ../index.php");
    exit();
} ?>