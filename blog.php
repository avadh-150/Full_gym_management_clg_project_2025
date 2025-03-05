<?php
error_reporting(0);
include "include/header.php"; ?>
<style>
  /* Blog Page Styles */
:root {
  --primary-color: #ff5722;
  --secondary-color: #333;
  --light-color: #f8f9fa;
  --dark-color: #212529;
  --gray-color: #6c757d;
  --border-radius: 8px;
  --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s ease;
}

body {
  font-family: 'Poppins', sans-serif;
  line-height: 1.6;
  color: var(--dark-color);
  background-color: #f9f9f9;
  margin: 0;
  padding: 0;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

/* Hero Section */
.hero-section {
  height: 50vh;
  min-height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: white;
  position: relative;
}

.hero-content {
  z-index: 1;
  padding: 20px;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 15px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.hero-subtitle {
  font-size: 1.2rem;
  max-width: 600px;
  margin: 0 auto;
}

/* Blog Section */
.blog-section {
  padding: 80px 0;
}

.section-header {
  text-align: center;
  margin-bottom: 50px;
}

.section-header h2 {
  font-size: 2.5rem;
  color: var(--secondary-color);
  margin-bottom: 15px;
  position: relative;
  display: inline-block;
}

.section-header h2:after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background-color: var(--primary-color);
  border-radius: 2px;
}

.section-header p {
  color: var(--gray-color);
  font-size: 1.1rem;
}

/* Blog Filter */
.blog-filter {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

.filter-btn {
  background: none;
  border: 2px solid var(--primary-color);
  color: var(--secondary-color);
  padding: 8px 20px;
  margin: 0 8px 10px;
  border-radius: 30px;
  cursor: pointer;
  font-weight: 500;
  transition: var(--transition);
}

.filter-btn:hover, .filter-btn.active {
  background-color: var(--primary-color);
  color: white;
}

/* Blog Grid */
.blog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 30px;
  margin-bottom: 50px;
}

.blog-card {
  background-color: white;
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--box-shadow);
  transition: var(--transition);
}

.blog-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.blog-image {
  position: relative;
  height: 220px;
  overflow: hidden;
}

.blog-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.blog-card:hover .blog-image img {
  transform: scale(1.1);
}

.blog-date {
  position: absolute;
  bottom: 0;
  left: 0;
  background-color: var(--primary-color);
  color: white;
  padding: 8px 15px;
  font-size: 0.85rem;
  font-weight: 500;
}

.blog-content {
  padding: 25px;
}

.blog-title {
  font-size: 1.3rem;
  margin-bottom: 15px;
  font-weight: 600;
  color: var(--secondary-color);
}

.blog-excerpt {
  color: var(--gray-color);
  margin-bottom: 20px;
  font-size: 0.95rem;
  line-height: 1.7;
}

.read-more {
  display: inline-flex;
  align-items: center;
  color: var(--primary-color);
  font-weight: 600;
  text-decoration: none;
  transition: var(--transition);
}

.read-more i {
  margin-left: 5px;
  transition: var(--transition);
}

.read-more:hover {
  color: var(--secondary-color);
}

.read-more:hover i {
  transform: translateX(5px);
}

.no-blogs {
  grid-column: 1 / -1;
  text-align: center;
  padding: 40px;
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 50px;
}

.page-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  margin: 0 5px;
  border-radius: 50%;
  background-color: white;
  color: var(--secondary-color);
  text-decoration: none;
  font-weight: 500;
  box-shadow: var(--box-shadow);
  transition: var(--transition);
}

.page-link.next {
  width: auto;
  padding: 0 15px;
  border-radius: 20px;
}

.page-link.active, .page-link:hover {
  background-color: var(--primary-color);
  color: white;
}

/* Newsletter Section */
.newsletter-section {
  background-color: var(--secondary-color);
  color: white;
  padding: 80px 0;
}

.newsletter-content {
  max-width: 600px;
  margin: 0 auto;
  text-align: center;
}

.newsletter-content h2 {
  font-size: 2rem;
  margin-bottom: 15px;
}

.newsletter-content p {
  margin-bottom: 30px;
  opacity: 0.8;
}

.newsletter-form {
  display: flex;
  max-width: 500px;
  margin: 0 auto;
}

.newsletter-form input {
  flex: 1;
  padding: 15px;
  border: none;
  border-radius: var(--border-radius) 0 0 var(--border-radius);
  font-size: 1rem;
}

.newsletter-form .btn {
  padding: 0 25px;
  background-color: var(--primary-color);
  color: white;
  border: none;
  border-radius: 0 var(--border-radius) var(--border-radius) 0;
  cursor: pointer;
  font-weight: 600;
  transition: var(--transition);
}

