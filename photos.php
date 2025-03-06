<?php
// Include database connection file
include 'connection.php';
// session_st   art();
error_reporting(0);


// Pagination settings
$images_per_page = 15; // Number of images per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $images_per_page;

// Fetch total number of images for pagination
$total_images_query = "SELECT COUNT(*) as total FROM gym_images";
$total_result = $con->query($total_images_query);
$total_images = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_images / $images_per_page);

// Fetch images for the current page
$sql = "SELECT * FROM gym_images LIMIT ? OFFSET ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $images_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include "include/header.php"; ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <!-- Add Magnific Popup CSS for lightbox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
    <!-- Add AOS for scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="css/photos.css"> -->

    <!-- Custom CSS -->
    <style>
        :root {
    --primary-color: #ff5722;
    --secondary-color: #212529;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --accent-color: #ff0066;
    --transition: all 0.3s ease;
}

body {
    font-family: 'Montserrat', sans-serif;
    color: #333;
    line-height: 1.6;
    background-color: var(--light-color);
}

/* Hero Section */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/pic-19.jpg');
    background-size: cover;
    background-position: center;
    height: 50vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    position: relative;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto;
}

/* Gallery Section */
.gallery-section {
    padding: 80px 0;
    background-color: #fff;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--secondary-color);
    text-transform: uppercase;
    margin-bottom: 15px;
}

.section-header p {
    font-size: 1.1rem;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

/* Gallery Grid */
.gallery-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.gallery-item {
    flex: 1 1 calc(25% - 20px); /* 4 columns on large screens */
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-item-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-item-overlay {
    opacity: 1;
}

.gallery-item-overlay i {
    color: #fff;
    font-size: 2rem;
}

.gallery-item-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-item-caption {
    transform: translateY(0);
}

.gallery-item-caption h4 {
    font-size: 1rem;
    margin-bottom: 5px;
}

.gallery-item-caption p {
    font-size: 0.85rem;
    margin: 0;
}

/* Pagination */
.gallery-pagination {
    text-align: center;
    margin-top: 40px;
}

.gallery-pagination a {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 5px;
    border: 1px solid var(--dark-color);
    border-radius: 5px;
    font-size: 1rem;
    color: var(--dark-color);
    text-decoration: none;
    transition: var(--transition);
}

.gallery-pagination a.active,
.gallery-pagination a:hover {
    background-color: var(--primary-color);
    color: #fff;
    border-color: var(--primary-color);
}

/* Loading Spinner */
.gallery-loading {
    text-align: center;
    padding: 20px;
    display: none;
}

.gallery-loading i {
    font-size: 1.5rem;
    color: var(--primary-color);
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .gallery-item {
        flex: 1 1 calc(33.33% - 20px); /* 3 columns on medium screens */
    }
}

@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .gallery-section {
        padding: 50px 0;
    }

    .gallery-item {
        flex: 1 1 calc(50% - 20px); /* 2 columns on small screens */
    }
}

@media (max-width: 576px) {
    .gallery-item {
        flex: 1 1 100%; /* 1 column on extra small screens */
    }
}
    </style>
</head>

<body>
    <!-- Include Navigation -->
    <?php include "include/nav.php"; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-white">Our Gallery</h1>
                <p>Explore our state-of-the-art facilities and equipment designed to help you achieve your fitness goals.</p>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up" data-aos-duration="1000">
                <h2 >Fitness Gallery</h2>
                <p>Take a visual tour of our premium gym facilities, equipment, and training spaces.</p>
            </div>

            <!-- Gallery Container -->
            <div class="gallery-container">
                <!-- Loading Spinner -->
                <div class="gallery-loading">
                    <i class="fas fa-spinner"></i>
                </div>

                <!-- Gallery Grid -->
                <div class="gallery-grid" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            $caption = "Gym Image " . $i;
                    ?>
                            <div class="gallery-item" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="<?php echo ($i * 50); ?>">
                                <a href="<?php echo htmlspecialchars($row['image_path']); ?>" class="gallery-lightbox">
                                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['image_alt'] ?? 'Gym Image'); ?>" loading="lazy">
                                    <div class="gallery-item-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                    <div class="gallery-item-caption">
                                        <h4><?php echo htmlspecialchars($row['image_title'] ?? $caption); ?></h4>
                                        <p><?php echo htmlspecialchars($row['image_description'] ?? 'Our premium gym facilities'); ?></p>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="text-center w-100 p-5">
                            <h3>No images found</h3>
                            <p>Check back soon for our updated gallery.</p>
                        </div>';
                    }
                    $stmt->close();
                    ?>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="gallery-pagination" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                            <a href="?page=<?php echo $p; ?>" class="<?php echo $p == $page ? 'active' : ''; ?>">
                                <?php echo $p; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include "include/footer.php"; ?>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize AOS
            AOS.init();

            // Initialize Magnific Popup for lightbox
            $('.gallery-grid').magnificPopup({
                delegate: 'a.gallery-lightbox',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out'
                }
            });

            // Pagination click event (with loading animation)
            $('.gallery-pagination a').on('click', function(e) {
                e.preventDefault();
                var href = $(this).attr('href');

                // Show loading spinner
                $('.gallery-loading').show();
                $('.gallery-grid').fadeOut(300);

                // Simulate loading new images (in a real scenario, this would be an AJAX call)
                setTimeout(function() {
                    window.location.href = href; // Redirect to the new page
                }, 500);
            });
        });
    </script>
</body>
</html>