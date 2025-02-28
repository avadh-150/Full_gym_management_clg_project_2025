<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

?>
            

<!DOCTYPE html>
<html lang="en">

<head>
<?php include "includes/header.php";?>
</head>

<body>
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>


    <?php include 'includes/topheader.php' ?>

    <?php $page = 'reply';

    include 'includes/sidebar.php' ?>
    <?php
    if(isset($_GET['mark_as_read']))
{
    include "dbcon.php";

    $id=$_GET['mark_as_read'];

    $sql="select * from contact where id=$id";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        foreach($res as $row){
            ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i>Home</a> <a href="#" class="tip-bottom">Reply query</a>
            
            </div>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="alert alert-info">
                Message :<br>
                <?php echo $row['message'];?>
        </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Answer</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="" method="POST" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" value="<?=$row['name']?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email :</label>
                                    <div class="controls">
                                        <input type="email" class="span11" name="email" value="<?=$row['email']?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="message">Message :</label>
                                    <div class="controls">
                                        <textarea class="form-control" id="Message" name="Message" placeholder="Please enter your message here..." rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="widget-content nopadding">
                                    <div class="form-horizontal">

                                        <div class="form-actions text-center">
                                            <button type="submit" name="Login" class="btn btn-success">Send</button>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    }
}
}
?>
    </div>
    </div>
    <div class="row-fluid">
        <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Developed By GYM FITNESS CLUB CENTER</a> </div>
    </div>
    <style>
        #footer {
            color: white;
        }
    </style>


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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');

require('PHPMailer/SMTP.php');

require('PHPMailer/PHPMailer.php');


if(isset($_REQUEST['Login'])) 
{
 $name=$_POST['name'];
 $email=$_POST['email'];
 $message=$_POST['Message'];

 $mail = new PHPMailer(true);

 try {
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'avadhradadiya293@gmail.com';
     $mail->Password = 'nxvv aqtu igeh cytg';
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
     $mail->Port = 465;

     $mail->setFrom('avadhradadiya293@gmail.com', $name);
     $mail->addAddress($email);

     $mail->isHTML(true);
     $mail->Subject = 'Profitness Gym';
     $email_template = "Name: $name <br> Email: $email <br> Message: $message";
     $mail->Body = $email_template;

     $mail->send();
     echo "<script>alert('Message has been sent')
     window.location.href='contact_replay.php?mark_as_read=".$_GET['mark_as_read']."'
     </script>";

 } catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }
}
?>
