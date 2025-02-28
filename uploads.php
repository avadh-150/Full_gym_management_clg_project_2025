<!DOCTYPE html>
<html lang="en">
<head>
    <title>FITNESS CLUB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
            max-width: 500px;
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

        input[type="file"] {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
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
<?php include "include/nav.php"; ?>

    <section class="home-slider-loop-false inner-page owl-carousel">
        <div class="slider-item" style="background-image: url('img/fitness.jpg');">
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center">
                    <div class="col-md-8 text-center col-sm-12 element-animate">
                        <h1>Uploads Images of Club</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <h1>Upload Gym Fitness Club Images</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br>
        <button type="submit" name="submit">Upload Image</button>
    </form>
    <p></p>

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
    // Check if an image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/"; // Directory to store uploaded images
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Create the uploads directory if it doesn't exist
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // Insert image path into the database
                $sql = "INSERT INTO gym_images (image_path) VALUES ('$targetFilePath')";
                if (mysqli_query($con, $sql)) {
                    echo '<script>alert("Image uploaded successfully!");
                    
                    
                    </script>';
                    //window.location.href ="gallery.php";
                } else {
                   
                    echo '<p class="error">Database error: ' . mysqli_error($con) . '</p>';
                }
            } else {
                echo '<script>alert("Error uploading the image file!");
                </script>';
            }
        } else {
            echo '<script>alert("Invalid file format. Please upload JPG, JPEG, PNG, or GIF files!");
            </script>';
            
        }
    } else {
        echo '<script>alert("Please select an image file to upload!");
        </script>';
    }
}

// Close the database connection
mysqli_close($con);
?>
