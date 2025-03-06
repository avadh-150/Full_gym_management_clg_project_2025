<?php
// Include database connection file
session_start();
include 'connection.php'; // Update this with your actual connection file
error_reporting(0);
// Initialize success and error messages
$success = "";
$error = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : NULL;
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO contact (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if (mysqli_query($con, $sql)) {
        $success = "Your message has been submitted successfully. We will get back to you soon.";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alertify.success('$success');
            });
        </script>";
    } else {
        $error = "There was an error submitting your message. Please try again later.";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alertify.error('$error');
            });
        </script>";
    }
}
?>

<?php include "include/header.php";?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    
    <!-- Custom CSS -->
    
    <style>
        :root {
            --primary-color: #ff5722;
            --secondary-color: #212529;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
       
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/pic-19.jpg');
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .contact-section {
            padding: 80px 0;
            background-color: #f9f9f9;
        }
        
        .contact-info-box {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .contact-info-box:hover {
            transform: translateY(-5px);
        }
        
        .contact-info-box h4 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .contact-info-box h4:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .contact-info-item {
            display: flex;
            margin-bottom: 20px;
            align-items: flex-start;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .contact-text h5 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .contact-text p {
            margin: 0;
            color: #666;
        }
        
        .social-links {
            display: flex;
            margin-top: 30px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        
        .contact-form-box {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .contact-form-box h4 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .contact-form-box h4:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .form-group label {
            font-weight: 500;
            color: #555;
        }
        
        .form-control {
            height: 50px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }
        
        textarea.form-control {
            height: 150px;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }
        
        .btn-submit {
            background: var(--primary-color);
            color: white;
            border: none;
            height: 50px;
            border-radius: 5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            background: #e64a19;
            transform: translateY(-3px);
        }
        
        .opening-hours {
            margin-top: 30px;
        }
        
        .hours-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }
        
        .hours-item:last-child {
            border-bottom: none;
        }
        
        .hours-day {
            font-weight: 600;
        }
        
        .hours-time {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .contact-section {
                padding: 50px 0;
            }
            
            .contact-form-box, .contact-info-box {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Include Navigation -->
    <?php include "include/nav.php"; ?>
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="text-white">CONTACT US</h1>
                <p>Get in touch with our team for any inquiries or to start your fitness journey today</p>
            </div>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="contact-info-box">
                        <h4>Contact Information</h4>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Our Location</h5>
                                <p>02-second floor, Shyamdham Chock, Surat</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Phone Number</h5>
                                <p>+91 7567992211</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Email Address</h5>
                                <p>khushianghan@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="opening-hours">
                            <h5>Opening Hours</h5>
                            <div class="hours-item">
                                <span class="hours-day">Monday - Friday</span>
                                <span class="hours-time">6:00 AM - 10:00 PM</span>
                            </div>
                            <div class="hours-item">
                                <span class="hours-day">Saturday</span>
                                <span class="hours-time">7:00 AM - 9:00 PM</span>
                            </div>
                            <div class="hours-item">
                                <span class="hours-day">Sunday</span>
                                <span class="hours-time">8:00 AM - 6:00 PM</span>
                            </div>
                        </div>
                        
                       
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3156.536755862631!2d72.8244059752011!3d21.17024019200609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be041f479c6e0d7%3A0x51fcb647b12686f8!2sShyamdham%20Chowk%2C%20Surat!5e0!3m2!1sen!2sin!4v1696454093922!5m2!1sen!2sin" 
                                width="100%" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form-box">
                        <h4>Send Us a Message</h4>
                        <p class="mb-4">Have questions about our programs or membership options? Fill out the form below and our team will get back to you as soon as possible.</p>
                        
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php elseif (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                            </div>
                            
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-submit btn-block">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Include Footer -->
    <?php include "include/footer.php"; ?>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>
</html>