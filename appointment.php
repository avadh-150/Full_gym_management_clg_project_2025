<?php
session_start();
include 'connection.php'; // Update with your actual connection file
error_reporting(0);
require_once 'configuration.php';

if (!isset($_GET['id'])) {
    header("Location: schedules.php");
  
}

?>

<?php include "include/header.php"; ?>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-color: #ff5722;
        --primary-dark: #e64a19;
        --primary-light: #ffccbc;
        --secondary-color: #2c3e50;
        --accent-color: #4CAF50;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        --gray-color: #6c757d;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --body-bg: #ffffff;
        --text-color: #333333;
        --border-color: #dee2e6;
        --border-radius: 8px;
        --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: var(--text-color);
        background-color: var(--body-bg);
        overflow-x: hidden;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/pic-15.jpg');
        background-size: cover;
        background-position: center;
        min-height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .hero-content p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 20px auto 0;

    }

    /*--------------------------------------------------------------
# Trainers Sections
--------------------------------------------------------------*/
    .trainers-preview {
        padding: 80px 0;
    }

    .trainer-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
    }

    .trainer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .trainer-image {
        position: relative;
        overflow: hidden;
    }

    .trainer-image img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: var(--transition);
    }

    .trainer-card:hover .trainer-image img {
        transform: scale(1.05);
    }

    .trainer-info {
        padding: 25px;
    }

    .trainer-info h3 {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .trainer-specialization {
        color: var(--primary-color);
        font-weight: 500;
        margin-bottom: 15px;
    }

    .trainer-bio {
        color: var(--gray-color);
        margin-bottom: 20px;
    }

    /* Trainers Page Styles */
    .trainers-section {
        padding: 80px 0;
    }

    .trainer-filters {
        margin-bottom: 40px;
    }

    .filter-container {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 15px 20px;
        box-shadow: var(--box-shadow);
    }

    .filter-label {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .filter-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-btn {
        background-color: #f1f1f1;
        border: none;
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-btn:hover,
    .filter-btn.active {
        background-color: var(--primary-color);
        color: white;
    }

    .trainer-card-full {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        margin-bottom: 30px;
    }

    .trainer-card-full:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .trainer-rating {
        margin-bottom: 10px;
    }

    .trainer-rating .fa-star {
        color: var(--warning-color);
        margin-right: 2px;
    }

    .rating-count {
        font-size: 0.9rem;
        color: var(--gray-color);
        margin-left: 5px;
    }

    .trainer-experience {
        font-size: 0.9rem;
        color: var(--gray-color);
        margin-bottom: 15px;
    }

    .trainer-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .join-team-section {
        padding: 80px 0;
        background-color: #f9f9f9;
    }

    .join-benefits {
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }

    .join-benefits li {
        margin-bottom: 10px;
    }

    .join-benefits li i {
        color: var(--accent-color);
        margin-right: 10px;
    }


    /*--------------------------------------------------------------
# Call to Action Section
--------------------------------------------------------------*/
    .cta-section {
        padding: 60px 0;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
    }

    .cta-section h2 {
        color: white;
        font-size: 2.2rem;
        margin-bottom: 10px;
    }

    .cta-section p {
        opacity: 0.9;
        margin-bottom: 0;
    }



    /*--------------------------------------------------------------
# Appointment Section
--------------------------------------------------------------*/
    .appointment-section {
        padding: 80px 0;
        background-color: #f9f9f9;
    }

    .appointment-form-container {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 40px;
        box-shadow: var(--box-shadow);
    }

    .appointment-progress {
        display: flex;
        justify-content: space-between;
        margin-bottom: 40px;
        position: relative;
    }

    .appointment-progress:before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }

    .progress-step {
        position: relative;
        z-index: 2;
        text-align: center;
        width: 33.333%;
    }

    .step-number {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: var(--gray-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin: 0 auto 10px;
        transition: var(--transition);
    }

    .step-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--gray-color);
        transition: var(--transition);
    }

    .progress-step.active .step-number {
        background-color: var(--primary-color);
        color: white;
    }

    .progress-step.active .step-label {
        color: var(--primary-color);
        font-weight: 600;
    }

    .progress-step.completed .step-number {
        background-color: var(--accent-color);
        color: white;
    }

    .form-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .form-step.active {
        display: block;
    }

    .form-step h2 {
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 30px;
        text-align: center;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .trainer-selection {
        margin-bottom: 30px;
    }

    .trainer-select-card {
        position: relative;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        cursor: pointer;
        height: 100%;
    }

    .trainer-select-card:hover {
        transform: translateY(-5px);
    }

    .trainer-radio {
        position: absolute;
        opacity: 0;
    }

    .trainer-label {
        display: block;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .trainer-card-img {
        height: 180px;
        overflow: hidden;
    }

    .trainer-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .trainer-card-info {
        padding: 15px;
        background-color: white;
    }

    .trainer-card-info h4 {
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .trainer-select-card.selected {
        border: 2px solid var(--primary-color);
    }

    .trainer-select-card.selected:after {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--primary-color);
        color: white;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }

    .booking-summary {
        background-color: #f8f9fa;
        border-radius: var(--border-radius);
        padding: 25px;
        margin-bottom: 30px;
    }

    .booking-summary h3 {
        margin-bottom: 20px;
        font-size: 1.3rem;
    }

    .summary-details {
        margin-bottom: 20px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-label {
        font-weight: 500;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        font-size: 1.1rem;
        padding-top: 10px;
        border-top: 2px solid #dee2e6;
    }

    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-method-item {
        position: relative;
    }

    .payment-method-label {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #dee2e6;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
    }

    .payment-method-label:hover {
        background-color: #f8f9fa;
    }

    input[name="payment_method"]:checked+.payment-method-label {
        border-color: var(--primary-color);
        background-color: rgba(255, 87, 34, 0.05);
    }

    .payment-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-right: 15px;
        width: 40px;
        text-align: center;
    }

    .payment-info h4 {
        margin-bottom: 0;
        font-size: 1.1rem;
    }

    .payment-info p {
        margin-bottom: 0;
        font-size: 0.9rem;
        color: var(--gray-color);
    }

    .appointment-sidebar {
        position: sticky;
        top: 100px;
    }

    .sidebar-widget {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--box-shadow);
        margin-bottom: 30px;
    }

    .sidebar-widget h3 {
        margin-bottom: 20px;
        font-size: 1.3rem;
        position: relative;
        padding-bottom: 10px;
    }

    .sidebar-widget h3:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
    }

    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .benefits-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }

    .benefits-list li i {
        color: var(--accent-color);
        margin-right: 10px;
    }

    .sidebar-testimonial {
        background-color: #f8f9fa;
        border-radius: var(--border-radius);
        padding: 20px;
    }

    .contact-info {
        margin-top: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .contact-item i {
        color: var(--primary-color);
        margin-right: 10px;
        width: 20px;
    }

    @media (max-width: 991px) {
        .hero-main {
            padding: 80px 0;
        }

        .hero-text-container {
            padding-right: 0;
            margin-bottom: 40px;
        }

        .appointment-sidebar {
            margin-top: 40px;
            position: static;
        }

        .footer-bottom-links {
            justify-content: flex-start;
            margin-top: 10px;
        }
    }

    @media (max-width: 767px) {
        .section-header h2 {
            font-size: 2rem;
        }

        .hero-main h1 {
            font-size: 2.5rem;
        }

        .page-hero h1 {
            font-size: 2.5rem;
        }

        .appointment-progress {
            flex-direction: column;
            gap: 20px;
        }

        .appointment-progress:before {
            display: none;
        }

        .progress-step {
            width: 100%;
            display: flex;
            align-items: center;
        }

        .step-number {
            margin: 0 15px 0 0;
        }

        .trainer-actions {
            flex-direction: column;
        }

        .payment-methods {
            gap: 10px;
        }
    }

    @media (max-width: 575px) {
        .hero-buttons {
            flex-direction: column;
        }

        .appointment-form-container {
            padding: 20px;
        }

        .form-navigation {
            flex-direction: column;
            gap: 10px;
        }

        .form-navigation button {
            width: 100%;
        }
    }
</style>
</head>

<body>
    <!-- Navigation -->
    <?php include "include/nav.php"; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Book Your Appointment</h1>
                <p>Schedule your fitness journey with ease—choose your time, share your goals, and get started today.</p>
            </div>
        </div>
    </section>

    <!-- Appointment Section -->
    <?php

    // Database connection configuration
    $host = "localhost";
    $username = "root"; // Change to your database username
    $password = ""; // Change to your database password
    $database = "gymnsb";

    // Create connection
    $con = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

 
     ?>
    <!-- Appointment Section -->
    <section class="appointment-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="appointment-form-container">
                        <!-- Steps Sections -->
                        <div class="appointment-progress">
                            <div class="progress-step" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-label">Select Trainer & Time</div>
                            </div>
                            <div class="progress-step" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-label">Your Details</div>
                            </div>
                            <div class="progress-step" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-label">Confirm & Pay</div>
                            </div>
                        </div>

                        <form id="appointmentForm" method="POST">
                            <!-- Step 1: Trainer, Date and Time -->
                            <div class="form-step active" id="step1">
                                <h2>Choose Your Trainer & Schedule</h2>

                                <div class="row mt-4">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Select Your Trainer:</label>
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $id = $_GET['id'];
                                                $appoint = "SELECT s.*,t.*,t.id as tid,s.schedule_id as app_id FROM schedule s, trainers t WHERE s.trainer_id = t.id AND schedule_id=$id";
                                                $result = $con->query($appoint);
                                                $row = $result->fetch_assoc();
                                            }
                                            else{
                                                header("Location: schedule.php");
                                            }

                                            ?>

                                            <select class="form-control" style="height: 50px;" name="trainer" id="trainerDropdown" required>
                                                <option value="" selected disabled>--SELECT TRAINER--</option>

                                                <option value="<?php echo $row['tid']; ?>" data-image="uploads/trainers/<?php echo $row['image']; ?>">
                                                    <?php echo $row['name'] . '(' . $row['specialization'] . ')'; ?>
                                                </option>


                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointment_date">Select Date:</label>
                                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointment_time">Time:</label>
                                            <input type="time" class="form-control" id="appointment_time" value="<?php echo $row['start_time'];?>" name="appointment_time" required>
                                        </div>
                                    </div>
                                </div>
                                <?php

                                // $sql = "select * from schedule";

                                // $result = mysqli_query($con, $sql);


                                ?>
                                <div class="form-group mt-3">
                                    <label for="session_type">Session Type:</label>
                                    <select class="form-control" id="session_type" name="session_type" style="height: 50px;" required>

                                        <option value="<?php echo $row['schedule_name']; ?>"><?php echo $row['schedule_name'] ?></option>

                                    </select>
                                </div>
                                <?php
                                // session_start();
                                if (isset($_SESSION['auth_user'])) {
                                ?>
                                    <div class="form-navigation text-end mt-4">
                                        <button type="button" class="btn btn-primary next-step">Continue <i class="fas fa-arrow-right"></i></button>
                                    </div>

                                <?php
                                } else {
                                ?>

                                    <div class="form-navigation text-end mt-4">
                                        <a href="login.php" type="button" class="btn btn-primary">Continue Login <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <!-- Step 2: Personal Details -->
                            <div class="form-step" id="step2">
                                <h2>Your Personal Details</h2>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullname">Full Name:</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Address:</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact">Phone Number:</label>
                                            <input type="tel" class="form-control" id="contact" name="contact" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="age">Age:</label>
                                            <input type="number" class="form-control" id="age" name="age" min="16" max="99" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="fitness_level">Current Fitness Level:</label>
                                    <select class="form-control" id="fitness_level" style="height: 50px;" name="fitness_level" required>
                                        <option value="">Select your fitness level</option>
                                        <option value="beginner">Beginner - New to fitness</option>
                                        <option value="intermediate">Intermediate - Exercise occasionally</option>
                                        <option value="advanced">Advanced - Regular fitness routine</option>
                                        <option value="athlete">Athlete - Competitive training</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="fitness_goals">Your Fitness Goals:</label>
                                    <textarea class="form-control" id="fitness_goals" name="fitness_goals" rows="3" placeholder="Please describe your fitness goals and any specific areas you'd like to focus on"></textarea>
                                </div>

                                <div class="form-navigation d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary prev-step"><i class="fas fa-arrow-left"></i> Back</button>
                                    <button type="button" class="btn btn-primary next-step">Continue <i class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>

                            <!-- Step 3: Payment -->
                            <div class="form-step" id="step3">
                                <h2>Confirm & Payment</h2>

                                <div class="booking-summary">
                                    <h3>Booking Summary</h3>
                                    <div class="summary-details">
                                        <div class="summary-item">
                                            <span class="summary-label">Trainer:</span>
                                            <span class="summary-value" id="summary-trainer">Not selected</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Date & Time:</span>
                                            <span class="summary-value" id="summary-datetime">Not selected</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Session Type:</span>
                                            <span class="summary-value" id="summary-session">Not selected</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Client Name:</span>
                                            <span class="summary-value" id="summary-name">Not provided</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Contact:</span>
                                            <span class="summary-value" id="summary-contact">Not provided</span>
                                        </div>
                                    </div>
                                    <div class="summary-total">
                                        <span class="total-label">Total Amount:</span>
                                        <span class="total-value" id="summary-price" name="price">₹<?php echo $row['price']?></span>
                                        <input type="hidden" class="total-value" id="price" name="price" value="<?php echo $row['price']?>"></in>
                                    </div>
                                </div>

                                <div class="payment-options mt-4">
                                    <h3>Payment Method</h3>
                                    <p>Please select your preferred payment method:</p>

                                    <div class="payment-methods">
                                        <div class="payment-method-item">
                                            <input type="radio" name="payment_method" id="credit_card" value="credit_card" checked required>
                                            <label for="credit_card" class="payment-method-label">
                                                <div class="payment-icon">
                                                    <i class="far fa-credit-card"></i>
                                                </div>
                                                <div class="payment-info">
                                                    <h4 class='credit'>Credit Card</h4>
                                                    <p>Pay securely with your credit card</p>
                                                </div>
                                            </label>
                                        </div>
                                        
                                        <div class="payment-method-item">
                                            <input type="radio" name="payment_method" id="pay_later" value="pay_at_gym" required>
                                            <label for="pay_later" class="payment-method-label">
                                                <div class="payment-icon">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </div>
                                                <div class="payment-info">
                                                    <h4 class="pay_gym">Pay at Gym</h4>
                                                    <p>Pay when you arrive for your session</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Payment Button -->
                                    <!-- <button id="paymentButton" class="payment-button" style="display: block;">Proceed to Payment</button> -->
                                </div>

                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="terms_agree" name="terms_agree" required>
                                    <label class="form-check-label" for="terms_agree">
                                        I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
                                    </label>
                                </div>

                                <div class="form-navigation d-flex justify-content-between mt-4">

                                    <button type="button" class="btn btn-outline-secondary prev-step"><i class="fas fa-arrow-left"></i> Back</button>
                                    <button type="submit" class="btn btn-success" name="submit">Confirm Booking <i class="fas fa-check"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="appointment-sidebar">
                        <div class="sidebar-widget why-book">
                            <h3>Why Book With Us</h3>
                            <ul class="benefits-list">
                                <li><i class="fas fa-check-circle"></i> Certified professional trainers</li>
                                <li><i class="fas fa-check-circle"></i> Personalized fitness programs</li>
                                <li><i class="fas fa-check-circle"></i> State-of-the-art facilities</li>
                                <li><i class="fas fa-check-circle"></i> Flexible scheduling options</li>
                                <li><i class="fas fa-check-circle"></i> Free initial consultation</li>
                            </ul>
                        </div>



                        <div class="sidebar-widget contact-widget">
                            <h3>Need Help?</h3>
                            <p>Our team is here to assist you with your booking</p>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>(123) 456-7890</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>bookings@fitpro.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Booking Terms</h4>
                    <p>By booking a session with FitPro, you agree to the following terms:</p>
                    <ul>
                        <li>Cancellations must be made at least 24 hours in advance to avoid charges.</li>
                        <li>Late arrivals may result in shortened sessions without refund.</li>
                        <li>Payment is required to confirm your booking unless "Pay at Gym" option is selected.</li>
                        <li>FitPro reserves the right to assign a different trainer in case of unavailability.</li>
                    </ul>

                    <h4>Health Disclaimer</h4>
                    <p>Clients are responsible for disclosing all relevant health information. FitPro is not liable for injuries resulting from undisclosed health conditions.</p>

                    <h4>Refund Policy</h4>
                    <p>Full refunds are available for cancellations made 24 hours in advance. No refunds for no-shows or late cancellations.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Information Collection</h4>
                    <p>We collect personal information including name, contact details, and health information to provide our services effectively.</p>

                    <h4>Use of Information</h4>
                    <p>Your information is used to:</p>
                    <ul>
                        <li>Process and manage your bookings</li>
                        <li>Communicate regarding your appointments</li>
                        <li>Provide personalized training services</li>
                        <li>Improve our services</li>
                    </ul>

                    <h4>Data Protection</h4>
                    <p>We implement appropriate security measures to protect your personal information from unauthorized access or disclosure.</p>

                    <h4>Third-Party Sharing</h4>
                    <p>We do not sell or share your personal information with third parties except as required to provide our services or comply with legal obligations.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action -->
    <section class="cta-section text-white py-5" style="background: linear-gradient(135deg, #0062cc, #0097ff);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="font-weight-bold mb-3">Ready to Start Your Fitness Journey?</h2>
                    <p class="lead mb-0">Join our community and transform your life today.</p>
                </div>
                <div class="col-lg-4 text-lg-right">
                    <a href="plan.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                        Get Started <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "include/footer.php"; ?>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const creditCardRadio = document.getElementById('credit_card');
        //     const payLaterRadio = document.getElementById('pay_later');
        //     const paymentButton = document.getElementById('paymentButton');

        //     // Initially, the credit card is selected, so the button is visible
        //     paymentButton.style.display = 'block';

        //     // Add event listeners to the radio buttons
        //     creditCardRadio.addEventListener('change', function() {
        //         if (this.checked) {
        //             paymentButton.style.display = 'block'; // Show the payment button
        //         }
        //     });

        //     payLaterRadio.addEventListener('change', function() {
        //         if (this.checked) {
        //             paymentButton.style.display = 'none'; // Hide the payment button
        //         }
        //     });
        // });

        $(document).ready(function() {
            // Get DOM elements
            const $form = $('#appointmentForm');
            const $steps = $('.form-step');
            const $nextButtons = $('.next-step');
            const $prevButtons = $('.prev-step');
            const $progressSteps = $('.progress-step');
            let currentStep = 1;

            // Handle next button clicks
            $nextButtons.on('click', function() {
                if (validateCurrentStep()) {
                    moveToStep(currentStep + 1);
                    if (currentStep === 3) updateSummary();
                }
            });

            // Handle previous button clicks
            $prevButtons.on('click', function() {
                moveToStep(currentStep - 1);
            });

            // Move to specific step
            function moveToStep(step) {
                $steps.eq(currentStep - 1).removeClass('active');
                $steps.eq(step - 1).addClass('active');
                updateProgress(step);
                currentStep = step;
                $('html, body').animate({
                    scrollTop: $form.offset().top - 100
                }, 500);
            }

            // Update progress indicators 
            function updateProgress(step) {
                $progressSteps.each(function(idx) {
                    if (idx + 1 < step) {
                        $(this).addClass('completed').removeClass('active');
                    } else if (idx + 1 === step) {
                        $(this).addClass('active').removeClass('completed');
                    } else {
                        $(this).removeClass('completed active');
                    }
                });
            }


            // Validate current step
            function validateCurrentStep() {
                if (currentStep === 1) {
                    const trainer = $('#trainerDropdown').val();
                    const date = $('#appointment_date').val();
                    const time = $('#appointment_time').val();
                    const session = $('#session_type').val();

                    // Validate required fields before making the AJAX request
                    if (!trainer || !date || !time || !session) {
                        alert('Please fill in all fields');
                        return false;
                    }

                    // alert(trainer + ' ' + date + ' ' + time + ' ' + session);
                    // AJAX call to check availability
                    return $.ajax({
                        url: 'check_availability.php',
                        type: 'POST',
                        data: {
                            trainer,
                            date,
                            time,
                            session
                        },
                        dataType: 'text',
                        success: function(response) {
                            if (response.trim() === 'Available') {
                                alertify.confirm('Confirm Booking', 'Are you sure you want to book this session?', function(e) {
                                    moveToStep(2);
                                    console.log(response);
                                });
                            } else {
                                moveToStep(1);
                                alertify.alert('Booking Unavailable', 'This slot is not available.');
                                console.log(response);
                                return false;
                            }
                        },
                        error: function() {
                            alertify.alert('Error', 'An error occurred while checking availability.');
                            return false;
                        }
                    });
                }
                return true;
            }


            // Update booking summary
            function updateSummary() {


                const $trainer = $('#trainerDropdown');
                const date = new Date($('#appointment_date').val());
                const time = $('#appointment_time').val();
                const $session = $('#session_type');
                const name = $('#fullname').val();
                const email = $('#email').val();
                const contact = $('#contact').val();
                const level = $('#fitness_level').val();
                const goal = $('#fitness_goals').val();
                const age = $('#age').val();

                if (!name || !email || !contact || !level || !goal || !age) {
                    alert('Please fill in all fields');
                    moveToStep(2);
                    return false;
                } else if (contact.length !== 10) {
                    alert('Please enter a valid 10-digit contact number.');
                    moveToStep(2);
                    return false;
                } else if (age <= 19 || age >= 70) {
                    alert('You are not eligible for this service.only eligible for age greater than 19 and less than 70..');
                    moveToStep(2);
                    return false;
                }


                $('#summary-trainer').text($trainer.find('option:selected').text());
                $('#summary-datetime').text(`${date.toDateString()} at ${formatTime(time)}`);
                $('#summary-session').text($session.find('option:selected').text());
                $('#summary-name').text(name);
                $('#summary-contact').text(`${email} / ${contact}`);


                // Format time to 12-hour format
                function formatTime(time) {
                    const [hours, minutes] = time.split(':');
                    const period = hours >= 12 ? 'PM' : 'AM';
                    const hour12 = hours % 12 || 12;
                    return `${hour12}:${minutes} ${period}`;
                }

            }

            // Handle form submission
            $form.on('submit', function(e) {
                e.preventDefault();
                //     let pay_leter=$('#pay_later').val();
                //     if(pay_leter == 'pay_at_gym')
                // {

                // }
                const $trainer = $('#trainerDropdown');
                const date = new Date($('#appointment_date').val());
                const time = $('#appointment_time').val();
                const $session = $('#session_type');
                const name = $('#fullname').val();
                const email = $('#email').val();
                const contact = $('#contact').val();
                const level = $('#fitness_level').val();
                const goal = $('#fitness_goals').val();
                const price = $('#price').val();
                
                if (!$('#terms_agree').is(':checked')) {
                    alert('Please agree to the terms and conditions');
                    return;
                }
                if (!name || !email || !contact || !level || !goal) {
                    alert('Please fill in all fields');
                    moveToStep(2);
                    return false;
                } else if (contact.length !== 10) {
                    alert('Please enter a valid 10-digit contact number.');
                    moveToStep(2);
                    return false;
                } else if (age <= 19 || age >= 65) {
                    alert('You are not eligible for this service.');
                    moveToStep(2);
                    return false;
                }
                const trainer = $('#trainerDropdown').val();
                const formData = new FormData(this);
                const $submitBtn = $(this).find('button[type="submit"]');
                $submitBtn.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Processing...');

                $.ajax({
                    url: 'process_appointment.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alertify.success('Appointment booked Process initiated!');
                            $form[0].reset();
                            moveToStep(1);
                            setTimeout(() => {
                                window.location.href = 'booking-confirmation.php';
                            }, 2000);
                        } else {
                            alertify.error('Error booking appointment: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alertify.error('Error: ' + error);
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false)
                            .html('Confirm Booking <i class="fas fa-check"></i>');
                    }
                });
            });
        });

        // Add new trainer selection handler using jQuery
        // $('#trainerDropdown').on('change', function() {
        //     const trainerId = $(this).val();
        //     const $sessionTypeSelect = $('#session_type');

        //     // Clear existing options
        //     $sessionTypeSelect.html('<option value="">Loading sessions...</option>');

        //     // Fetch trainer schedule
        //     $.ajax({
        //         url: 'get_trainer_schedule.php',
        //         method: 'POST',
        //         data: {
        //             trainer_id: trainerId
        //         },
        //         dataType: 'json',
        //         success: function(data) {
        //             $sessionTypeSelect.empty(); // Clear loading message

        //             if (data.length > 0) {
        //                 $.each(data, function(i, schedule) {
        //                     $sessionTypeSelect.append(
        //                         $('<option>', {
        //                             value: schedule.schedule_name,
        //                             text: schedule.schedule_name,
        //                             'data-time': schedule.time
        //                         })
        //                     );
        //                 });

        //                 // Set initial time if available
        //                 if (data[0].time) {
        //                     $('#appointment_time').val(data[0].time);
        //                 }
        //             } else {
        //                 $sessionTypeSelect.html('<option value="">No sessions available</option>');
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error:', error);
        //             $sessionTypeSelect.html('<option value="">Error loading sessions</option>');
        //         }
        //     });
        // });

        // Update time when session type changes
        $('#session_type').on('change', function() {
            const selectedTime = $('option:selected', this).data('time');
            if (selectedTime) {
                $('#appointment_time').val(selectedTime);
            }
        });
    </script>
</body>

</html>