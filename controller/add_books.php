<?php
include 'connection.php';

$isbn = $_POST['isbn'];
$title = $_POST['title'];
$category = $_POST['category'];
$author = $_POST['author'];
$price = $_POST['price'];

mysqli_query($conn,"insert into books values('','$isbn','$title','$category','$author','$author','$price')");

header("location:index.php");
