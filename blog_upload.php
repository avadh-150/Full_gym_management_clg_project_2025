<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Gym Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="assets/css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Styling for the form */
        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 2rem;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

    <section class="home-slider-loop-false inner-page owl-carousel">
        <div class="slider-item" style="background-image: url('img/pic-15.jpg');">
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center">
                    <div class="col-md-8 text-center col-sm-12 element-animate">
                        <h1>Upload Fitness Club Blog</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <h1>Upload a New Blog</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Blog Title:</label>
        <input type="text" name="title" id="title" placeholder="Enter the blog title" required>

        <label for="content">Blog Content:</label>
        <textarea name="content" id="content" placeholder="Write your blog content here..." required></textarea>

        <label for="image">Optional: Upload Blog Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit" name="submit">Upload Blog</button>
    </form>

    <?php include "include/footer.php"; ?>
</body>
</html>

<?php
// Database connection
include "connection.php"; // Ensure this contains the variable $con for the database connection

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $imagePath = null;

    // Handle image upload if an image is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/blogs/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow only image file formats
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Create the uploads directory if it doesn't exist
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $imagePath = $targetFilePath; // Save image path for database insertion
            } else {
                echo '<p class="error">Error uploading the image file.</p>';
            }
        } else {
            echo '<p class="error">Invalid file format. Please upload JPG, JPEG, PNG, or GIF files.</p>';
        }
    }

    // Insert blog data into the database
    $sql = "INSERT INTO gym_blogs (title, content, image_path) VALUES ('$title', '$content', '$imagePath')";
    if (mysqli_query($con, $sql)) {
        echo '<p class="success">Blog uploaded successfully!</p>';
    } else {
        echo '<p class="error">Database error: ' . mysqli_error($con) . '</p>';
    }
}

// Close the database connection
mysqli_close($con);
?>
