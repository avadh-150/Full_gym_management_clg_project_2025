<?php include "include/header.php"; ?>


<body>

  <?php include "include/nav.php"; ?>

  <!-- END header -->

  <section class="home-slider-loop-false  inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/2.jpg');">

      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-8 text-center col-sm-12 element-animate">
            <h1>Blogs</h1>

          </div>
        </div>
      </div>

    </div>

  </section>
  <!-- END slider -->


  <section class="section element-animate">
    <div class="clearfix mb-5 pb-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center heading-wrap">
            <h2>Blogs</h2>
            <span class="back-text">Blogs</span>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <?php
        include 'connection.php';
        $sql = "SELECT * FROM gym_blogs";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
          foreach ($result as $row) {
        ?>
            <br>
            <br>
            <div class="col-lg-5 col-md-12">
              <div class="fit_onclass_video">
                <img src="<?= $row['image_path'] ?>" class="img-fluid" alt="image">
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="fit_onclass_data">
                <h2 class="about_heading"><?= $row['title'] ?></h2>
                <p><?= substr($row['content'], 0, 200), '..'; ?></p>
                <a href="read_blog.php?id=<?= $row['id'] ?>">

                  <button class="btn">Read More</button>
                </a>
              </div>
              <br><br>
            </div>

        <?php
          }
        }
        ?>
      </div>

    </div>
<?php include "include/footer.php"?>
</body>

</html>