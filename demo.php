<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Image</title>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="user_id">Enter User ID:</label>
    <input type="text" id="user_id" name="user_id" required>
    <br><br>

    <label for="image">Select Image:</label>
    <input type="file" id="image" name="image" accept="image/*" required>
    <br><br>

    <input type="submit" value="Upload Image">
</form>

</body>
</html>

<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate user input
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $image = $_FILES['image'];

    // Check if image is uploaded
    if (empty($user_id) || $image['error'] != 0) {
        echo "Please enter a valid User ID and upload an image.";
        exit;
    }

    // Set the target directory for image uploads
    $target_dir = "uploads/";

    // Get the file extension
    $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    
    // Create a unique filename to avoid overwriting
    $target_file = $target_dir . $user_id . "_" . time() . "." . $imageFileType;

    // Check if the file is an actual image
    if (!getimagesize($image['tmp_name'])) {
        echo "The file is not a valid image.";
        exit;
    }

    // Validate file size (5MB limit)
    if ($image['size'] > 5000000) {
        echo "The file is too large. Maximum allowed size is 5MB.";
        exit;
    }

    // Allow certain file formats (e.g., jpg, jpeg, png)
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        echo "Only JPG, JPEG, and PNG files are allowed.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $target_file)) {
        // Database connection using procedural mysqli
        $conn = mysqli_connect('localhost', 'root', '', 'gymphp');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the user_id exists in the database
        $check_user_query = "SELECT * FROM staffs WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $check_user_query);

        // If the user exists, update the image
        if (mysqli_num_rows($result) > 0) {
            $update_query = "UPDATE staffs SET image = '$target_file' WHERE user_id = '$user_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "Image uploaded and data updated successfully.";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "No user found with the specified user_id.";
        }

        // Close connection
        mysqli_close($conn);
    } else {
        echo "There was an error uploading your file.";
    }
}
?>
