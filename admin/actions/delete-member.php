<?php

session_start();
include 'dbcon.php';

//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];



    $qry = "delete from users where user_id=$id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        echo "DELETED";
        header('Location:../member.php');
    } else {
        echo "ERROR!!";
    }
}


if (isset($_GET['remove_id'])) {
    $id = $_GET['remove_id'];



    $qry = "delete from admin where a_id=$id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        echo "DELETED";
        header('Location:../remove-admins.php');
    } else {
        echo "ERROR!!";
    }
}


if (isset($_GET['plans_id'])) {
    $id = $_GET['plans_id'];



    $qry = "delete from membership_plans where id=$id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        echo "DELETED";
        header('Location:../plans.php');
    } else {
        echo "ERROR!!";
    }
}
if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];



    $qry = "delete from product_categories where id=$id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        echo "DELETED";
        header('Location:../product_categories.php');
    } else {
        echo "ERROR!!";
    }
}

if (isset($_GET['pro_id'])) {
    $id = $_GET['pro_id'];



    $qry = "delete from products where id=$id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        echo "DELETED";
        header('Location:../products.php');
    } else {
        echo "ERROR!!";
    }
}
// users delete
if (isset($_GET['users_id'])) {
    $id = $_GET['users_id'];



    $qry = "delete from users where id=$id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        echo "<script>alert('Users is deleted successfully');
        window.location.href='../update-users.php'</script>";
    } else {
        echo "ERROR!!";
    }
}


?>
