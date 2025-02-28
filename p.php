<?php


if (isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];

    try {
        // Process payment with Stripe
        $charge = \Stripe\Charge::create([
            "amount" => 522255,
            "currency" => "inr",
            "description" => "Cruise Booking",
            "source" => $token,
        ]);
    
    echo "<pre>";
    print_r($charge);
    echo "</pre>";
    } catch (\Stripe\Exception\ApiErrorException $e) {
            die("Stripe error: " . $e->getMessage());
        }
    } else {
        die("Error: Stripe token is missing.");
    }
?>

