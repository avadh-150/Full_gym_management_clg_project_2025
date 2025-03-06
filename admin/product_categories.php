<?php
session_start();
error_reporting(0);
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}
// Database connection
include "dbcon.php";

if (isset($_REQUEST['submit-btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Handle image upload
    $image = null; // Initialize the image variable
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "uploads/category/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
             // Create directory if it doesn't exist
             echo "<script>alert('.$targetDir. created successfully!');</script>";

        }

        $imageName = uniqid('', true) . '.' . strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imagePath = $targetDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image = $imageName; // Save only the image name (not full path)
            if (!empty($name)) {
                $sql = "INSERT INTO product_categories (name, image, status) VALUES ('$name', '$image', '$status')";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('Category added successfully!'); window.location.href = 'product_categories.php';</script>";
                } else {
                    echo "Error adding category: " . mysqli_error($con);
                }
            } else {
                echo "Please enter a category name.";
            }
        } else {
            die("Error: Unable to upload the image.");
        }
    }

    // Insert data into the database
    
}


if (isset($_POST['update-submit-btn'])) 
{
    $name = $_POST['name'];
    $status = isset($_POST['status']) ? 1 : 0; // Checkbox for status
    $cid = $_GET['category_id']; // Category ID passed in URL as a query parameter



    $upload_ok = true;
    $target_dir = "uploads/category/";
    $image = $_FILES['image']['name']; // Image filename
    $image_name = basename($_FILES['image']['name']);
    $target_file = $target_dir . $image_name;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Ensure directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    // Validate image upload
    if (!empty($image)) {
        if ($_FILES['image']['error'] !== 0) {
            echo "<p>Error: There was an issue uploading your file.</p>";
            $upload_ok = false;
        }

        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            echo "<p>The file is not a valid image.</p>";
            $upload_ok = false;
        }

        if ($_FILES['image']['size'] > 5242880) { // 5MB max
            echo "<p>Sorry, your file is too large. Maximum size allowed is 5MB.</p>";
            $upload_ok = false;
        }

        $allowed_file_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($image_file_type, $allowed_file_types)) {
            echo "<p>Sorry, only JPG, JPEG, PNG, and GIF files are allowed.</p>";
            $upload_ok = false;
        }
        if ($upload_ok) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $image_name;
            } else {
                echo "<p>Error: Unable to upload the file.</p>";
                $upload_ok = false;
            }
        }
    }

     // If no new image is uploaded, retain the old one
     if (empty($image)) {
        $image_query = "SELECT image FROM product_categories WHERE id = $cid";
        $result = mysqli_query($con, $image_query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $image = $row['image'];
        }
    }


    if (!empty($name) && !empty($cid)) {
        if ($upload_ok) {
            // Update the product in the database
            $query = "UPDATE product_categories SET  name = '$name',image = '$image',status =  '$status' WHERE id = $cid";

            $result = mysqli_query($con, $query);

            if (!$result) {
                $message = "Error updating category: " . $con->error;
            } else {
            echo "<script>alert('Category Updated successfully!'); window.location.href = 'product_categories.php';</script>";
            
        }

        // $stmt->close();
    } else {
        $message = "Please enter a category name and ensure the category ID is valid.";
    }
}
}
?>
<?php include "includes/header.php"?>
    <style>
        .message {
            text-align: center;
            margin: 10px 0;
            font-size: 1.2em;
            color: green;
        }
    </style>
</head>

