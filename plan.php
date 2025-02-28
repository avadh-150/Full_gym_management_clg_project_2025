<?php include "include/header.php"; ?>
<link rel="stylesheet" href="css/plan.css">

</head>

<body>
  <!-- Include Navigation -->
  <?php include "include/nav.php"; ?>

  <!-- Hero Section -->
  <section class="home-slider-loop-false inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/slider-1.jpg');">
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-8 text-center col-sm-12 element-animate">
            <h1 class="text-white font-weight-bold">Our Membership Plans</h1>
            <!-- <p class="lead text-light">Choose the best plan that suits your fitness goals.</p> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Plans Section -->
  <section class="section-plan py-5">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-md-12">
          <h2 class="section-title">Find the Perfect Plan for You</h2>
          <p class="text-muted">Flexible membership options to meet your fitness needs.</p>
        </div>
      </div>
      <div class="row">
        <?php
        $con = mysqli_connect("localhost", "root", "", "gymnsb");

        $sql = "SELECT * FROM membership_plans";
        $results = mysqli_query($con, $sql);

        if (mysqli_num_rows($results) > 0) {
          while ($result = mysqli_fetch_assoc($results)) {
        ?>
            <div class="col-md-4 mb-4" >
              <div class="card plan-card shadow-sm border-0 rounded-lg" style="background-image: url('img/1.jpg');">
                <div class="card-header bg-dark text-white text-center py-3">
                  <h4 class="plan-title mb-0"><?php echo $result['plan_name']; ?></h4>
                </div>
                <div class="card-body text-center">
                  <h3 class="plan-price text-primary font-weight-bold">₹<?php echo $result['price']; ?></h3>
                  <h4 class="plan-duration text-grey font-italic"><?php echo $result['duration']; ?> days</h4>
                  <hr color="white">
                  <ul class="plan-features list-unstyled">
                    <li><?php echo html_entity_decode(substr($result['features'],0,158)).'...'; ?></li>
                    <!-- <li><?php //echo html_entity_decode(substr($result['features'],0,115)).'...'; ?></li> -->
                  </ul>
                  <?php if (isset($_SESSION['auth_user'])) { ?>
    <form method="post" action="plan_view.php">
        <input type="hidden" name="pid" value="<?php echo $result['id']; ?>">
        <button type="submit" name="book_now" class="btn btn-primary btn-block font-weight-bold" 
        onclick="return confirm('Do you really want to book this package?');">Book Plan Now</button>
    </form>
<?php } else { ?>
    <a href="login.php" class="btn btn-secondary btn-block font-weight-bold" 
    onclick="return alert('Authentication is required. Please login first.');">Book Plan Now</a>
<?php } ?>
                </div>
              </div>
            </div>
        <?php
          }
        } else {
          echo "<div class='col-12 text-center'><p class='text-muted'>No plans available at the moment.</p></div>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Include Footer -->
  <?php include "include/footer.php"; ?>

</body>

</html>
