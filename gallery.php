<?php include "include/header.php"; ?>

  <style>
   
  </style>
</head>

<body>

  <!-- Navigation -->
  <?php include "include/nav.php"; ?>

  <!-- Header -->
  <section class="home-slider-loop-false inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/pic-11.jpg');">
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-8 text-center col-sm-12 element-animate">
            <h1>Gallery Products</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Product Categories -->
  <section class="section element-animate">
    <div class="clearfix mb-5 pb-1">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center heading-wrap">
            <h2>Our Categories</h2>
            <span class="back-text">Our Categories</span>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <?php
        include 'admin/dbcon.php';
        $sql = "SELECT * FROM product_categories";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
          foreach ($result as $row) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 cart-box1">
              <div class="cart-box2">
                <a href="products.php?category=<?= $row['id']?>">
                  <img src="admin/uploads/category/<?= $row['image'] ?>" 
                       class="img-fluid galleryImage" 
                       alt="<?= $row['name'] ?>" 
                       title="<?= $row['name'] ?>">
                  <h4><?= $row['name'] ?></h4>
                </a>
              </div>
            </div>
        <?php
          }
        } else {
          echo "<p class='text-center'>No categories available.</p>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include "include/footer.php"; ?>

</body>

</html>
