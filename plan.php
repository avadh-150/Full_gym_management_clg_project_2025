<?php include "include/header.php"; ?>
<link rel="stylesheet" href="css/plan.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <!-- Include Navigation -->
  <?php include "include/nav.php"; ?>

  <!-- Hero Section -->
  <section class="membership-hero" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/slider-1.jpg') no-repeat center center/cover; padding: 120px 0;">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="text-white font-weight-bold mb-4 display-4 animate__animated animate__fadeInUp">Premium Membership Plans</h1>
          <p class="lead text-white animate__animated animate__fadeInUp animate__delay-1s">Invest in your health with our flexible membership options</p>
          <div class="mt-4 animate__animated animate__fadeInUp animate__delay-2s">
            <a href="#plans" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">View Plans <i class="fas fa-arrow-right ml-2"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Benefits Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="p-4">
            <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
            <h4>State-of-the-art Equipment</h4>
            <p class="text-muted">Access to premium fitness equipment and facilities</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="p-4">
            <i class="fas fa-users fa-3x text-primary mb-3"></i>
            <h4>Expert Trainers</h4>
            <p class="text-muted">Guidance from certified fitness professionals</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="p-4">
            <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
            <h4>Flexible Scheduling</h4>
            <p class="text-muted">Workout on your terms with extended hours</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Plans Section -->
  <section id="plans" class="section-plan py-5">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-md-12">
          <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">MEMBERSHIP OPTIONS</span>
          <h2 class="section-title display-4 mb-3">Choose Your Fitness Journey</h2>
          <p class="text-muted lead mx-auto" style="max-width: 700px;">Select the plan that aligns with your fitness goals and lifestyle. All memberships include access to our core facilities.</p>
        </div>
      </div>

      <div class="row">
        <?php
        $con = mysqli_connect("localhost", "root", "", "gymnsb");

        $sql = "SELECT * FROM membership_plans";
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
    </div>
  </section>

  <!-- Testimonials Section -->
  <!-- <section class="py-5 bg-light">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-md-12">
          <h2 class="section-title">What Our Members Say</h2>
          <p class="text-muted">Real results from real people</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <img src="img/testimonial-1.jpg" alt="Member" class="rounded-circle mr-3" width="60" height="60">
                <div>
                  <h5 class="mb-0">Rahul Sharma</h5>
                  <small class="text-muted">Premium Member</small>
                </div>
              </div>
              <p class="mb-0"><i class="fas fa-quote-left text-primary mr-2 opacity-50"></i> Joining this gym was the best decision I made for my health. The trainers are exceptional and the facilities are top-notch.</p>
              <div class="mt-3 text-warning">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <img src="img/testimonial-2.jpg" alt="Member" class="rounded-circle mr-3" width="60" height="60">
                <div>
                  <h5 class="mb-0">Priya Patel</h5>
                  <small class="text-muted">Gold Member</small>
                </div>
              </div>
              <p class="mb-0"><i class="fas fa-quote-left text-primary mr-2 opacity-50"></i> I've tried many gyms before, but the community and support here is unmatched. I've achieved results I never thought possible.</p>
              <div class="mt-3 text-warning">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <img src="img/testimonial-3.jpg" alt="Member" class="rounded-circle mr-3" width="60" height="60">
                <div>
                  <h5 class="mb-0">Amit Kumar</h5>
                  <small class="text-muted">Platinum Member</small>
                </div>
              </div>
              <p class="mb-0"><i class="fas fa-quote-left text-primary mr-2 opacity-50"></i> The flexible membership options fit perfectly with my busy schedule. I can work out whenever I want and the facilities are always clean.</p>
              <div class="mt-3 text-warning">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- FAQ Section -->
  <section class="py-5">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-md-12">
          <h2 class="section-title">Frequently Asked Questions</h2>
          <p class="text-muted">Everything you need to know about our memberships</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="accordion" id="faqAccordion">
            <div class="card mb-3 border-0 shadow-sm">
              <div class="card-header bg-white" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left text-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-plus-circle text-primary mr-2"></i> Can I cancel my membership at any time?
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                <div class="card-body">
                  Yes, you can cancel your membership at any time. However, refunds are subject to our refund policy which is based on the remaining duration of your membership.
                </div>
              </div>
            </div>
            <div class="card mb-3 border-0 shadow-sm">
              <div class="card-header bg-white" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left text-dark font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-plus-circle text-primary mr-2"></i> Are personal training sessions included?
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                <div class="card-body">
                  Basic memberships do not include personal training sessions. However, our Gold and Platinum plans include complimentary sessions. Additional sessions can be purchased separately.
                </div>
              </div>
            </div>
            <div class="card mb-3 border-0 shadow-sm">
              <div class="card-header bg-white" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left text-dark font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i class="fas fa-plus-circle text-primary mr-2"></i> What are your gym hours?
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                <div class="card-body">
                  Our gym is open Monday through Friday from 5:00 AM to 11:00 PM, and weekends from 7:00 AM to 9:00 PM. Platinum members enjoy 24/7 access.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="py-5 text-white" style="background: linear-gradient(135deg, #0062cc, #0097ff);">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 mb-4 mb-lg-0">
          <h2 class="font-weight-bold mb-3">Ready to start your fitness journey?</h2>
          <p class="lead mb-0">Join today and get your first week free with any membership plan.</p>
        </div>
        <div class="col-lg-4 text-lg-right">
          <a href="#plans" class="btn btn-light btn-lg px-5 py-3 rounded-pill font-weight-bold">Choose a Plan <i class="fas fa-arrow-right ml-2"></i></a>
        </div>
      </div>
    </div>
  </section>

  <!-- Include Footer -->
  <?php include "include/footer.php"; ?>

  <!-- Custom JS for animations -->
  <script>
    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    
    // Add hover effect to plan cards
    document.querySelectorAll('.hover-scale').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px)';
        this.style.transition = 'transform 0.3s ease';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
  </script>
</body>
</html>

