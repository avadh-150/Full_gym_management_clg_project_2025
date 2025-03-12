<?php include "include/header.php"; 
// session_start();
?>

<link rel="stylesheet" href="css/empty.css">

<body>

    <!-- Navigation -->
    <?php include "include/nav.php"; ?>

    <!-- Cart Section -->
    <section class="section element-animate" style="height:800px;">
        <div class="container" id="body">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a> / </li>
                    <li class="active">My Appointments</li>
                </ol>
            </div>
            <div class="col-md-12">
                <?php 
                if (isset($_SESSION['auth_user'])) {
                    include 'connection.php';
                    $user_id = $_SESSION['auth_user']['user_id'];
                    // $user_query = "SELECT * FROM users WHERE id = $user_id";
                    // $user_result = mysqli_query($con, $user_query);
                    // $user = mysqli_fetch_assoc($user_result);
                    // $member_id = $user['member_id'];
                    // echo "<script>alert('$member_id');</script>";
                    $pay_user = "select a.*,a.status as status_app,a.id as app_id,t.name as name from appointments a,trainers t where a.trainer_id=t.id and a.user_id='$user_id'";

                    $pay_result = mysqli_query($con, $pay_user);
                    
                    if (!$pay_result) {
                        echo "Error executing query: " . mysqli_error($con);
                    } elseif (mysqli_num_rows($pay_result) > 0) {
                        ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Appointment Date</th>
                                    <th width="130px">Appointment Time</th>
                                    <th width="120px">Your Instructor</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($product = mysqli_fetch_assoc($pay_result)) 
                            { 
                            ?>
                                <tr class="product-content">
                                    <td>#<?= htmlspecialchars($product['app_id']) ?></td>
                                    <td><?php echo date('l, F j, Y', strtotime($product['appointment_date'])); ?></td>
                                    <td><?php echo date('g:i A', strtotime($product['appointment_time'])); ?></td>
                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                    <td><?= htmlspecialchars($product['fitness_level']) ?></td>
                                    <!-- <td><?= htmlspecialchars($product['status_app']) ?></td> -->
                                    <td>
                                    <?php      
                                               
                                    if($product['status_app']=="scheduled") {
                                        // echo '<label class="bg bg-danger" style="color:#fff; padding:5px 10px; border-radius:3px;">scheduled</label>';
                                        echo '<label class="bg bg-warning" style="color:#fff; padding:5px 10px; border-radius:3px;">scheduled</label>';
                                    }
                                    else if ($product['status_app']=='completed'){
                                        echo '<label class="bg bg-success" style="color:#fff; padding:5px 10px; border-radius:3px;">completed</label>';
                                      }
                                    else if ($product['status_app']=='cancelled'){
                                        echo '<label class="bg bg-danger" style="color:#fff; padding:5px 10px; border-radius:3px;">cancelled</label>';
                                       }
                                ?>

                                    </td>
                                        <td>
                                        <a href="view-appointment.php?appointmentId=<?= htmlspecialchars($product['app_id']) ?>" target="_blank" class="btn btn-primary btn-sm">view detail..</a>
                                    </td>
                             </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php
                                }
                             else {
                                    ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <h3>No Appointment Found</h3>
                                <p>We couldn't find your any Appointment in this Appointment Page or Section. Please check back later or browse other Appointment.</p>
                                <a href="appointment.php" class="btn btn-primary">Browse All Appointments</a>
                            </div>
                        </div>
                    <?php
                            }
                        }else{
                            echo "<script>
                            alert('Please Login First');
                            window.location='login.php';</script>";
                        } 
                    ?>
            </div>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
</body>

</html>