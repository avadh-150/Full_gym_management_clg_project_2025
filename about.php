<?php error_reporting(0)?>

<?php include "include/header.php"; ?>
<link rel="stylesheet" href="css/plan.css">

</head>

<body>
  <?php include "include/nav.php"; ?>

  <section class="home-slider-loop-false inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/3.jpg');">
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-8 text-center col-sm-12 element-animate">
            <h1>About Us</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section element-animate">
    <div class="container">
      <div class="video-text-section">
        <!-- Video Section -->
        <video autoplay loop muted>
          <source src="video/v2.mp4" type="video/mp4">
        </video>

        <!-- Text Content Section -->
        <div class="text-content">
          <h2>History</h2>
          <p>Today, our Fitness program has become one of the largest and fastest-growing franchisors and operators of fitness centers in the United States by number of members and locations. With more than 2,600 locations in 50 states, the District of Columbia, Puerto Rico, Canada, Panama, Mexico and Australia, Planet Fitness has continued to spread its unique mission of enhancing people’s lives by providing an affordable, high-quality fitness experience in a welcoming, non-intimidating environment..</p>
        </div>
      </div>
      <br>
      <br>
      <div class="text-content1">

        <h2>Our Mission</h2>
        <p>Our mission is to provide a welcoming and motivating environment where everyone, regardless of age or fitness level, can pursue a healthier lifestyle. We strive to empower individuals to unlock their potential and achieve a balance of physical, mental, and emotional well-being.</p>
        <p><b>Modern Facilities:</b> Our experienced and friendly trainers are here to guide and support you every step of the way.</p>
        <p><b>Modern Facilities:</b> Our experienced and friendly trainers are here to guide and support you every step of the way.</p>
        <p><b>Certified Trainers:</b> From strength training to cardio, yoga to high-intensity interval training (HIIT), we offer programs for every fitness level and interest.</p>
        <p><b>Comprehensive Programs:</b> Educational sessions on nutrition, mental health, and holistic wellness to support your overall well-being.</p>
        <p><b>Holistic Approach:</b> We don’t just focus on physical fitness – we emphasize overall well-being, including nutrition, recovery, and mental health.</p>
      </div>
    </div>
  </section>
  <section class="section element-animate">

    <div class="clearfix mb-5 pb-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center heading-wrap">
            <h2>Leadership</h2>
            <span class="back-text">Our Founders</span>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="major-caousel js-carousel-1 owl-carousel">
          
          <?php
          include 'connection.php';
          $sql = "SELECT * FROM staffs";
          $result = mysqli_query($con, $sql);
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
          ?>
              <div>
                <div class="media d-block media-custom text-center">
                  <a href="adoption-single.html"><img src="<?=$row['image']?>" alt="Image Placeholder" class="img-fluid"></a>
                  <div class="media-body">
                    <h3 class="mt-0 text-black"><?=$row['fullname']?></h3>
                    <p class="lead"><?=$row['designation']?></p>
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

  <?php include "include/footer.php"; ?>
</body>

</ht>