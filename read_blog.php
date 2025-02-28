<?php include "include/header.php"; ?>
  <style>
  
    h1, h2 {
      color: #333;
      font-weight: 700;
      margin-bottom: 20px;
    }
    .slider-item {
      position: relative;
      background-size: cover;
      background-position: center;
    }
    .slider-text h1 {
      color: #fff;
      font-size: 50px;
      font-weight: 800;
    }
    .about_heading {
      font-size: 30px;
      color: #ff7c57;
    }
    p {
      font-size: 18px;
      line-height: 1.6;
      color: #666;
    }
    .fit_onclass_video img {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .container {
      padding: 40px 20px;
    }
    .fit_onclass_data {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .btn {
      background: #ff7c57;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      text-transform: uppercase;
      font-weight: 700;
      transition: 0.3s;
    }
    .btn:hover {
      background: #333;
      color: #fff;
    }
  </style>
</head>

<body>
  <?php include "include/nav.php" ?>

  <section class="home-slider-loop-false inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/1.jpg');">
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-8 text-center col-sm-12 element-animate">
            <h1>Read A Blog</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="section element-animate">
    <div class="container">
      <div class="row">
        <?php
        if ($_GET['id']) {
          include 'connection.php';
          $id = $_GET['id'];
          $sql = "SELECT * FROM gym_blogs WHERE id=$id";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_assoc($result);
        ?>
          <div class="col-lg-5 col-md-12">
            <div class="fit_onclass_video">
              <img src="<?=$row['image_path']?>" class="img-fluid" alt="Blog Image">
            </div>
          </div>
          <div class="col-lg-7 col-md-12">
            <div class="fit_onclass_data">
              <h2 class="about_heading"><?php echo $row['title'] ?></h2>
              <p><?php echo $row['content']; ?></p>
              <a href="blog.php" class="btn">Back to Blogs</a>
            </div>
          </div>
        <?php
        } else {
          echo "<p>No blog selected or presented blog</p>";
        }
        ?>
      </div>
    </div>
  </section>
  
  <?php include "include/footer.php" ?>
</body>

</html>
