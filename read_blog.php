<?php
error_reporting(0);
include "include/header.php"; ?>
<!-- <link rel="stylesheet" href="css/blog-styles.css"> -->
<style>
  /* Single Blog Page Styles */

/* Blog Header */
.blog-header {
  height: 50vh;
  min-height: 400px;
  display: flex;
  align-items: center;
  color: white;
  position: relative;
}

.blog-header-content {
  max-width: 800px;
  padding: 20px;
}

.blog-meta {
  margin-bottom: 20px;
}

.blog-meta span {
  display: inline-block;
  margin-right: 20px;
  font-size: 0.9rem;
  opacity: 0.9;
}

.blog-meta i {
  margin-right: 5px;
}

.blog-header .blog-title {
  font-size: 3rem;
  font-weight: 700;
  line-height: 1.2;
}

/* Blog Content */
.single-blog-content {
  padding: 80px 0;
}

.blog-wrapper {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 40px;
}

.blog-main {
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  overflow: hidden;
}

.featured-image {
  height: 400px;
}

.featured-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.blog-text {
  padding: 40px;
  font-size: 1.1rem;
  line-height: 1.8;
  color: #444;
}

.blog-text p {
  margin-bottom: 20px;
}

.blog-text h2, .blog-text h3 {
  margin: 30px 0 15px;
  color: var(--secondary-color);
}

.blog-text ul, .blog-text ol {
  margin-bottom: 20px;
  padding-left: 20px;
}

.blog-text li {
  margin-bottom: 10px;
}

.blog-tags {
  padding: 0 40px 20px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.tag-label {
  font-weight: 600;
  margin-right: 10px;
  color: var(--secondary-color);
}

.tag {
  display: inline-block;
  padding: 5px 15px;
  margin: 5px;
  background-color: #f0f0f0;
  border-radius: 20px;
  color: var(--gray-color);
  text-decoration: none;
  font-size: 0.85rem;
  transition: var(--transition);
}

.tag:hover {
  background-color: var(--primary-color);
  color: white;
}

.blog-share {
  padding: 20px 40px;
  border-top: 1px solid #eee;
  display: flex;
  align-items: center;
}

.share-label {
  font-weight: 600;
  margin-right: 15px;
  color: var(--secondary-color);
}

.share-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  margin-right: 10px;
  color: white;
  text-decoration: none;
  transition: var(--transition);
}

.share-link.facebook {
  background-color: #3b5998;
}

.share-link.twitter {
  background-color: #1da1f2;
}

.share-link.instagram {
  background-color: #e1306c;
}

.share-link.pinterest {
  background-color: #bd081c;
}

.share-link:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.blog-navigation {
  padding: 20px 40px;
  border-top: 1px solid #eee;
  display: flex;
  justify-content: space-between;
}

.prev-post, .next-post {
  color: var(--secondary-color);
  text-decoration: none;
  font-weight: 500;
  transition: var(--transition);
}

.prev-post i, .next-post i {
  transition: var(--transition);
}

.prev-post:hover, .next-post:hover {
  color: var(--primary-color);
}

.prev-post:hover i {
  transform: translateX(-5px);
}

.next-post:hover i {
  transform: translateX(5px);
}

