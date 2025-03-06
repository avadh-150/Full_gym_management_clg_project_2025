<?php include "include/header.php";
session_start();
error_reporting(0);
?>
<link rel="stylesheet" href="css/style1.css">
<style>


</style>

<body>
  <?php include "include/nav.php";

  ?>

  <!-- END header -->


  <section class="home-slider owl-carousel">
    <?php
    include "admin/dbcon.php";
    $sql = "SELECT * FROM gym_images limit 4";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
      foreach ($result as $row) {


    ?>
        <div class="slider-item" style="background-image: url('<?= $row["image_path"] ?>');">

          <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
              <div class="col-md-8 text-center col-sm-12 element-animate">
                <h1>welcome to FITNESS CLUB</h1>
                <p class="mb-5">your journey to a healthier, stronger, and more confident you starts here.</p>
                <p><a href="about.php" class="btn btn-white btn-outline-white">learn more..</a></p>
              </div>
            </div>
          </div>

        </div>
    <?php }
    } ?>
  </section>
  <!-- END slider -->


  
<!-- About section  -->
  <!-- Main Content Section -->
   <br>
  <section id="about-content" class="about-section py-5">
    <div class="trainer-showcase__header">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="trainer-showcase__title">Empowering Your Fitness Journey</h2>
              <span class="trainer-showcase__subtitle">About US</span>
            </div>
          </div>
        </div>
      </div>
    <div class="container">
      <!-- History Section -->
      <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="video-wrapper position-relative rounded-lg overflow-hidden">
            <video autoplay loop muted class="w-100">
              <source src="video/v2.mp4" type="video/mp4">
            </video>
            <div class="video-overlay">
              <button class="play-btn" onclick="toggleVideo(this)">
                <i class="fas fa-play"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="content-wrapper">
            <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">OUR HISTORY</span>
            <h2 class="section-title mb-4">A Legacy of Excellence in Fitness</h2>
            <p class="lead mb-4">Today, our Fitness program has become one of the largest and fastest-growing franchisors and operators of fitness centers in the United States by number of members and locations.</p>
            <p class="text-muted">With more than 2,600 locations in 50 states, the District of Columbia, Puerto Rico, Canada, Panama, Mexico and Australia, Planet Fitness has continued to spread its unique mission of enhancing people's lives by providing an affordable, high-quality fitness experience in a welcoming, non-intimidating environment.</p>
            <div class="mt-4">
              <a href="about.php" class="btn btn-outline-primary rounded-pill">Learn More About</a>
            </div>
          </div>
        </div>
      </div>
</div>
</section>

