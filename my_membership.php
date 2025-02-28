<?php include "include/header.php"; ?>

<body>

    <!-- Navigation -->
    <?php include "include/nav.php"; ?>

    <!-- Cart Section -->
    <section class="section element-animate" style="height:800px;">
        <div class="container" id="body">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a> / </li>
                    <li class="active">My Membership</li>
                </ol>
            </div>
            <div class="col-md-12">
                <?php 
                if (isset($_SESSION['auth_user'])) {
                    require_once 'admin/dbcon.php';
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $user_query = "SELECT * FROM users WHERE id = $user_id";
                    $user_result = mysqli_query($con, $user_query);
                    $user = mysqli_fetch_assoc($user_result);
                    $member_id = $user['member_id'];
                    // echo "<script>alert('$member_id');</script>";
                    $pay_user = "SELECT p.*, m.end_date AS edate, m.start_date AS sdate, m.status, m.id,m.member_id as member_id,pay.amount as price,p.plan_name as plan_name
                     FROM membership_plans p, payments pay,member_plans m 
                     WHERE p.id = m.plan_id 
                     AND m.payment_id = pay.id 
                     AND m.member_id = '$member_id' and pay.user_id='$user_id'";

                    $pay_result = mysqli_query($con, $pay_user);
                    
                    if (!$pay_result) {
                        echo "Error executing query: " . mysqli_error($con);
                    } elseif (mysqli_num_rows($pay_result) > 0) {
                        ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Membership Type</th>
                                    <th width="130px">Price</th>
                                    <th width="120px">Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($product = mysqli_fetch_assoc($pay_result)) 
                            { 
                                // Determine status label
                                switch($product['status']) {
                                    case '1':
                                        $status = '<label style="background-color:#acbd58; color:#000; padding:5px 10px; border-radius:3px;">Active</label>';
                                        break;
                                    case '0':
                                        $status = '<label style="background-color:#f6f858; color:#000; padding:5px 10px; border-radius:3px;">Inactive</label>';
                                        break;
                                    case '2':
                                        $status = '<label style="background-color:#51ff82; color:#000; padding:5px 10px; border-radius:3px;">Expired</label>';
                                        break;
                                }
                                
                                // Determine remainder status
                                // $remainder_status = ($product['remainder'] == '1') 
                                //     ? '<label style="background-color:#ffff07; color:#000; padding:5px 10px; border-radius:3px;">Notify to Renew your membership</label>'
                                //     : '<label style="background-color:#63f858; color:#000; padding:5px 10px; border-radius:3px;">Active</label>';
                                ?>
                                <tr class="product-content">
                                    <td><?= htmlspecialchars($product['id']) ?></td>
                                    <td><?= htmlspecialchars($product['plan_name']) ?></td>
                                    <td><?= htmlspecialchars($product['price']) ?></td>
                                    <td><?= htmlspecialchars($product['sdate']) ?></td>
                                    <td><?= htmlspecialchars($product['edate']) ?></td>
                                    <td><?= $status ?></td>
                                        <td>
                                        <a href="member-view.php?member_id=<?= htmlspecialchars($product['member_id']) ?>" class="btn btn-primary btn-sm">view detail..</a>
                                    </td>
                                    <!-- <td><?= $remainder_status ?></td> -->
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="alert alert-warning text-center">
                            <b><i class="fas fa-exclamation-triangle"></i> No membership plan is Active</b>
                        </div>
                    <?php }
                } else { ?>
                    <div class="alert alert-warning text-center">
                        <b>Please login to view membership details.</b>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
</body>

</html>