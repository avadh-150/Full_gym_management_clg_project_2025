<?php include "include/header.php"; ?>

  <body>
  <?php include "include/nav.php";
  
  ?>

    <!-- END header -->

    
    <section class="home-slider owl-carousel">
    <?php 
    include "admin/dbcon.php";
    $sql = "SELECT * FROM gym_images";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
      foreach ($result as $row) {
    
    
    ?>
      <div class="slider-item" style="background-image: url('<?= $row["image_path"]?>');">
        
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

      <!-- <div class="slider-item" style="background-image: url('img/pic-13.jpg');">
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-8 text-center col-sm-12 element-animate">
              <h1>empowering through fitness</h1>
              <p class="mb-5">discover a community dedicated to helping you achieve your fitness goals.</p>
              <p><a href="about.php" class="btn btn-white btn-outline-white">learn more..</a></p>
            </div>
          </div>
        </div>
        
      </div> -->

      <?php }}?>
    </section>
    <!-- END slider -->

    
    <!-- <section class="section element-animate">

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
    </section>  -->

    <section class="section bg-light element-animate">

      <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center heading-wrap">
              <h2>Our Schedule</h2>
              <span class="back-text-dark">Schedule</span>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        
        <div class="row no-gutters">
          <div class="col-md-6">
            <div class="sched d-block d-lg-flex">
              <div class="bg-image order-2" style="background-image: url('img/image1.jpg');"></div>
              <div class="text order-1">
                <h3>glam yoga</h3>
                <p>embrace that fusion of elegance annd minfilness with our glam yoga class....</p>
                <p class="sched-time">
                  <span><span class="fa fa-clock-o"></span> 8:30 am</span> <br>
                  <span><span class="fa fa-calendar"></span> july 22, 2024</span> <br>
                </p>
                <!-- <p><a href="#" class="btn btn-primary btn-sm">Join from 2000</a></p> -->
                
              </div>
              
            </div>

            <div class="sched d-block d-lg-flex">
              <div class="bg-image" style="background-image: url('img/hiit.jpg');"></div>
              <div class="text">
                <h3>posh hiit</h3>
                <p>experience a luxurious twist on traditional high-intensity interval training(HIIT)...</p>
                <p class="sched-time">
                  <span><span class="fa fa-clock-o"></span> 6:00 PM</span> <br>
                  <span><span class="fa fa-calendar"></span> july 22, 2024</span> <br>
                </p>
                <!-- <p><a href="#" class="btn btn-primary btn-sm">Join from 2500</a></p> -->
                
              </div>
              
            </div>

          </div>

          <div class="col-md-6">
            <div class="sched d-block d-lg-flex">
              <div class="bg-image order-2" style="background-image: url('img/cardio.jpg');"></div>
              <div class="text order-1">
                <h3>elegant cardio</h3>
                <p>elevate your workout routine with elegant cardio, wheere fitness meets finesse....</p>
                <p class="sched-time">
                  <span><span class="fa fa-clock-o"></span> 5:30 PM</span> <br>
                  <span><span class="fa fa-calendar"></span> july 21, 2024</span> <br>
                </p>
                <!-- <p><a href="#" class="btn btn-primary btn-sm">Join from 1800</a></p> -->
                
              </div>
              
            </div>

            <div class="sched d-block d-lg-flex">
              <div class="bg-image" style="background-image: url('img/zumba.jpg');"></div>
              <div class="text">
                <h3>gracefull zumba</h3>
                <p>join the party with zumba, latin-inspired dance fitness class that's fun and effective...</p>
                <p class="sched-time">
                  <span><span class="fa fa-clock-o"></span> 5:30 PM</span> <br>
                  <span><span class="fa fa-calendar"></span> july 16, 2024</span> <br>
                </p>
                <!-- <p><a href="#" class="btn btn-primary btn-sm">Join from 1500</a></p> -->
                
              </div>
              
            </div>

          </div>
        </div>
        

      </div>
    </section>

    <section class="section element-animate">

      <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center heading-wrap">
              <h2>Expert Trainers</h2>
              <span class="back-text">Our Trainers</span>
            </div>
          </div>
        </div>
      </div>
        <div class="container">
          <div class="row">
            <div class="major-caousel js-carousel-1 owl-carousel">
              <div>
                <div class="media d-block media-custom text-center">
                  <a href="#"><img src="img/image3.jpg" alt="Image Placeholder" class="img-fluid"></a>
                  <div class="media-body">
                    <h3 class="mt-0 text-black">khushi gangani</h3>
                    <p class="lead">fitness Trainer</p>
                  </div>
                </div>
              </div>
              <div>
                <div class="media d-block media-custom text-center">
                  <a href="#"><img src="img/trainer-2.jpg" alt="Image Placeholder" class="img-fluid"></a>
                  <div class="media-body">
                    <h3 class="mt-0 text-black">sakshi mendapra</h3>
                    <p class="lead">fitness Trainer</p>
                  </div>
                </div>
              </div>
              <div>
                <div class="media d-block media-custom text-center">
                  <a href="#"><img src="img/image4.jpg" alt="Image Placeholder" class="img-fluid"></a>
                  <div class="media-body">
                    <h3 class="mt-0 text-black">harshita patel</h3>
                    <p class="lead">fitness Trainer</p>
                  </div>
                </div>
              </div>

               <div>
              <div class="media d-block media-custom text-center">
                <a href="#"><img src="img/trainer-4.jpg" alt="Image Placeholder" class="img-fluid"></a>
                <div class="media-body">
                  <h3 class="mt-0 text-black">fensi anghan</h3>
                  <p class="lead">fitness Trainer</p>
                </div>
              </div>
            </div>
            <div>
              <div class="media d-block media-custom text-center">
                <a href="#"><img src="img/trainer-5.jpg" alt="Image Placeholder" class="img-fluid"></a>
                <div class="media-body">
                  <h3 class="mt-0 text-black">grisha shah</h3>
                  <p class="lead">fitness Trainer</p>
                </div>
              </div>
            </div>
            <div>
              <div class="media d-block media-custom text-center">
                <a href="#"><img src="img/trainer-6.jpg" alt="Image Placeholder" class="img-fluid"></a>
                <div class="media-body">
                  <h3 class="mt-0 text-black">khushi gupta</h3>
                  <p class="lead">fitness Trainer</p>
                </div>
              </div>
            </div>
            
              
          </div>
        
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
              <p>&ldquo; the trainers here have helped me achive mt fitness goals faster than i ever thought possible  &rdquo;</p>
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

   <?php include "include/footer.php"?>
  </body>
</html>