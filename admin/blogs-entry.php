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

    <!--Header-part--><!-- Visit codeastro.com for more projects -->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    <?php include 'includes/topheader.php' ?>

    <?php $page = 'plans-entry';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="Blogs.php" class="tip-bottom">Manamge Blogs</a> <a href="#" class="current">Add Blog</a> </div>
            <h1>Blogs Entry Form</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Blogs-information</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" onsubmit="updateNicEdit()">
                                <div class="control-group">
                                    <label class="control-label">Add Title</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" placeholder="Title Name" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image:</label>
                                    <div class="controls">
                                        <input type="file" class="span11" name="image" placeholder="Like Personal or Others"/>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Feature Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <!-- <label for="normal" class="control-label">Plan Features:</label> -->
                                    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

                                    <textarea name="feature" style="width: 100%;" id="feature" class="form-control" cols="20" rows="10">

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
                                        <!-- <input type="text" name="id" id="" values> -->
                                        <button type="submit" name="submit" class="btn btn-success">Submit Blogs Details</button>
                                    </div>
                                    </form>
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

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['name']);
    $content = mysqli_real_escape_string($con, $_POST['feature']);
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
        echo "<script>alert('Blog uploaded successfully!');
        window.location.href='blogs.php';
        </script>";
    } else {
        echo "<script>alert('Blog not uploaded try again! ". mysqli_error($con) . "');
        window.location.href='blogs.php';
        </script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
