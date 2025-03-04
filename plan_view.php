<?php
session_start();
error_reporting(0);
include "include/header.php";
include "connection.php";

// Check if plan ID is provided
if (!isset($_POST['pid'])) {
    header("Location: plan.php");
    exit();
}

$plan_id = mysqli_real_escape_string($con, $_POST['pid']);
$sql = "SELECT * FROM membership_plans WHERE id = $plan_id";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) <= 0) {
    header("Location: plan.php");
    exit();
}

$plan = mysqli_fetch_assoc($result);

$fullname = $_SESSION['auth_user']['email'];
$sql1 = "SELECT * FROM users WHERE email = '$fullname'";

$result1 = mysqli_query($con, $sql1);
$user = mysqli_fetch_assoc($result1);

$sql_trainers = "SELECT * FROM trainers WHERE status='active'";
$result_trainers = mysqli_query($con, $sql_trainers);
?>

<link rel="stylesheet" href="css/plan.css">
<style>
    /* General Styles */
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
    }

    /* Plan Hero Section */
    .plan-hero {
        position: relative;
        background: url('img/plan.jpg') center/cover no-repeat;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .plan-hero h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    /* Plan Detail Layout */
    .plan-container {
        max-width: 1000px;
        margin: 50px auto 50px;
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .plan-row {
        display: flex;
        gap: 30px;
    }

    /* Booking Form */
    .plan-booking {
        flex: 1;
        background: #f8f9fa;
        padding: 25px;
        border-radius: 10px;
    }

    .plan-booking h3 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
    }

    /* Buttons */
    .btn-primary {
        background: #ff5733;
        padding: 12px 20px;
        font-size: 1.2rem;
        text-transform: uppercase;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s ease;
        width: 100%;
    }

    .btn-primary:hover {
        background: #e94b2b;
    }

    @media (max-width: 768px) {
        .plan-row {
            flex-direction: column;
        }

        .form-row {
            flex-direction: column;
        }
    }
</style>

<body>
    <?php include "include/nav.php" ?>
    <!-- Hero Section -->
    <div class="plan-hero">
        <h1><?php echo htmlspecialchars($plan['plan_name']); ?></h1>
    </div>

    <!-- Plan Detail Section -->
    <div class="container">
        <div class="plan-container">
            <div class="plan-header text-center">
                <h2><?php echo htmlspecialchars($plan['plan_name']); ?></h2>
                <h4 class="text-success plan-price">₹<?php echo number_format($plan['price'], 2); ?></h4>
                <p class="plan-duration"><?php echo $plan['duration']; ?> Days Membership</p>
            </div>

            <div class="plan-row">
                <!-- Booking Form -->
                <div class="plan-booking">
                    <h3>Membership Details</h3>
                    <form method="post" action="process_plan.php" enctype="multipart/form-data">
                        <input type="hidden" name="plan_id" value="<?php echo $plan['id']; ?>">

                        <!-- Two-Column Layout -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" id="full_name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" name="phone" id="phone" required
                                    pattern="[0-9]{10}"
                                    maxlength="10" minlength="10"
                                    placeholder="Enter 10-digit phone number"
                                    title="Phone number must be exactly 10 digits (numbers only)">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" value="<?php echo htmlspecialchars($plan['price'], ENT_QUOTES, 'UTF-8'); ?>"
                                    name="price" id="price" readonly
                                    min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="number" value="<?php echo $plan['duration'] ?>" name="duration" id="duration" readonly>
                                <p class="text-worning">In Day's</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="<?php echo $user['email'] ?>" id="email" required>
                                <p class="text-danger">Enter login Email Id</p>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" placeholder="98 example place,city,statu,pin code" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="membership_type">Membership Type</label>
                                <input type="text" value="<?php echo $plan['plan_name'] ?>" name="membership_type" id="membership_type" readonly>

                            </div>
                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" id="occupation" required>
                            </div>
                            <?php if ($plan['type'] === 'personal') { ?>
                                <div class="form-group">
                                    <label for="trainer">Select Personal Trainer</label>
                                    <select name="trainer_id" id="trainer" required>
                                        <option value="">-- Choose a Trainer --</option>
                                        <?php while ($trainer = mysqli_fetch_assoc($result_trainers)) : ?>
                                            <option value="<?php echo $trainer['id']; ?>">
                                                <?php echo htmlspecialchars($trainer['name']) . " (" . $trainer['specialization'] . ")"; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" accept="image/*" required>
                            </div>
                        </div>

                        <?php if (isset($_SESSION['auth_user'])): ?>
                            <button type="submit" name="book_plan" class="btn btn-primary">
                                Book This Plan
                            </button>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary"
                                onclick="return alert('Please login to book a membership plan.');">
                                Login to Book
                            </a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "include/footer.php"; ?>

</body>


</html>