<?php
    $conn = mysqli_connect("localhost", "root", "root", "bookorama");
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>