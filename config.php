<?php

$conn = mysqli_connect("localhost", "root", "", "gymphp");

if (!$conn) {
    echo "Connection Failed";
}