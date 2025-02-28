<!doctype html>
<html lang="en">

<head>
  <title>FITNESS CLUB

</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <link rel="stylesheet" href="css/magnific-popup.css">


  <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

  <!-- Theme Style -->
  <link rel="stylesheet" href="css/style.css">

  
  <style>
    
    </style>

</head>
  <body>
    
  <?php include "include/nav.php"; ?>

    <section class="home-slider-loop-false inner-page owl-carousel">
      <div class="slider-item" style="background-image: url('img/pic-19.jpg');">
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-8 text-center col-sm-12 element-animate">
              <h1>Contact Us</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="contact-section">
      <div class="container">
        <div class="row">
          <!-- Left Side: Contact Details -->
          <div class="col-md-5">
            <div class="contact-details">
              <h4>Contact Details</h4>
              <p class="d-flex">
                <span class="ion-ios-location icon mr-3"></span>
                <span>02-second floor, Shyamdham Chock, Surat</span>
              </p>
              <p class="d-flex">
                <span class="ion-ios-telephone icon mr-3"></span>
                <span>+91 7567992211</span>
              </p>
              <p class="d-flex">
                <span class="ion-android-mail icon mr-3"></span>
                <span>khushianghan@gmail.com</span>
              </p>

              <div class="map-embed">
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

          <!-- Right Side: Contact Form -->
          <div class="col-md-7">
            <div class="contact-form">
              <h4 class="mb-4">Send Us a Message</h4>
              <?php if (!empty($success)): ?>
                  <div class="alert alert-success"><?php echo $success; ?></div>
              <?php elseif (!empty($error)): ?>
                  <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>

              <form method="POST" action="">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                  <label for="message">Message:</label>
                  <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include "include/footer.php"; ?>
  </body>
</html>

<?php
// Include database connection file
include 'connection.php'; // Update this with your actual connection file


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
        // Notify admin via email
        
            $success = "Your query has been submitted successfully. We will get back to you soon.";
            echo "<script>
            alert('$success');
            </script>";
        } else {
            $error = "Your query was submitted, but we couldn't notify the admin.";
        }
    } else {
        $error = "There was an error submitting your query. Please try again later.";
    }

?>
