

<?php include 'nav.php'?>
   <!-- Main Content Section -->
   <div class="main-content">
        <div class="container-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2">
                        <span class="icon"><i class="icon-chevron-down"></i></span>
                        <h5>Gym Announcement</h5>
                    </div>
                    <div class="widget-content nopadding collapse in" id="collapseG2">
                        <ul class="recent-posts">
                            <li>
                                <?php
                                include "../connection.php";
                                $qry = "SELECT * FROM announcements";
                                $result = mysqli_query($con, $qry);

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<div class='article-post'>";
                                    echo "<span class='user-info'> By: System Administrator / Date: " . $row['date'] . " </span>";
                                    echo "<p><a href='#'>" . $row['message'] . "</a></p>";
                                    echo "</div>";
                                }
                                ?>
                                <a href="announcement.php"><button class="btn btn-warning btn-mini">View All</button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- End of Announcement Section -->
        </div><!-- End of Container -->
    </div><!-- End of Main Content -->