/* Sidebar */
.blog-sidebar {
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.sidebar-widget {
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  overflow: hidden;
}

.widget-title {
  padding: 20px;
  margin: 0;
  background-color: var(--secondary-color);
  color: white;
  font-size: 1.2rem;
}

.widget-content {
  padding: 20px;
}

.about-logo {
  display: block;
  max-width: 150px;
  margin: 0 auto 15px;
}

.about-widget p {
  text-align: center;
  color: var(--gray-color);
}

.recent-post {
  display: flex;
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid #eee;
}

.recent-post:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.recent-post-img {
  width: 80px;
  height: 80px;
  border-radius: var(--border-radius);
  overflow: hidden;
  margin-right: 15px;
}

.recent-post-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.recent-post-info h4 {
  margin: 0 0 5px;
  font-size: 1rem;
}

.recent-post-info h4 a {
  color: var(--secondary-color);
  text-decoration: none;
  transition: var(--transition);
}

.recent-post-info h4 a:hover {
  color: var(--primary-color);
}

.recent-post-info .date {
  font-size: 0.8rem;
  color: var(--gray-color);
}

.categories ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.categories li {
  border-bottom: 1px solid #eee;
}

.categories li:last-child {
  border-bottom: none;
}

.categories li a {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  color: var(--gray-color);
  text-decoration: none;
  transition: var(--transition);
}

.categories li a:hover {
  color: var(--primary-color);
}

.categories li a span {
  background-color: #f0f0f0;
  border-radius: 20px;
  padding: 2px 10px;
  font-size: 0.8rem;
  color: var(--gray-color);
}

.subscribe-form {
  display: flex;
  flex-direction: column;
}

.subscribe-form input {
  padding: 12px 15px;
  border: 1px solid #eee;
  border-radius: var(--border-radius);
  margin-bottom: 10px;
}

.subscribe-form .btn {
  background-color: var(--primary-color);
  color: white;
  border: none;
  padding: 12px;
  border-radius: var(--border-radius);
  cursor: pointer;
  font-weight: 600;
  transition: var(--transition);
}

.subscribe-form .btn:hover {
  background-color: #e64a19;
}

/* Related Posts */
.related-posts {
  padding: 80px 0;
  background-color: #f9f9f9;
}

.section-title {
  text-align: center;
  margin-bottom: 50px;
  font-size: 2.5rem;
  color: var(--secondary-color);
  position: relative;
  display: inline-block;
  left: 50%;
  transform: translateX(-50%);
}

.section-title:after {
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

.related-posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 30px;
}

.related-post {
  background-color: white;
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--box-shadow);
  transition: var(--transition);
}

.related-post:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.related-post-img {
  height: 200px;
}

.related-post-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.related-post-content {
  padding: 20px;
}

.related-post-content h3 {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 1.2rem;
}

.related-post-content h3 a {
  color: var(--secondary-color);
  text-decoration: none;
  transition: var(--transition);
}

.related-post-content h3 a:hover {
  color: var(--primary-color);
}

.related-post-content p {
  color: var(--gray-color);
  margin-bottom: 15px;
  font-size: 0.9rem;
}

/* Responsive Styles */
@media (max-width: 992px) {
  .blog-wrapper {
    grid-template-columns: 1fr;
  }
  
  .blog-header .blog-title {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .blog-header {
    min-height: 300px;
  }
  
  .blog-header .blog-title {
    font-size: 2rem;
  }
  
  .featured-image {
    height: 300px;
  }
  
  .blog-text {
    padding: 30px;
    font-size: 1rem;
  }
  
  .related-posts-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  }
}

