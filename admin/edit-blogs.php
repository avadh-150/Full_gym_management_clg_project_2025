<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}
?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
</head>

<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    <?php include 'includes/topheader.php' ?>


    <!--sidebar-menu-->
    <?php $page = 'blogs';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->

    <?php
    include 'dbcon.php';
    $id = $_GET['id'];
    $qry = "select * from gym_blogs where id='$id'";
    $result = mysqli_query($con, $qry);
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <div id="content">
            <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="Blogs.php" class="tip-bottom">Manamge Blogs</a> <a href="#" class="current">Update Blog</a> </div>
            <h1>Blogs Update Form</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                                <h5>Plans-information</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" onsubmit="updateNicEdit()">
                                    <div class="control-group">
                                        <label class="control-label">Title Name</label>
                                        <div class="controls">
                                            <input type="text" class="span11" name="name" value="<?php echo $row['title'] ?>" />
                                        </div>
                                    </div>
                                   
                                    <div class="control-group">
                                    <label class="control-label">Picture :</label>
                                    <div class="controls">
                                        <input type="file" class="span11" name="image" />
                                        <img src="<?php echo $row['image_path']?>" alt="" width="100px" height="100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                                <h5>Features Details</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="form-horizontal">
                                <div class="control-group">
                                    <!-- <label for="normal" class="control-label">Plan Features:</label> -->
                                    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

                                    <textarea name="feature" style="width: 100%;" id="feature" class="form-control" cols="20" rows="10">
                                    <?php echo htmlspecialchars(trim($row['content'])); ?>

                                        </textarea>
                                    <script type="text/javascript">
                                        bkLib.onDomLoaded(function() {
                                            new nicEditor({
                                                fullPanel: true
                                            }).panelInstance('feature');
                                        });

                                        function updateNicEdit() {
                                            document.getElementById('feature').value = nicEditors.findEditor('feature').getContent();
                                        }
                                    </script>

                                    </div>

                                </div>
                                <div class="widget-content nopadding">
                                    <div class="form-horizontal">

                                        <div class="form-actions text-center">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                            <button type="submit" name="submit-btn" class="btn btn-success">Update Details</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                        ?>
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
        <script src="../js/jquery.uniform.js"></script>
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
<?php
// Database connection
include "dbcon.php"; // Ensure this contains the variable $con for the database connection

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_REQUEST['submit-btn'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['name']);
    $content = mysqli_real_escape_string($con, $_POST['feature']);
    $imagePath = null;

    // Fetch the existing image path before updating
    $query = "SELECT image_path FROM gym_blogs WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $existingImage = $row['image_path'];

    // Handle image upload if a new image is selected
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
                $imagePath = $targetFilePath; // Save image path for database update

                // Delete the old image if a new one is uploaded
                if (!empty($existingImage) && file_exists($existingImage)) {
                    unlink($existingImage);
                }
            } else {
                echo '<p class="error">Error uploading the image file.</p>';
            }
        } else {
            echo '<p class="error">Invalid file format. Please upload JPG, JPEG, PNG, or GIF files.</p>';
        }
    } else {
        // If no new image is uploaded, retain the existing image
        $imagePath = $existingImage;
    }

    // Update blog data in the database
    $sql = "UPDATE gym_blogs SET title = '$title', content = '$content', image_path = '$imagePath' WHERE id = '$id'";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Blog updated successfully!');
        window.location.href='blogs.php';
        </script>";
    } else {
        echo "<script>alert('Blog update failed! ". mysqli_error($con) . "');
        window.location.href='blogs.php';
        </script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
