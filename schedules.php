<?php
session_start();
error_reporting(0);
include "connection.php"; 

// Fetch schedules along with assigned trainers
$query = "
    SELECT s.schedule_name, s.start_date, s.end_date, t.*, 
           t.name AS trainer_name, t.image AS trainer_image,
           t.specialization
    FROM schedule s
    LEFT JOIN trainer_schedule ts ON s.schedule_id = ts.schedule_id
    LEFT JOIN trainers t ON ts.trainer_id = t.id
    ORDER BY DAYOFWEEK(s.start_date), s.start_date ASC"; // Order by day of week, then time

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Group schedules by day for better organization
$schedulesByDay = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $day = date('l', strtotime($row['start_date'])); // Get day name (e.g., Monday)
        if (!isset($schedulesByDay[$day])) {
            $schedulesByDay[$day] = [];
        }
        $schedulesByDay[$day][] = $row;
    }
}

// Get unique days of the week with schedules
$days = array_keys($schedulesByDay);

include "include/header.php";
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/schedule.css">
<style>
    /* Main Styles for Schedule Page */

/* Global Styles */
body {
  font-family: "Poppins", sans-serif;
  color: #333;
}

.section-title {
  font-weight: 700;
  position: relative;
}

/* Animations */
.animate__animated {
  animation-duration: 1s;
}

.animate__fadeInUp {
  animation-name: fadeInUp;
}

.animate__delay-1s {
  animation-delay: 0.3s;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translate3d(0, 40px, 0);
  }
  to {
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }
}

/* Schedule Tabs */
.schedule-tabs {
  margin-bottom: 50px;
}

.nav-pills .nav-link {
  border-radius: 30px;
  padding: 10px 25px;
  margin: 0 5px;
  font-weight: 600;
  color: #555;
  transition: all 0.3s ease;
}

.nav-pills .nav-link:hover {
  background-color: rgba(0, 123, 255, 0.1);
}

.nav-pills .nav-link.active {
  background-color: #007bff;
  color: white;
  box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
}

/* Schedule Timeline */
.schedule-timeline {
  position: relative;
  padding: 20px 0;
}

.schedule-timeline::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 120px;
  width: 3px;
  background-color: #e9ecef;
}

.schedule-item {
  position: relative;
  display: flex;
  margin-bottom: 30px;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  transition: all 0.3s ease;
}

.schedule-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.schedule-time {
  width: 120px;
  padding: 20px 15px;
  background-color: #f8f9fa;
  text-align: center;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  border-right: 1px solid #e9ecef;
}

.schedule-time .time {
  font-size: 14px;
  color: #555;
}

.schedule-content {
  flex: 1;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
}

.class-info {
  flex: 1;
}

.class-info h4 {
  margin-bottom: 5px;
  font-weight: 600;
  color: #333;
}

.class-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  font-size: 14px;
  color: #6c757d;
}

.class-meta span {
  display: flex;
  align-items: center;
}

.class-meta i {
  margin-right: 5px;
}

.class-type {
  background-color: rgba(0, 123, 255, 0.1);
  color: #007bff;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
}

.trainer-info {
  display: flex;
  align-items: center;
  padding-left: 20px;
  border-left: 1px solid #e9ecef;
}

.trainer-link {
  display: flex;
  align-items: center;
  color: inherit;
  text-decoration: none;
  transition: all 0.3s ease;
}

.trainer-link:hover {
  color: #007bff;
  text-decoration: none;
}

.trainer-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 15px;
  border: 2px solid #e9ecef;
}

.trainer-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.trainer-details h5 {
  margin-bottom: 0;
  font-size: 16px;
  font-weight: 600;
}

.trainer-role {
  font-size: 12px;
  color: #6c757d;
}

/* Class Categories */
.class-category-card {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  height: 100%;
}

.class-category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.category-image {
  height: 200px;
  background-size: cover;
  background-position: center;
  position: relative;
}

.category-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));
  display: flex;
  align-items: center;
  justify-content: center;
}

