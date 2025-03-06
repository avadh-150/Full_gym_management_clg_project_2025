<?php 
session_start();
error_reporting(0);
include "include/header.php"; ?>

  <style>
    /* Global Styles */
  :root {
    --primary: #ff4d37;
    --secondary: #1a1a1a;
    --light: #f8f9fa;
    --dark: #212529;
    --gray: #6c757d;
    --light-gray: #e9ecef;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
  }
  
  body {
    font-family: 'Poppins', sans-serif;
    color: var(--dark);
    background-color: var(--light);
  }
  
  /* Hero Section */
  .hero-section {
    position: relative;
    height: 400px;
    background-size: cover;
    background-position: center;
    margin-bottom: 60px;
  }
  
  .hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
  }
  
  .hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 20px;
  }
  
  .hero-content h1 {
    color: white;
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  
  .hero-content p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    max-width: 700px;
    margin-bottom: 0;
  }
  
  /* Breadcrumbs */
  .breadcrumbs {
    background-color: white;
    padding: 15px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 60px;
  }
  
  .breadcrumbs-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  .breadcrumbs-item {
    display: flex;
    align-items: center;
  }
  
  .breadcrumbs-item:not(:last-child)::after {
    content: '/';
    margin: 0 10px;
    color: var(--gray);
  }
  
  .breadcrumbs-link {
    color: var(--gray);
    text-decoration: none;
    transition: var(--transition);
  }
  
  .breadcrumbs-link:hover {
    color: var(--primary);
  }
  
  .breadcrumbs-link.active {
    color: var(--primary);
    font-weight: 600;
  }
  .section {
    padding: 100px 0;
    position: relative;
  }
  
  .section-light {
    background: var(--light);
  }
  
  .section-dark {
    background: var(--secondary);
    color: white;
  }
  
  .section-heading {
    margin-bottom: 60px;
    position: relative;
    text-align: center;
  }
  
  .section-heading h2 {
    font-size: 2.5rem;
    font-weight: 700;
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
    text-transform: uppercase;
  }
  
  .section-heading h2:after {
    content: '';
    position: absolute;
    left: 50%;
    bottom: -15px;
    width: 80px;
    height: 4px;
    background: var(--primary);
    transform: translateX(-50%);
  }
  
  .section-heading p {
    max-width: 700px;
    margin: 20px auto 0;
    color: var(--gray);
  }
  
  .section-dark .section-heading p {
    color: rgba(255,255,255,0.7);
  }
  
  /* Featured Products Section */
  .featured-products {
    background: url('img/pattern-bg.jpg') center center;
    background-size: cover;
    position: relative;
  }
  
  .featured-products::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(26,26,26,0.9);
  }/* Responsive Design */
  @media (max-width: 992px) {
    .hero-slider, .slider-item {
      height: 500px;
    }
    
    .slider-content h1 {
      font-size: 2.5rem;
    }
    
    .section {
      padding: 80px 0;
    }
  }
  
  @media (max-width: 768px) {
    .hero-slider, .slider-item {
      height: 400px;
    }
    
    .slider-content {
      padding: 30px;
      max-width: 100%;
    }
    
    .slider-content h1 {
      font-size: 2rem;
    }
    
    .section-heading h2 {
      font-size: 2rem;
    }
    
    .section {
      padding: 60px 0;
    }
  }
  
  @media (max-width: 576px) {
    .hero-slider, .slider-item {
      height: 350px;
    }
    
    .slider-content {
      padding: 20px;
    }
    
    .slider-content h1 {
      font-size: 1.75rem;
    }
    
    .btn-primary {
      padding: 10px 20px;
    }
  }
  
  </style>
</head>

<body>

  <!-- Navigation -->
  <?php include "include/nav.php"; ?>

  <!-- Header -->
  <section class="home-slider-loop-false inner-page owl-carousel" >
    <div class="slider-item " style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),  url('img/pic-11.jpg') no-repeat center center/cover;">
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
          <div class="col-md-8 text-center col-sm-12 element-animate">
          <h1>Product Categories</h1>
          <p>Explore our wide range of high-quality fitness equipment for your gym</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <br>
  <br>
  
  <!-- Hero Section -->
 
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
      <ul class="breadcrumbs-list">
        <li class="breadcrumbs-item">
          <a href="index.php" class="breadcrumbs-link">Home</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="javascript:void(0);" class="breadcrumbs-link active">Categories</a>
        </li>
      </ul>
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
  
  <!-- Why Choose Us Section -->
  <section class="section section-light">
    <div class="container">
      <div class="section-heading">
        <h2>Why Choose Us</h2>
        <p>We are committed to providing the best fitness equipment with exceptional service</p>
      </div>
      
      <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="p-4">
            <div class="mb-3">
              <i class="fas fa-medal" style="font-size: 3rem; color: var(--primary);"></i>
            </div>
            <h4 class="mb-3">Premium Quality</h4>
            <p>We offer only the highest quality fitness equipment built to last</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="p-4">
            <div class="mb-3">
              <i class="fas fa-truck" style="font-size: 3rem; color: var(--primary);"></i>
            </div>
            <h4 class="mb-3">Fast Delivery</h4>
            <p>Quick and reliable shipping to get your equipment to you faster</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="p-4">
            <div class="mb-3">
              <i class="fas fa-headset" style="font-size: 3rem; color: var(--primary);"></i>
            </div>
            <h4 class="mb-3">Expert Support</h4>
            <p>Our team of fitness experts is always ready to assist you</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="p-4">
            <div class="mb-3">
              <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--primary);"></i>
            </div>
            <h4 class="mb-3">Warranty</h4>
            <p>Extended warranty on all our fitness equipment for your peace of mind</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <?php include "include/footer.php"; ?>

</body>

</html>
