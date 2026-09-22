<?php

$servername = "sql207.infinityfree.com";
$username = "if0_42626922";
$password = "Ratheesh0413";
$database = "if0_42626922_pu_job_portal";
$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $database
);

if (!$conn) {
    die("Database connection failed");
}

?>