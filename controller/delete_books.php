<?php
    require_once("../connection/connection.php");
    $id = $_GET['id'];
    $query =  "delete from books where isbn = '" . $id . "'";
    $result = $conn->query($query);
    if(!$result) die("Database access failed: " . $conn->error . "<br>Query: " . $query);

    header("Location: ../view/admin/view_available_buku.php");
    $result->free();
    $conn->close();
?>
