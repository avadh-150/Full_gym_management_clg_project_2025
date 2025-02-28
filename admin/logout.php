<?php
session_start();
session_destroy();
header('location:http://localhost/gymphp/admin/login.php');
?>