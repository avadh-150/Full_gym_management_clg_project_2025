<?php
session_start();
error_reporting(0);
include "connection.php"; 

// Fetch schedules along with assigned trainers
$query = "
    SELECT s.*,t.*
    FROM schedule s
    LEFT JOIN trainers t ON s.trainer_id = t.id
    ";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Group schedules by day for better organization
$schedulesByDay = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $day =$row['schedule_day']; // Get day name (e.g., Monday)
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
                            $start_time = $schedule['start_time'];
                            $end_time = $schedule['end_time'];
                            $trainer_name = !empty($schedule['name']) ? $schedule['name'] : 'Unassigned';
                            $trainer_img = !empty($schedule['image']) ? 'admin/uploads/trainers/' . $schedule['image'] : 'img/default-avatar.png';
                            $specialization = !empty($schedule['specialization']) ? $schedule['specialization'] : 'General Fitness';
                        ?>
                        <div class="schedule-item">
                            <div class="schedule-time">
                                <span class="time">Schedule</span>
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
                                <div class="class-info " >

                                    <a href="" class="join_btn btn btn-grey">Join Now</a>
                                    
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
                                $start_time = $schedule['start_time'];
                                $end_time = $schedule['end_time'];
                                $trainer_name = !empty($schedule['name']) ? $schedule['name'] : 'Unassigned';
                                $trainer_img = !empty($schedule['image']) ? 'admin/uploads/trainers/' . $schedule['image'] : 'img/default-avatar.png';
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
                                            <div class="class-info " >

<a href="" class="join_btn btn btn-grey">Join Now</a>

</div>
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

