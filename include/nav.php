<?php session_start(); ?>
<header role="banner">
  <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000;">
    <div class="container">
      <a class="navbar-brand fw-bold text-light" href="http://localhost/gymphp/index.php" style="font-size: 1.5rem;">
        GYM<span style="color: #ff0066;">FITNESS</span>
      </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto pl-lg-5 pl-0">
          <li class="nav-item">
            <a class="nav-link active" href="http://localhost/gymphp/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/about.php">About
              <?php //echo $_SESSION['user_id']; 
              ?>

            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/blog.php">Blogs</a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/services.php">Services</a>
          </li> -->

          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/gallery.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/plan.php">Plan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/schedules.php">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/appoinment.php">Appoinment</a>
          </li>
          


          <?php
          // error_reporting(0);
          // session_start();
          if (isset($_SESSION['auth_user'])) {
          ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo substr($_SESSION['auth_user']['email'], 0, 5), '..' ?><i class="fa-solid fa-user"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <?php

                $con = mysqli_connect("localhost", "root", "", "gymnsb");
                // Check connection
                if (!$con) {
                  // throw new Exception("Connection failed: " . mysqli_connect_error());
                  echo "<script>console.error('Database connection failed. Please try again later.');</script>";
                }
                $user_id = $_SESSION['auth_user']['user_id'];
                $sql = "SELECT * FROM users WHERE id = '$user_id'";
                $result = mysqli_query($con, $sql);
                $user = $result->fetch_assoc();

                if ($user['role'] == 'normal_user') {
                ?>
                  <a class="dropdown-item" href="http://localhost/gymphp/users/users.php"><i class="fa-solid fa-user"></i> Profile</a>

                <?php
                } else {

                ?>
                  <a class="dropdown-item" href="http://localhost/gymphp/users/profile.php"><i class="fa-solid fa-user"></i>Member Profile</a>

                <?php } ?>
                <a class="dropdown-item" href="http://localhost/gymphp/my_orders.php"><i class="fa-solid fa-truck-fast"></i> My Order</a>
                <a class="dropdown-item" href="http://localhost/gymphp/my_membership.php"><i class="fa-solid fa-spa"></i> My Membership</a>
                <a class="dropdown-item" href="http://localhost/gymphp/personal.php"><i class="fa-solid fa-landmark"></i> Payments</a>
                <a class="dropdown-item" href="http://localhost/gymphp/users/Announcements.php"><i class="fa-solid fa-bell"></i> Announcements</a>
                <a class="dropdown-item" href="http://localhost/gymphp/users/chatbot.php"><i class="fa-solid fa-comment"></i> ChatSupport</a>

              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/gymphp/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/gymphp/cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="badge badge-pill badge-danger">
                  <?php
                  if (isset($_SESSION['auth_user'])) {
                    // Replace the direct connection with a proper connection handling

                    $con = mysqli_connect("localhost", "root", "", "gymnsb");
                    // Check connection
                    if (!$con) {
                      // throw new Exception("Connection failed: " . mysqli_connect_error());
                      echo "<script>console.error('Database connection failed. Please try again later.');</script>";
                    }



                    // Rest of your cart counting code
                    if (isset($_SESSION['auth_user'])) {
                      $user_id = $_SESSION['auth_user']['user_id'];
                      $query = "SELECT SUM(product_qty) AS total_items FROM carts WHERE user_id = ?";
                      $stmt = mysqli_prepare($con, $query);
                      mysqli_stmt_bind_param($stmt, "i", $user_id);
                      mysqli_stmt_execute($stmt);
                      $result = mysqli_stmt_get_result($stmt);
                      $data = mysqli_fetch_assoc($result);
                      $cart_count = $data['total_items'] ?? '0';
                      echo $cart_count;
                    }
                  ?>
                    <script src="js/jquery-3.2.1.min.js"></script>
                    <script>
                      function updateCartCount() {
                        $.ajax({
                          url: 'include/cart_counting.php',
                          method: 'POST',
                          data: {
                            scope: 'cart_count'
                          },
                          dataType: 'json',
                          success: function(response) {
                            $('.badge-danger').text(response.cart_count);
                          },
                          error: function(xhr, status, error) {
                            console.error("Error fetching cart count:", error);
                          }

                        });
                      }

                      // Initial count on page load
                      $(document).ready(function() {
                        updateCartCount();
                      });

                      // Update count every 5 seconds
                      setInterval(updateCartCount, 2000);
                    </script>
                  <?php }
                  ?>
                </span>
              </a>
            </li>

          <?php
          } else {
          ?>
<li class="nav-item">
            <a class="nav-link" href="http://localhost/gymphp/photos.php">Gallery</a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/gymphp/cart.php">
                <i class="fa-solid fa-cart-shopping"></i></a>
            </li>
            
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item cta-btn">
            <a class="nav-link" href="login.php">Login<i class="fa-solid fa-lock"></i></a>
          </li>
        </ul>


      <?php
          }
      ?>

      <!-- </li> -->












      </div>
    </div>
  </nav>

</header>
<!-- END header -->