<!-- 
  <section class="section element-animate">

    <div class="clearfix mb-5 pb-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center heading-wrap">
            <h2>Featured services Classes</h2>
            <span class="back-text">The Classes</span>
          </div>
        </div>
      </div>
    </div>

    <div class="owl-carousel centernonloop">
      <a href="yoga.php" class="item-class">
        <div class="text">
          <p class="class-price">2000 </p>
          <h2 class="class-heading">Glam yoga</h2>
        </div>
        <img src="img/yoga.jpg" alt="" class="img-fluid">
      </a>
      <a href="nutrition.php" class="item-class">
        <div class="text">
          <p class="class-price">2500</p>
          <h2 class="class-heading">nutrition coaching</h2>
        </div>
        <img src="img/hiit.jpg" alt="" class="img-fluid">
      </a>
      <a href="personal.php" class="item-class">
        <div class="text">
          <p class="class-price">1800</p>
          <h2 class="class-heading">personal training</h2>
        </div>
        <img src="img/cardio.jpg" alt="" class="img-fluid">
      </a>
      <a href="#" class="item-class">
        <div class="text">
          <p class="class-price">1500</p>
          <h2 class="class-heading">gracefull zumba</h2>
        </div>
        <img src="img/zumba.jpg" alt="" class="img-fluid">
      </a>
    </div>
  </section>

 -->


  <!-- Trainer Scroll section -->
  <section class="trainer-showcase">
    <div class="trainer-showcase__header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="trainer-showcase__title">Expert Trainers</h2>
            <span class="trainer-showcase__subtitle">Our Professionals</span>
          </div>
        </div>
      </div>
    </div>

    <div class="trainer-showcase__container">
      <div class="trainer-carousel">
        <div class="trainer-carousel__track">
          <?php
          include "admin/dbcon.php";
          $sql = "SELECT * FROM trainers";
          $result = mysqli_query($con, $sql);
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
          ?>
              <div class="trainer-card">
                <div class="trainer-card__image-wrapper">
                  <a href="trainers/profile.php?id=<?php echo $row["id"] ?>" class="trainer-card__link">
                    <img src="admin/uploads/trainers/<?php echo $row["image"] ?>" alt="<?php echo $row["name"] ?>" class="trainer-card__image">
                  </a>
                </div>
                <div class="trainer-card__content">
                  <h3 class="trainer-card__name"><?php echo $row["name"] ?></h3>
                  <p class="trainer-card__specialization">Instructor for: <?php echo $row["specialization"] ?></p>
                  <div class="trainer-card__social">
                    <a href="https://www.facebook.com" class="trainer-card__social-link"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.x.com" class="trainer-card__social-link"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com" class="trainer-card__social-link"><i class="fa fa-instagram"></i></a>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Clone the trainer cards for infinite scrolling effect
      const track = document.querySelector('.trainer-carousel__track');
      const cards = document.querySelectorAll('.trainer-card');

      // Only proceed if we have cards
      if (cards.length > 0) {
        // Clone each card and append to the track
        cards.forEach(card => {
          const clone = card.cloneNode(true);
          track.appendChild(clone);
        });
      }
    });
  </script>



  <?php

  include "connection.php";
  $sql = "SELECT * FROM gym_images";
  $result = $con->query($sql);


  ?>
  <!-- Gallery Section -->
  <section class="fitness-gallery">

    <div class="trainer-showcase__header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="trainer-showcase__title">Fitness Gallery</h2>
            <span class="trainer-showcase__subtitle">Take a visual tour of our premium gym facilities, equipment, and training spaces</span>
          </div>
        </div>
      </div>
    </div>


    <!-- Gallery Carousel -->
    <div class="fitness-gallery__showcase">
      <!-- Loading Spinner -->
      <div class="fitness-gallery__loading">
        <i class="fas fa-spinner fa-pulse"></i>
      </div>

      <!-- Gallery Carousel Track -->
      <div class="fitness-gallery__track" id="galleryTrack" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <?php
        if ($result && $result->num_rows > 0) {
          $i = 0;
          while ($row = $result->fetch_assoc()) {
            $i++;
            $caption = "Gym Image " . $i;
        ?>
            <div class="fitness-gallery__item" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="<?php echo ($i * 50); ?>">
              <a href="<?php echo htmlspecialchars($row['image_path']); ?>" class="fitness-gallery__lightbox">
                <div class="fitness-gallery__image-container">
                  <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['image_path'] ?? 'Gym Image'); ?>" loading="lazy" class="fitness-gallery__image">
                </div>
                <div class="fitness-gallery__overlay">
                  <i class="fas fa-search-plus fitness-gallery__icon"></i>
                </div>

              </a>
            </div>
        <?php
          }
        } else {
          echo '<div class="fitness-gallery__empty">
                        <h3>No images found</h3>
                        <p>Check back soon for our updated gallery.</p>
                    </div>';
        }
        // $stmt->close();
        ?>
      </div>

      <!-- Gallery Controls -->
      <div class="fitness-gallery__controls">
        <a href="photos.php" class="fitness-gallery__more-btn">View Full Gallery</a>
      </div>
    </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Clone gallery items for infinite scrolling effect
      const track = document.getElementById('galleryTrack');
      const items = document.querySelectorAll('.fitness-gallery__item');

      // Only proceed if we have items
      if (items.length > 0) {
        // Clone each item and append to the track
        items.forEach(item => {
          const clone = item.cloneNode(true);
          track.appendChild(clone);
        });
      }

      // Hide loading spinner when images are loaded
      const images = document.querySelectorAll('.fitness-gallery__image');
      let loadedImages = 0;

      function checkAllImagesLoaded() {
        loadedImages++;
        if (loadedImages >= images.length) {
          document.querySelector('.fitness-gallery__loading').style.display = 'none';
        }
      }

      images.forEach(img => {
        if (img.complete) {
          checkAllImagesLoaded();
        } else {
          img.addEventListener('load', checkAllImagesLoaded);
          img.addEventListener('error', checkAllImagesLoaded);
        }
      });
    });
  </script>






  <!-- Schedule of Gym -->
  <?php


  // Fetch schedules along with assigned trainers
  $query = "
    SELECT s.*,t.*
    FROM schedule s
    LEFT JOIN trainers t ON s.trainer_id = t.id
    ";
  $result = mysqli_query($con, $query);

  if (!$result) {
    die("Query failed: " . mysqli_error($con));
  }

  // Group schedules by day for better organization
  $schedulesByDay = [];
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $day = $row['schedule_day']; // Get day name (e.g., Monday)
      if (!isset($schedulesByDay[$day])) {
        $schedulesByDay[$day] = [];
      }
      $schedulesByDay[$day][] = $row;
    }
  }

  // Get unique days of the week with schedules
  $days = array_keys($schedulesByDay);

  ?>

  <section class="schedule-section py-5">
    <div class="trainer-showcase__header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="trainer-showcase__title">Find Your Perfect Class</h2>
            <span class="trainer-showcase__subtitle">WEEKLY SCHEDULE</span>
            <p class="text-muted lead mx-auto" style="max-width: 700px;">Our diverse schedule offers classes for all fitness levels. Click on any trainer to view their full profile.</p>
          </div>
        </div>



        <!-- Schedule Tabs -->
        <div class="schedule-tabs">
          <ul class="nav nav-pills mb-4 justify-content-center" id="scheduleTabs" role="tablist">
            <?php foreach ($days as $index => $day): ?>
              <li class="nav-item" role="presentation">
                <button class="nav-link <?= $index === 0 ? 'active' : '' ?>"
                  id="<?= strtolower($day) ?>-tab"
                  data-toggle="pill"
                  data-target="#<?= strtolower($day) ?>"
                  type="button"
                  role="tab"
                  aria-controls="<?= strtolower($day) ?>"
                  aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                  <?= $day ?>
                </button>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="tab-content" id="scheduleTabContent">
            <?php foreach ($days as $index => $day): ?>
              <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                id="<?= strtolower($day) ?>"
                role="tabpanel"
                aria-labelledby="<?= strtolower($day) ?>-tab">

                <div class="schedule-timeline">
                  <?php foreach ($schedulesByDay[$day] as $schedule):
                    $start_time = $schedule['start_time'];
                    $end_time = $schedule['end_time'];
                    $trainer_name = !empty($schedule['name']) ? $schedule['name'] : 'Unassigned';
                    $trainer_img = !empty($schedule['image']) ? 'admin/uploads/trainers/' . $schedule['image'] : 'img/default-avatar.png';
                    $specialization = !empty($schedule['specialization']) ? $schedule['specialization'] : 'General Fitness';
                  ?>
                    <div class="schedule-item">
                      <div class="schedule-time">
                        <span class="time">Schedule</span>
                      </div>
                      <div class="schedule-content">
                        <div class="class-info">
                          <h4><?= $schedule['schedule_name'] ?></h4>
                          <div class="class-meta">
                            <span><i class="far fa-clock"></i> <?= $start_time ?> - <?= $end_time ?></span>
                            <span class="class-type"><?= $specialization ?></span>
                          </div>
                        </div>
                        <div class="trainer-info">
                          <?php if (!empty($schedule['id'])): ?>
                            <a href="http://localhost/gymphp/trainers/profile.php?id=<?= $schedule['id'] ?>" class="trainer-link">
                              <div class="trainer-avatar">
                                <img src="<?= $trainer_img ?>" alt="<?= $trainer_name ?>">
                              </div>
                              <div class="trainer-details">
                                <h5><?= $trainer_name ?></h5>
                                <span class="trainer-role"><?= $specialization ?></span>
                              </div>
                            </a>
                          <?php else: ?>
                            <div class="trainer-avatar">
                              <img src="<?= $trainer_img ?>" alt="Unassigned">
                            </div>
                            <div class="trainer-details">
                              <h5>Unassigned</h5>
                              <span class="trainer-role">To be announced</span>
                            </div>
                          <?php endif; ?>
                        </div>
                        <div class="class-info ">

                          <a href="" class="join_btn btn btn-grey">Join Now</a>

                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
  </section>


  <!-- Plan of MembersShip -->
  <!-- Plans Section -->
  <section id="plans" class="section-plan py-5">
    <div class="trainer-showcase__header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="trainer-showcase__title">Invest in your health with our flexible membership options</h2>
            <span class="trainer-showcase__subtitle">Premium Membership Plans</span>
            <p class="text-muted lead mx-auto" style="max-width: 700px;">Our diverse schedule offers classes for all fitness levels. Click on any trainer to view their full profile.</p>
          </div>
        </div>

        <div class="row">
          <?php
          $con = mysqli_connect("localhost", "root", "", "gymnsb");

          $sql = "SELECT * FROM membership_plans limit 3";
          $results = mysqli_query($con, $sql);

          if (mysqli_num_rows($results) > 0) {
            while ($result = mysqli_fetch_assoc($results)) {
              // Convert features to array for better display
              $features_text = html_entity_decode($result['features']);
              $features_array = explode("\n", $features_text);
          ?>
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card plan-card h-100 border-0 shadow-lg rounded-lg overflow-hidden transition-transform hover-scale">
                  <div class="card-header text-center p-4" style="background: linear-gradient(135deg, #0062cc, #0097ff);">
                    <h3 class="plan-title text-white mb-0"><?php echo $result['plan_name']; ?></h3>
                  </div>
                  <div class="card-body text-center p-4">
                    <div class="pricing-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; border-radius: 50%; background-color: rgba(0, 123, 255, 0.1);">
                      <div>
                        <span class="currency">₹</span>
                        <span class="price display-4 font-weight-bold"><?php echo $result['price']; ?></span>
                        <div class="period text-muted"><?php echo $result['duration']; ?> days</div>
                      </div>
                    </div>

                    <div class="features-list my-4">
                      <ul class="list-unstyled">
                        <?php
                        // Display first 5 features or less if there are fewer
                        $max_features = min(count($features_array), 5);
                        for ($i = 0; $i < $max_features; $i++) {
                          $feature = trim($features_array[$i]);
                          if (!empty($feature)) {
                            echo '<li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> ' . $feature . '</li>';
                          }
                        }

                        // If there are more features, add a "more" indicator
                        if (count($features_array) > 5) {
                          echo '<li class="text-muted font-italic">+ more benefits</li>';
                        }
                        ?>
                      </ul>
                    </div>

                    <?php if (isset($_SESSION['auth_user'])) { ?>
                      <form method="post" action="plan_view.php" class="mt-4">
                        <input type="hidden" name="pid" value="<?php echo $result['id']; ?>">
                        <button type="submit" name="book_now" class="btn btn-primary btn-lg btn-block rounded-pill py-3 font-weight-bold"
                          onclick="return confirm('Do you really want to book the <?php echo $result['plan_name']; ?> package?');">
                          <i class="fas fa-bolt mr-2"></i> Get Started Now
                        </button>
                      </form>
                    <?php } else { ?>
                      <a href="login.php" class="btn btn-outline-primary btn-lg btn-block rounded-pill py-3 font-weight-bold mt-4"
                        onclick="return alert('Authentication is required. Please login first.');">
                        <i class="fas fa-lock mr-2"></i> Login to Join
                      </a>
                    <?php } ?>
                  </div>
                  <div class="card-footer bg-light p-3 text-center">
                    <!-- <a href="#" class="text-primary" data-toggle="modal" data-target="#planDetails<?php echo $result['id']; ?>">
                    View full details <i class="fas fa-arrow-right ml-1"></i>
                  </a> -->
                  </div>
                </div>
              </div>

              <!-- Plan Details Modal -->
              <div class="modal fade" id="planDetails<?php echo $result['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(135deg, #0062cc, #0097ff);">
                      <h5 class="modal-title text-white"><?php echo $result['plan_name']; ?> - Full Details</h5>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="d-flex justify-content-between mb-4">
                        <div>
                          <h4 class="text-primary mb-0">₹<?php echo $result['price']; ?></h4>
                          <small class="text-muted"><?php echo $result['duration']; ?> days</small>
                        </div>
                        <div>
                          <span class="badge badge-success p-2">Most Popular</span>
                        </div>
                      </div>

                      <h5 class="border-bottom pb-2 mb-3">Plan Features</h5>
                      <ul class="list-unstyled">
                        <?php
                        foreach ($features_array as $feature) {
                          $feature = trim($feature);
                          if (!empty($feature)) {
                            echo '<li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> ' . $feature . '</li>';
                          }
                        }
                        ?>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <?php if (isset($_SESSION['auth_user'])) { ?>
                        <form method="post" action="plan_view.php">
                          <input type="hidden" name="pid" value="<?php echo $result['id']; ?>">
                          <button type="submit" name="book_now" class="btn btn-primary btn-block"
                            onclick="return confirm('Do you really want to book this package?');">Book This Plan</button>
                        </form>
                      <?php } else { ?>
                        <a href="login.php" class="btn btn-secondary btn-block"
                          onclick="return alert('Authentication is required. Please login first.');">Login to Book</a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          } else {
            echo "<div class='col-12 text-center'><div class='alert alert-info'><i class='fas fa-info-circle mr-2'></i> No plans available at the moment. Please check back later.</div></div>";
          }
          ?>
        </div>
        <div class="fitness-gallery__controls">
          <a href="plan.php" class="fitness-gallery__more-btn">View Plans</a>
        </div>
      </div>
  </section>




  <!-- Newsletter Section -->
  <section class="newsletter-section">
    <div class="container">
      <div class="newsletter-content">
        <h2>Subscribe to Our Newsletter</h2>
        <p>Get the latest fitness tips, workout plans, and exclusive offers directly to your inbox.</p>
        <form class="newsletter-form">
          <input type="email" placeholder="Your email address" required>
          <button type="submit" class="btn">Subscribe</button>
        </form>
      </div>
    </div>
  </section>

  <section class="section element-animate">

    <div class="clearfix mb-5 pb-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center heading-wrap">
            <h2>Testimonial</h2>
            <span class="back-text">Testimonial</span>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <blockquote class="testimonial">
            <p>&ldquo; the trainers here have helped me achive mt fitness goals faster than i ever thought possible &rdquo;</p>
            <div class="d-flex author">
              <img src="img/test-1.jpg" alt="" class="mr-4">
              <div class="author-info">
                <h4>fensi patel</h4>

              </div>
            </div>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote class="testimonial">
            <p>&ldquo; i love the community here. everyone is so supportive and motivating. &rdquo;</p>
            <div class="d-flex author">
              <img src="img/test-2.jpg" alt="" class="mr-4">
              <div class="author-info">
                <h4>payal parmar</h4>

              </div>
            </div>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote class="testimonial">
            <p>&ldquo; joining this club has transformed my fitness joutny. the trainers are amazing!. &rdquo;</p>
            <div class="d-flex author">
              <img src="img/person_3.jpg" alt="" class="mr-4">
              <div class="author-info">
                <h4>shweta goyani</h4>

              </div>
            </div>
          </blockquote>
        </div>
      </div>
    </div>
  </section> <!-- .section -->
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

  <?php include "include/footer.php" ?>
</body>

</html>