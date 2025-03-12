<?php 
session_start();
error_reporting(0);
include "../connection.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>FITNESS CLUB

    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">

    <link rel="stylesheet" href="../css/magnific-popup.css">


    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../css/plan.css"> -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        <?php

        if (isset($_SESSION['message'])) {
        ?>
            alertify.set('notifier', 'position', 'top-right');


            alertify.success('<?= $_SESSION['message'] ?>');
        <?php
            unset($_SESSION['message']);
        } ?>
    </script>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/profile.css">

<style>
        /* Modern styling for announcement page */
           
        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .header-content h1 {
            font-size: 28px;
            font-weight: 600;
            margin: 0 0 5px 0;
            color: #2c3e50;
        }
        
        .header-content p {
            color: #7f8c8d;
            margin: 0;
        }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #f1f1f1;
            color: #333;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .btn-back:hover {
            background-color: #e0e0e0;
        }
        
        .btn-back i {
            margin-right: 5px;
        }
        
        /* Search and Filter Bar */
        .search-filter-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        
        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
        }
        
        .search-box input {
            width: 100%;
            padding: 10px 15px;
            padding-right: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        
        .filter-options select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
            cursor: pointer;
        }
        
        /* Announcements Grid */
        .announcements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .announcement-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }
        
        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .announcement-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #3498db;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .announcement-date {
            padding: 15px 15px 0;
            color: #7f8c8d;
            font-size: 13px;
        }
        
        .announcement-title {
            padding: 10px 15px 0;
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .announcement-content {
            padding: 10px 15px;
            color: #34495e;
            font-size: 14px;
            min-height: 80px;
        }
        
        .announcement-footer {
            padding: 10px 15px;
            border-top: 1px solid #f1f1f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
        }
        
        .admin-info {
            font-size: 13px;
            color: #7f8c8d;
        }
        
        .admin-info i {
            margin-right: 5px;
        }
        
        .no-announcements {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px 0;
            color: #7f8c8d;
        }
        
        .no-announcements i {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
        
        /* Simple Footer */
        .simple-footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }
        
        .simple-footer p {
            margin: 0;
            font-size: 14px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                margin-top: 15px;
            }
            
            .search-filter-bar {
                flex-direction: column;
            }
            
            .search-box {
                max-width: 100%;
                margin-bottom: 15px;
            }
            
            .announcements-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

<body>
    <!-- Navigation -->
    <?php include "../include/nav.php"; ?>
    
    <!-- Main Content Section -->
     <br>
     <br>
     <br>
    <div class="main-content ">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-content">
                    <h1>Gym Announcements</h1>
                    <p>Stay updated with the latest news and information</p>
                </div>
                <div class="header-actions">
                    <a href="../index.php" class="btn-back">
                        <i class="icon-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            
            <!-- Search and Filter Bar -->
            <div class="search-filter-bar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search announcements...">
                    <i class="icon-search"></i>
                </div>
                <div class="filter-options">
                    <select id="filterSelect">
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
            </div>
            
            <!-- Announcements Grid -->
            <div class="announcements-grid">
                <?php
                $qry = "SELECT * FROM announcements ORDER BY date DESC";
                $result = mysqli_query($con, $qry);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        // Format the date
                        $date = new DateTime($row['date']);
                        $formatted_date = $date->format('F j, Y - h:i A');
                        
                        echo "<div class='announcement-card'>";
                        echo "<div class='announcement-badge'>Announcement</div>";
                        echo "<div class='announcement-date'>" . $formatted_date . "</div>";
                        echo "<h3 class='announcement-title'>Gym Announcement</h3>";
                        echo "<div class='announcement-content'>" . $row['message'] . "</div>";
                        echo "<div class='announcement-footer'>";
                        echo "<div class='admin-info'><i class='icon-user'></i> System Administrator</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='no-announcements'>";
                    echo "<i class='icon-info-sign'></i>";
                    echo "<p>No announcements available at this time.</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Simple Footer -->
    <?php //include "../include/footer.php" ?>

    <!-- <footer class="simple-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Gym Management System. All rights reserved.</p>
        </div>
    </footer> -->
    
    <!-- JavaScript for search and filter functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const cards = document.querySelectorAll('.announcement-card');
            
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                
                cards.forEach(card => {
                    const content = card.querySelector('.announcement-content').textContent.toLowerCase();
                    const title = card.querySelector('.announcement-title').textContent.toLowerCase();
                    
                    if (content.includes(searchTerm) || title.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
            
            // Filter functionality
            const filterSelect = document.getElementById('filterSelect');
            
            filterSelect.addEventListener('change', function() {
                const filterValue = this.value;
                const currentDate = new Date();
                
                cards.forEach(card => {
                    const dateText = card.querySelector('.announcement-date').textContent;
                    const announcementDate = new Date(dateText);
                    
                    let showCard = true;
                    
                    if (filterValue === 'today') {
                        showCard = announcementDate.toDateString() === currentDate.toDateString();
                    } else if (filterValue === 'week') {
                        const weekAgo = new Date();
                        weekAgo.setDate(currentDate.getDate() - 7);
                        showCard = announcementDate >= weekAgo;
                    } else if (filterValue === 'month') {
                        showCard = announcementDate.getMonth() === currentDate.getMonth() && 
                                  announcementDate.getFullYear() === currentDate.getFullYear();
                    }
                    
                    card.style.display = showCard ? '' : 'none';
                });
            });
        });
    </script>
    </body>
</html>

