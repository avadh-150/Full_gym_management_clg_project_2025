<?php
error_reporting(0);
// Database connection and data fetching logic remains unchanged
$trainer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($trainer_id <= 0) {
    die("Invalid trainer ID.");
}

include "../admin/dbcon.php";

$query = "SELECT * FROM trainers WHERE id = " . $trainer_id;
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Trainer not found.");
}

$trainer = mysqli_fetch_assoc($result);
$joining_date = new DateTime($trainer['joining_date']);
$formatted_date = $joining_date->format('F j, Y');

mysqli_free_result($result);
?>

<!doctype html>
<html lang="en">

<head>
 


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title><?php echo htmlspecialchars($trainer['name']); ?> - Trainer Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">

  <link rel="stylesheet" href="../css/magnific-popup.css">


  <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../fonts/fontawesome/css/font-awesome.min.css">

  <!-- Theme Style -->
  <link rel="stylesheet" href="../css/style.css">
 
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
          
        }
       
        .profile-hero {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: #fff;
            padding: 60px 20px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .profile-image {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .hero-info {
            flex: 1;
            min-width: 300px;
        }
        .hero-info h1 {
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .hero-info .specialization {
            font-size: 20px;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-active {
            background-color: #27ae60;
            color: #fff;
        }
        .status-inactive {
            background-color: #e74c3c;
            color: #fff;
        }
        .contact-info {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            font-size: 16px;
        }
        .contact-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            fill: #fff;
            opacity: 0.8;
        }

        /* Profile Sections */
        .profile-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        .section-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .section-card:hover {
            transform: translateY(-5px);
        }
        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-label {
            font-size: 14px;
            color: #7f8c8d;
            text-transform: uppercase;
        }
        .detail-value {
            font-size: 16px;
            color: #34495e;
            font-weight: 500;
        }

        /* Certificate Section */
        .certificate-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .certificate-image {
            max-width: 100%;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .certificate-image:hover {
            transform: scale(1.05);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            max-width: 90%;
            max-height: 90vh;
            border-radius: 10px;
        }
        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 40px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-hero {
                flex-direction: column;
                text-align: center;
            }
            .profile-image {
                margin-bottom: 20px;
            }
            .hero-info h1 {
                font-size: 32px;
            }
            .hero-info .specialization {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <?php include "../include/nav.php"?>
    <br>
    <br>
    <br>
    
    <div class="container">
        
        <!-- Hero Section -->
        <div class="profile-hero">
            <img src="<?php echo !empty($trainer['image']) ? "../admin/uploads/trainers/" . htmlspecialchars($trainer['image']) : "assets/images/default-trainer.jpg"; ?>" alt="<?php echo htmlspecialchars($trainer['name']); ?>" class="profile-image">
            <div class="hero-info">
                <h1><?php echo htmlspecialchars($trainer['name']); ?></h1>
                <p class="specialization"><?php echo htmlspecialchars($trainer['specialization']); ?></p>
                <span class="status-badge status-<?php echo $trainer['status']; ?>"><?php echo ucfirst($trainer['status']); ?></span>
                <div class="contact-info">
                    <div class="contact-item">
                        <svg class="contact-icon" viewBox="0 0 24 24"><path d="M20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"/></svg>
                        <span><?php echo htmlspecialchars($trainer['email']); ?></span>
                    </div>
                    <div class="contact-item">
                        <svg class="contact-icon" viewBox="0 0 24 24"><path d="M6.62 10.79C8.06 13.62 10.38 15.94 13.21 17.38L15.41 15.18C15.69 14.9 16.08 14.82 16.43 14.93C17.55 15.3 18.75 15.5 20 15.5C20.55 15.5 21 15.95 21 16.5V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z"/></svg>
                        <span><?php echo htmlspecialchars($trainer['phone']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="profile-sections">
            <div class="section-card">
                <h3 class="section-title">Personal Information</h3>
                <div class="detail-item">
                    <div class="detail-label">Gender</div>
                    <div class="detail-value"><?php echo ucfirst($trainer['gender']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Experience</div>
                    <div class="detail-value"><?php echo htmlspecialchars($trainer['experience']); ?> years</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Trainer Since</div>
                    <div class="detail-value"><?php echo $formatted_date; ?></div>
                </div>
            </div>
            <div class="section-card">
                <h3 class="section-title">Professional Details</h3>
                <div class="detail-item">
                    <div class="detail-label">Working Hours</div>
                    <div class="detail-value"><?php echo htmlspecialchars($trainer['working_hours']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Qualification</div>
                    <div class="detail-value"><?php echo htmlspecialchars($trainer['qualification']); ?></div>
                </div>
            </div>
        </div>

        <!-- Certificate Section -->
        <?php
        $cert_query = "SELECT * FROM trainers WHERE id = $trainer_id LIMIT 1";
        $cert_result = mysqli_query($con, $cert_query);
        if ($cert_result && mysqli_num_rows($cert_result) > 0) {
            $certificate = mysqli_fetch_assoc($cert_result);
            ?>
            <div class="certificate-card">
                <h3 class="section-title">Certification</h3>
                <p>View my professional certification:</p>
                <img src="../admin/uploads/trainers/qualifications/<?php echo htmlspecialchars($certificate['qualification']); ?>" alt="Certification" class="certificate-image" onclick="openModal()">
            </div>
            <div class="modal" id="certificateModal">
                <span class="close" onclick="closeModal()">×</span>
                <img class="modal-content" id="modalImage" src="../admin/uploads/trainers/qualifications/<?php echo htmlspecialchars($certificate['qualification']); ?>">
            </div>
            <?php
            mysqli_free_result($cert_result);
        }
        mysqli_close($con);
        ?>
    </div>

    <script>
        function openModal() {
            document.getElementById('certificateModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('certificateModal').style.display = 'none';
        }
        window.onclick = function(event) {
            const modal = document.getElementById('certificateModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
<?php //include "../include/footer.php"?>
</html>