.category-overlay h3 {
  color: white;
  font-weight: 700;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.category-content {
  padding: 20px;
  background-color: white;
}

/* Mobile Schedule */
.mobile-schedule {
  display: none;
}

.mobile-trainer-img {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  object-fit: cover;
}

.mobile-time {
  min-width: 80px;
  text-align: center;
}

/* Media Queries */
@media (max-width: 991px) {
  .schedule-timeline::before {
    left: 100px;
  }

  .schedule-time {
    width: 100px;
  }

  .trainer-avatar {
    width: 40px;
    height: 40px;
  }

  .trainer-details h5 {
    font-size: 14px;
  }
}

@media (max-width: 767px) {
  .schedule-tabs {
    display: none;
  }

  .mobile-schedule {
    display: block;
  }

  .schedule-timeline::before {
    display: none;
  }
}

@media (max-width: 575px) {
  .nav-pills .nav-link {
    padding: 8px 15px;
    font-size: 14px;
  }

  .class-info h4 {
    font-size: 16px;
  }

  .class-meta {
    font-size: 12px;
  }
}


</style>
</head>
<body>

<?php include "include/nav.php"; ?>

<!-- Hero Section -->
<section class="schedule-hero" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/4.jpg') no-repeat center center/cover; padding: 120px 0;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="text-white font-weight-bold mb-4 display-4 animate__animated animate__fadeInUp">Class Schedule</h1>
                <p class="lead text-white animate__animated animate__fadeInUp animate__delay-1s">Find the perfect class to fit your fitness journey</p>
            </div>
        </div>
    </div>
</section>

<!-- Schedule Info Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                    <h4>Flexible Schedule</h4>
                    <p class="text-muted">Classes available throughout the week</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-user-friends fa-3x text-primary mb-3"></i>
                    <h4>Expert Trainers</h4>
                    <p class="text-muted">Learn from certified fitness professionals</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
                    <h4>Diverse Classes</h4>
                    <p class="text-muted">Find the perfect workout for your goals</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Schedule Section -->
<section class="schedule-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-md-12">
                <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3">WEEKLY SCHEDULE</span>
                <h2 class="section-title display-4 mb-3">Find Your Perfect Class</h2>
                <p class="text-muted lead mx-auto" style="max-width: 700px;">Our diverse schedule offers classes for all fitness levels. Click on any trainer to view their full profile.</p>
            </div>
        </div>

        <!-- Schedule Tabs -->
        <div class="schedule-tabs">
            <ul class="nav nav-pills mb-4 justify-content-center" id="scheduleTabs" role="tablist">
                <?php foreach ($days as $index => $day): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $index === 0 ? 'active' : '' ?>" 
                            id="<?= strtolower($day) ?>-tab" 
                            data-toggle="pill" 
                            data-target="#<?= strtolower($day) ?>" 
                            type="button" 
                            role="tab" 
                            aria-controls="<?= strtolower($day) ?>" 
                            aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                        <?= $day ?>
                    </button>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content" id="scheduleTabContent">
                <?php foreach ($days as $index => $day): ?>
                <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" 
                     id="<?= strtolower($day) ?>" 
                     role="tabpanel" 
                     aria-labelledby="<?= strtolower($day) ?>-tab">
                    
                    <div class="schedule-timeline">
                        <?php foreach ($schedulesByDay[$day] as $schedule): 
                            $start_time = date('h:i A', strtotime($schedule['start_date']));
                            $end_time = date('h:i A', strtotime($schedule['end_date']));
                            $trainer_name = !empty($schedule['trainer_name']) ? $schedule['trainer_name'] : 'Unassigned';
                            $trainer_img = !empty($schedule['trainer_image']) ? 'admin/uploads/trainers/' . $schedule['trainer_image'] : 'img/default-avatar.png';
                            $specialization = !empty($schedule['specialization']) ? $schedule['specialization'] : 'General Fitness';
                        ?>
                        <div class="schedule-item">
                            <div class="schedule-time">
                                <span class="time"><?= $start_time ?> - <?= $end_time ?></span>
                            </div>
                            <div class="schedule-content">
                                <div class="class-info">
                                    <h4><?= $schedule['schedule_name'] ?></h4>
                                    <div class="class-meta">
                                        <span><i class="far fa-clock"></i> <?= $start_time ?> - <?= $end_time ?></span>
                                        <span class="class-type"><?= $specialization ?></span>
                                    </div>
                                </div>
                                <div class="trainer-info">
                                    <?php if (!empty($schedule['id'])): ?>
                                    <a href="http://localhost/gymphp/trainers/profile.php?id=<?= $schedule['id'] ?>" class="trainer-link">
                                        <div class="trainer-avatar">
                                            <img src="<?= $trainer_img ?>" alt="<?= $trainer_name ?>">
                                        </div>
                                        <div class="trainer-details">
                                            <h5><?= $trainer_name ?></h5>
                                            <span class="trainer-role"><?= $specialization ?></span>
                                        </div>
                                    </a>
                                    <?php else: ?>
                                    <div class="trainer-avatar">
                                        <img src="<?= $trainer_img ?>" alt="Unassigned">
                                    </div>
                                    <div class="trainer-details">
                                        <h5>Unassigned</h5>
                                        <span class="trainer-role">To be announced</span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Class Categories Section -->
<!-- <section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-md-12">
                <h2 class="section-title">Class Categories</h2>
                <p class="text-muted">Explore our diverse range of fitness classes</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="class-category-card">
                    <div class="category-image" style="background-image: url('img/cardio.jpg');">
                        <div class="category-overlay">
                            <h3>Cardio</h3>
                        </div>
                    </div>
                    <div class="category-content">
                        <p>High-energy classes designed to boost your heart rate and burn calories.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="class-category-card">
                    <div class="category-image" style="background-image: url('img/strength.jpg');">
                        <div class="category-overlay">
                            <h3>Strength</h3>
                        </div>
                    </div>
                    <div class="category-content">
                        <p>Build muscle and increase your strength with our resistance training classes.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="class-category-card">
                    <div class="category-image" style="background-image: url('img/yoga.jpg');">
                        <div class="category-overlay">
                            <h3>Mind & Body</h3>
                        </div>
                    </div>
                    <div class="category-content">
                        <p>Improve flexibility, balance and mental wellbeing with our yoga and pilates classes.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- Call to Action -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #0062cc, #0097ff);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="font-weight-bold mb-3">Ready to join a class?</h2>
                <p class="lead mb-0">Book your first session today and start your fitness journey.</p>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a href="plan.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill font-weight-bold">Become a Member <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
        </div>
    </div>
</section>
<br>
<br>

<!-- Mobile Schedule View (Visible only on small screens) -->
<section class="mobile-schedule d-md-none py-5">
    <div class="container">
        <h3 class="text-center mb-4">Weekly Schedule</h3>
        
        <div class="accordion" id="mobileScheduleAccordion">
            <?php foreach ($days as $index => $day): ?>
            <div class="card mb-3">
                <div class="card-header" id="heading<?= $day ?>">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $day ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $day ?>">
                            <i class="fas fa-calendar-day mr-2"></i> <?= $day ?>
                        </button>
                    </h2>
                </div>

                <div id="collapse<?= $day ?>" class="collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $day ?>" data-parent="#mobileScheduleAccordion">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($schedulesByDay[$day] as $schedule): 
                                $start_time = date('h:i A', strtotime($schedule['start_date']));
                                $end_time = date('h:i A', strtotime($schedule['end_date']));
                                $trainer_name = !empty($schedule['trainer_name']) ? $schedule['trainer_name'] : 'Unassigned';
                                $trainer_img = !empty($schedule['trainer_image']) ? 'admin/uploads/trainers/' . $schedule['trainer_image'] : 'img/default-avatar.png';
                            ?>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="mobile-time mr-3">
                                        <strong><?= $start_time ?></strong><br>
                                        <small><?= $end_time ?></small>
                                    </div>
                                    <div class="mobile-class-info">
                                        <h5 class="mb-1"><?= $schedule['schedule_name'] ?></h5>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $trainer_img ?>" alt="<?= $trainer_name ?>" class="mobile-trainer-img mr-2">
                                            <span><?= $trainer_name ?></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include "include/footer.php"; ?>

<script>
    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Highlight current day tab
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toLocaleString('en-us', {weekday:'long'}).toLowerCase();
        const todayTab = document.getElementById(today + '-tab');
        
        if (todayTab) {
            // Remove active class from all tabs
            document.querySelectorAll('#scheduleTabs .nav-link').forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            });
            
            // Remove show active class from all panes
            document.querySelectorAll('#scheduleTabContent .tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            // Set today's tab as active
            todayTab.classList.add('active');
            todayTab.setAttribute('aria-selected', 'true');
            
            // Show today's pane
            const todayPane = document.getElementById(today);
            if (todayPane) {
                todayPane.classList.add('show', 'active');
            }
        }
    });
</script>

</body>
</html>