<body>

    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    <?php include 'includes/topheader.php' ?>

    <?php $page = 'product_categories';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a><a href="products.php" class="current">GYM Products</a> <a href="product_categories.php" class="tip-bottom">Manamge Category</a> </div>
            <!-- <h1>Manage Entry Form</h1> -->
        </div>
        <div class="container-fluid">
            <hr>
            <?php if (isset($message)): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <div class="row-fluid">
                <?php if (!$_GET['category_id']) {
                ?>

                    <div class="span6">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                                <h5>Category-Information</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Category Name:</label>

                                        <div class="controls">
                                            <input type="text" id="name" class="span11" name="name" placeholder="Enter category name" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Display Status:</label>

                                        <div class="controls">
                                            <input type="checkbox" id="status" name="status" class="" checked>
                                            <label for="status" class="" style="display: inline;">Check to Display</label>

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Image :</label>
                                        <div class="controls">
                                            <input type="file" id="imageInput" class="span11" name="image" onchange="previewImage(event)" />
                                            <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;" />
                                        </div>
                                    </div>
                                    <script>
                                        function previewImage(event) {
                                            const file = event.target.files[0];
                                            const imagePreview = document.getElementById('imagePreview');
                                            const currentImage = document.getElementById('currentImage');

                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    // If current image exists, replace it
                                                    if (currentImage) {
                                                        currentImage.src = e.target.result;
                                                    } else {
                                                        // Otherwise, show the new image in the preview
                                                        imagePreview.src = e.target.result;
                                                        imagePreview.style.display = 'block';
                                                    }
                                                };
                                                reader.readAsDataURL(file);
                                            }
                                        }
                                    </script>

                                    <div class="widget-content nopadding">
                                        <div class="form-horizontal">

                                            <div class="form-actions text-center">
                                                <button type="submit" name="submit-btn" class="btn btn-success">Add Category</button>
                                            </div>
                                </form>

                            </div>



                        </div>
                    </div>


                    <?php

                } else {
                    if ($_GET['category_id']) {
                        $id = $_GET['category_id'];
                        $sql = "select * from product_categories where id=$id";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                                    <h5>Category-Information</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="control-group">
                                            <label class="control-label">Category Name:</label>

                                            <div class="controls">
                                                <input type="text" id="name" class="span11" name="name" value="<?php echo $row['name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Display Status:</label>

                                            <div class="controls">
                                                <input type="checkbox" id="status" name="status" class="" checked>
                                                <label for="status" class="" style="display: inline;">Check to Display</label>
                                                <span class="help-block">Note:if you want to display the category so make sure the check box is tik</span>

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Image :</label>
                                            <div class="controls">
                                                <input type="file" id="imageInput" class="span11" name="image" onchange="previewImage(event)" />
                                                <!-- Display the existing product image -->
                                                <?php if (!empty($row['image'])): ?>
                                                    <img id="currentImage" src="uploads/category/<?= $row['image'] ?>" alt="Product Image" style="max-width: 100px;" />
                                                <?php endif; ?>
                                                <!-- New image preview -->
                                                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;" />
                                            </div>
                                        </div>
                                        <script>
                                            function previewImage(event) {
                                                const file = event.target.files[0];
                                                const imagePreview = document.getElementById('imagePreview');
                                                const currentImage = document.getElementById('currentImage');

                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.onload = function(e) {
                                                        // If current image exists, replace it
                                                        if (currentImage) {
                                                            currentImage.src = e.target.result;
                                                        } else {
                                                            // Otherwise, show the new image in the preview
                                                            imagePreview.src = e.target.result;
                                                            imagePreview.style.display = 'block';
                                                        }
                                                    };
                                                    reader.readAsDataURL(file);
                                                }
                                            }
                                        </script>



                                        <div class="widget-content nopadding">
                                            <div class="form-horizontal">

                                                <div class="form-actions text-center">
                                                    <button type="submit" name="update-submit-btn" class="btn btn-success">Update Category</button>
                                                </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                <?php
                    } else {
                        $message = "something went wrong";
                    }
                } ?>

                <div class="span6" style='width: 1100px;'>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Category table</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <?php

                            include "dbcon.php";
                            $qry = "select * from product_categories";
                            $cnt = 1;
                            $result = mysqli_query($con, $qry);


                            echo "<table class='table table-bordered table-hover'>
        <thead>
          <tr>
            <th>#</th>
            <th>Category Image</th>
            <th>Category Name</th>
            
            <th>Category Status</th>
            <th>Action</th>
          
          </tr>
        </thead>";

                            while ($row = mysqli_fetch_array($result)) {
                                // $display = 
                                
                                if($row['status'] == '1'){
                                     $display= " <p class='badge badge-success text-center'>ACTIVE</p>";
                                    }
                                    else{
                                        $display= "<p class='badge badge-warging text-center'>INACTIVE</p>";
                                    }
                                echo "<tbody> 
         
          <td><div class='text-center'>" . $cnt . "</div></td>
          <td><div class='text-center'>";
                                  if ($row['image']) {
                                      echo "<img src='uploads/category/" . $row['image'] . "' alt='catecory Image' style='width: 50px; height: 50px;'>";
                                  } else {
                                      echo "No Image";
                                  }
                                  echo "</div></td>
          <td><div class='text-center'>" . $row['name'] . "</div></td>
          
          </td>
          <td><div class='text-center'>" . $display . "</div>
          
          </td>
        
          <td><div class='text-center'>
          <a href='product_categories.php?category_id=" . $row['id'] . "'><i class='fas fa-edit'></i> </a> | 
          <a href='actions/delete-member.php?category_id=" . $row['id'] . "' style='color:#F66;'><i class='fas fa-trash'></i> </a></div>
          
</td>
          
        </tbody>";
                                $cnt++;
                            }
                            ?>

                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


    </div>
    </div>


    <!--end-main-container-part-->

    <!--Footer-part-->

    <div class="row-fluid">
        <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Developed By GYM FITNESS CLUB CENTER</a> </div>
    </div>

    <style>
        #footer {
            color: white;
        }
    </style>

    <!--end-Footer-part-->

    <script src="../js/excanvas.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.flot.min.js"></script>
    <script src="../js/jquery.flot.resize.min.js"></script>
    <script src="../js/jquery.peity.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/matrix.js"></script>
    <script src="../js/matrix.dashboard.js"></script>
    <script src="../js/jquery.gritter.min.js"></script>
    <script src="../js/matrix.interface.js"></script>
    <script src="../js/matrix.chat.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/matrix.form_validation.js"></script>
    <script src="../js/jquery.wizard.js"></script>
    <script src="../js/jquery.uniform.js"  ></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/matrix.popover.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/matrix.tables.js"></script>

    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>
    </body>

</html>