@media (max-width: 576px) {
  .blog-header {
    min-height: 250px;
  }
  
  .blog-header .blog-title {
    font-size: 1.8rem;
  }
  
  .blog-meta span {
    display: block;
    margin-bottom: 10px;
  }
  
  .featured-image {
    height: 200px;
  }
  
  .blog-text {
    padding: 20px;
  }
  
  .blog-tags, .blog-share, .blog-navigation {
    padding: 15px 20px;
  }
  
  .section-title {
    font-size: 2rem;
  }
}
</style>
<body class="single-blog-page">
  <?php include "include/nav.php"; ?>

  <?php
  include 'connection.php';
  
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM gym_blogs WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
      $blog = mysqli_fetch_assoc($result);
    } else {
      // Redirect to blogs page if blog not found
      header("Location: blog.php");
      exit();
    }
  } else {
    // Redirect to blogs page if no ID provided
    header("Location: blog.php");
    exit();
  }
  ?>

  <!-- Blog Header -->
  <section class="blog-header" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('admin/<?= $blog['image_path'] ?>') no-repeat center center/cover;">
    <div class="container">
      <div class="blog-header-content">
        <div class="blog-meta">
          <span class="blog-date">
            <i class="far fa-calendar-alt"></i> 
            <?= date('M d, Y', strtotime($blog['created_at'] ?? date('Y-m-d'))) ?>
          </span>
          <span class="blog-author">
            <i class="far fa-user"></i> Admin
          </span>
        </div>
        <h1 class="blog-title text-white"><?= htmlspecialchars($blog['title']) ?></h1>
      </div>
    </div>
  </section>

  <!-- Blog Content -->
  <section class="single-blog-content">
    <div class="container">
      <div class="blog-wrapper">
        <div class="blog-main">
          <div class="featured-image">
            <img src="admin/<?= $blog['image_path'] ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
          </div>
          
          <div class="blog-text">
            <?= nl2br($blog['content']) ?>
          </div>
          
          <!-- <div class="blog-tags">
            <span class="tag-label">Tags:</span>
            <a href="#" class="tag">Fitness</a>
            <a href="#" class="tag">Workout</a>
            <a href="#" class="tag">Health</a>
          </div> -->
          
          <div class="blog-share">
            <span class="share-label">Share:</span>
            <a href="https://www.facebook.com" class="share-link facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/" class="share-link twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" class="share-link instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://www.pinterest.com/" class="share-link pinterest"><i class="fab fa-pinterest-p"></i></a>
          </div>
          
          <!-- <div class="blog-navigation">
            <a href="#" class="prev-post">
              <i class="fas fa-arrow-left"></i> Previous Post
            </a>
            <a href="#" class="next-post">
              Next Post <i class="fas fa-arrow-right"></i>
            </a>
          </div> -->
        </div>
        
        <div class="blog-sidebar">
          <div class="sidebar-widget about-widget">
            <h3 class="widget-title">About Us</h3>
            <div class="widget-content">
              <img src="img/logo.png" alt="Gym Logo" class="about-logo">
              <p>We are dedicated to helping you achieve your fitness goals with expert guidance and motivation.</p>
            </div>
          </div>
          
          <div class="sidebar-widget recent-posts">
            <h3 class="widget-title">Recent Posts</h3>
            <div class="widget-content">
              <?php
              $recent_sql = "SELECT id, title, image_path, created_at FROM gym_blogs WHERE id != ? ORDER BY created_at DESC LIMIT 3";
              $stmt = mysqli_prepare($con, $recent_sql);
              mysqli_stmt_bind_param($stmt, "i", $id);
              mysqli_stmt_execute($stmt);
              $recent_result = mysqli_stmt_get_result($stmt);
              
              if (mysqli_num_rows($recent_result) > 0) {
                while ($recent = mysqli_fetch_assoc($recent_result)) {
              ?>
                <div class="recent-post">
                  <div class="recent-post-img">
                    <img src="admin/<?= $recent['image_path'] ?>" alt="<?= htmlspecialchars($recent['title']) ?>">
                  </div>
                  <div class="recent-post-info">
                    <h4><a href="read_blog.php?id=<?= $recent['id'] ?>"><?= htmlspecialchars($recent['title']) ?></a></h4>
                    <span class="date"><?= date('M d, Y', strtotime($recent['created_at'])) ?></span>
                  </div>
                </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
          
          <!-- <div class="sidebar-widget categories">
            <h3 class="widget-title">Categories</h3>
            <div class="widget-content">
              <ul>
                <li><a href="#">Workouts <span>(12)</span></a></li>
                <li><a href="#">Nutrition <span>(8)</span></a></li>
                <li><a href="#">Wellness <span>(6)</span></a></li>
                <li><a href="#">Equipment <span>(4)</span></a></li>
                <li><a href="#">Success Stories <span>(10)</span></a></li>
              </ul>
            </div>
          </div> -->
          
          <div class="sidebar-widget subscribe">
            <h3 class="widget-title">Subscribe</h3>
            <div class="widget-content">
              <p>Subscribe to our newsletter for latest updates</p>
              <form class="subscribe-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="btn">Subscribe</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Related Posts -->
  <section class="related-posts">
    <div class="container">
      <h2 class="section-title">Related Posts</h2>
      
      <div class="related-posts-grid">
        <?php
        $related_sql = "SELECT id, title, image_path, content FROM gym_blogs WHERE id != ? ORDER BY RAND() LIMIT 3";
        $stmt = mysqli_prepare($con, $related_sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $related_result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($related_result) > 0) {
          while ($related = mysqli_fetch_assoc($related_result)) {
        ?>
          <div class="related-post">
            <div class="related-post-img">
              <img src="admin/<?= $related['image_path'] ?>" alt="<?= htmlspecialchars($related['title']) ?>">
            </div>
            <div class="related-post-content">
              <h3><a href="read_blog.php?id=<?= $related['id'] ?>"><?= htmlspecialchars($related['title']) ?></a></h3>
              <p><?= htmlspecialchars(substr($related['content'], 0, 100)) . '...' ?></p>
              <a href="read_blog.php?id=<?= $related['id'] ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </section>

  <?php include "include/footer.php" ?>
</body>
</html>