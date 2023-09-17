<?php
    $conn = mysqli_connect("localhost", "root", "root", "pbp_crud");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>