<?php error_reporting(0)?>
<?php include "include/header.php"; ?>
<link rel="stylesheet" href="css/about.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <?php include "include/nav.php"; ?>

  <!-- Hero Section -->
  <section class="about-hero" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/3.jpg') no-repeat center center/cover;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h1 class="display-4 text-white font-weight-bold mb-4 animate__animated animate__fadeInUp">Our Story</h1>
          <p class="lead text-white mb-4 animate__animated animate__fadeInUp animate__delay-1s">Building stronger bodies and minds since 2010</p>
          <a href="#about-content" class="btn btn-primary btn-lg rounded-pill px-5 py-3 animate__animated animate__fadeInUp animate__delay-2s">
            Learn More <i class="fas fa-arrow-down ml-2"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats-section py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <div class="stat-item">
            <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
            <h3 class="counter">2600</h3>
            <p>Locations</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <div class="stat-item">
            <i class="fas fa-users fa-3x text-primary mb-3"></i>
            <h3 class="counter">50K</h3>
            <p>Members</p>
          </div>
        </div>
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <div class="stat-item">
            <i class="fas fa-certificate fa-3x text-primary mb-3"></i>
            <h3 class="counter">100</h3>
            <p>Expert Trainers</p>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-item">
            <i class="fas fa-clock fa-3x text-primary mb-3"></i>
            <h3 class="counter">12</h3>
            <p>Years Experience</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content Section -->
  <section id="about-content" class="about-section py-5">
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
              <!-- <a href="#" class="btn btn-outline-primary rounded-pill">Learn More About Our Journey</a> -->
            </div>
          </div>
        </div>
      </div>

      <!-- Mission Section -->
      <div class="row align-items-center flex-lg-row-reverse">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="img/mission.jpg" alt="Our Mission" class="rounded-lg shadow-lg w-100">
        </div>
        <div class="col-lg-6">
          <div class="content-wrapper">
            <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">OUR MISSION</span>
            <h2 class="section-title mb-4">Empowering Your Fitness Journey</h2>
            <p class="lead mb-4">Our mission is to provide a welcoming and motivating environment where everyone, regardless of age or fitness level, can pursue a healthier lifestyle.</p>
            
            <div class="features-grid">
              <div class="feature-item">
                <div class="feature-icon">
                  <i class="fas fa-dumbbell text-primary"></i>
                </div>
                <div class="feature-content">
                  <h4>Modern Facilities</h4>
                  <p>State-of-the-art equipment and spacious workout areas</p>
                </div>
              </div>
              
              <div class="feature-item">
                <div class="feature-icon">
                  <i class="fas fa-certificate text-primary"></i>
                </div>
                <div class="feature-content">
                  <h4>Certified Trainers</h4>
                  <p>Expert guidance from professional fitness instructors</p>
                </div>
              </div>
              
              <div class="feature-item">
                <div class="feature-icon">
                  <i class="fas fa-heart text-primary"></i>
                </div>
                <div class="feature-content">
                  <h4>Comprehensive Programs</h4>
                  <p>Diverse range of fitness programs for all levels</p>
                </div>
              </div>
              
              <div class="feature-item">
                <div class="feature-icon">
                  <i class="fas fa-balance-scale text-primary"></i>
                </div>
                <div class="feature-content">
                  <h4>Holistic Approach</h4>
                  <p>Focus on overall well-being and balanced lifestyle</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Leadership Section -->
  <section class="leadership-section py-5 bg-light">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-lg-8 mx-auto">
          <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">OUR TEAM</span>
          <h2 class="section-title mb-4">Meet Our Leadership</h2>
          <p class="lead text-muted">The dedicated professionals behind our success</p>
        </div>
      </div>

      <div class="row">
        <?php
        include 'connection.php';
        $sql = "SELECT * FROM staffs";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
          foreach ($result as $row) {
        ?>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="team-member">
            <div class="member-img">
              <img src="<?=$row['image']?>" alt="<?=$row['fullname']?>" class="img-fluid">
              <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4><?=$row['fullname']?></h4>
              <p class="designation"><?=$row['designation']?></p>
            </div>
          </div>
        </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="values-section py-5">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-lg-8 mx-auto">
          <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">OUR VALUES</span>
          <h2 class="section-title mb-4">What We Stand For</h2>
          <p class="lead text-muted">Our core values shape everything we do</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="value-card text-center p-4">
            <div class="value-icon mb-3">
              <i class="fas fa-heart"></i>
            </div>
            <h3>Passion</h3>
            <p>We are passionate about helping our members achieve their fitness goals and live healthier lives.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="value-card text-center p-4">
            <div class="value-icon mb-3">
              <i class="fas fa-users"></i>
            </div>
            <h3>Community</h3>
            <p>We foster a supportive community where everyone feels welcome and motivated to succeed.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="value-card text-center p-4">
            <div class="value-icon mb-3">
              <i class="fas fa-star"></i>
            </div>
            <h3>Excellence</h3>
            <p>We strive for excellence in everything we do, from our facilities to our programs and service.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta-section text-white py-5" style="background: linear-gradient(135deg, #0062cc, #0097ff);">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 mb-4 mb-lg-0">
          <h2 class="font-weight-bold mb-3">Ready to Start Your Fitness Journey?</h2>
          <p class="lead mb-0">Join our community and transform your life today.</p>
        </div>
        <div class="col-lg-4 text-lg-right">
          <a href="membership.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
            Get Started <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <?php include "include/footer.php"; ?>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
  
  <script>
    // Counter Animation
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });

    // Video Controls
    function toggleVideo(button) {
      const video = button.closest('.video-wrapper').querySelector('video');
      const icon = button.querySelector('i');
      
      if (video.paused) {
        video.play();
        icon.classList.remove('fa-play');
        icon.classList.add('fa-pause');
      } else {
        video.pause();
        icon.classList.remove('fa-pause');
        icon.classList.add('fa-play');
      }
    }

    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>
</html>