.newsletter-form .btn:hover {
  background-color: #e64a19;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .blog-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  }
  
  .newsletter-form {
    flex-direction: column;
  }
  
  .newsletter-form input {
    border-radius: var(--border-radius);
    margin-bottom: 10px;
  }
  
  .newsletter-form .btn {
    border-radius: var(--border-radius);
    padding: 15px;
  }
}

@media (max-width: 576px) {
  .hero-section {
    min-height: 300px;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .section-header h2 {
    font-size: 2rem;
  }
  
  .blog-filter {
    flex-direction: column;
    align-items: center;
  }
  
  .filter-btn {
    margin-bottom: 10px;
    width: 200px;
  }
}
</style>
<body class="blog-page">
  <?php include "include/nav.php"; ?>

  <!-- Hero Section -->
  <section class="hero-section" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/2.jpg') no-repeat center center/cover;">
    <div class="container">
      <div class="hero-content">
        <h1 class="hero-title text-white">Fitness Blog</h1>
        <p class="hero-subtitle">Expert tips, workout guides, and nutrition advice</p>
      </div>
    </div>
  </section>

  <!-- Blog Section -->
  <section class="blog-section">
    <div class="container">
      <div class="section-header">
        <h2>Latest Articles</h2>
        <p>Stay updated with our fitness knowledge base</p>
      </div>

      <!-- <div class="blog-filter">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="workout">Workouts</button>
        <button class="filter-btn" data-filter="nutrition">Nutrition</button>
        <button class="filter-btn" data-filter="wellness">Wellness</button>
      </div> -->

      <div class="blog-grid">
    <?php
    include 'connection.php';

    $limit = 6; // Number of blogs per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // Ensure page is at least 1
    $offset = ($page - 1) * $limit;

    // Get total blog count
    $total_query = "SELECT COUNT(*) as total FROM gym_blogs";
    $total_result = mysqli_query($con, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_blogs = $total_row['total'];

    $total_pages = ceil($total_blogs / $limit);

    // Fetch paginated blogs
    $sql = "SELECT * FROM gym_blogs ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            $category = "workout"; // Example category
    ?>
            <div class="blog-card" data-category="<?= $category ?>">
                <div class="blog-image">
                    <img src="admin/<?= $row['image_path'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <div class="blog-date">
                        <?= date('M d, Y', strtotime($row['created_at'] ?? date('Y-m-d'))) ?>
                    </div>
                </div>
                <div class="blog-content">
                    <h3 class="blog-title"><?= htmlspecialchars($row['title']) ?></h3>
                    <p class="blog-excerpt"><?= htmlspecialchars(substr(strip_tags($row['content']), 0, 150)) . '...' ?></p>
                    <a href="read_blog.php?id=<?= $row['id'] ?>" class="read-more">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
    <?php
        }
    } else {
    ?>
        <div class="no-blogs">
            <p>No blog posts found. Check back soon for new content!</p>
        </div>
    <?php
    }
    ?>
</div>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1) { ?>
        <a href="?page=<?= $page - 1 ?>" class="prev-page">← Previous</a>
    <?php } ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>

    <?php if ($page < $total_pages) { ?>
        <a href="?page=<?= $page + 1 ?>" class="next-page">Next →</a>
    <?php } ?>
</div>

<!-- Pagination CSS (Keeps the existing design intact) -->
<style>
.pagination {
    text-align: center;
    margin-top: 20px;
}
.pagination a {
    padding: 8px 12px;
    margin: 5px;
    text-decoration: none;
    background: #f66;
    color: white;
    border-radius: 5px;
}
.pagination a.active {
    background: #d44;
    font-weight: bold;
}
.pagination a:hover {
    background: #c33;
}
</style>

    
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

  <?php include "include/footer.php" ?>

  <!-- Add this before closing body tag -->
  <script>
    // Simple filter functionality
    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.filter-btn');
      const blogCards = document.querySelectorAll('.blog-card');

      filterButtons.forEach(button => {
        button.addEventListener('click', function() {
          // Remove active class from all buttons
          filterButtons.forEach(btn => btn.classList.remove('active'));
          // Add active class to clicked button
          this.classList.add('active');

          const filter = this.getAttribute('data-filter');
          
          blogCards.forEach(card => {
            if (filter === 'all' || card.getAttribute('data-category') === filter) {
              card.style.display = 'block';
            } else {
              card.style.display = 'none';
            }
          });
        });
      });
    });
  </script>
</body>
</html>