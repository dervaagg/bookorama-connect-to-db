<?php

require_once('../connection/connection.php');
$id = $_GET['id'];


if (!isset($_POST["submit"])){
    $query = " SELECT * FROM books WHERE isbn=" .$id. " ";
    //execute the query
    $result = $conn->query($query);
    if (!$result){
        die ("Could not the query database: <br />" . $conn->error);
    } else {
        while ($row = $result->fetch_object()){
            $author = $row->author;
            $title = $row->title;
            $price = $row->price;
        }
    }
} else{

    $valid = TRUE; //flag validasi
    $author = test_input($_POST['author']);
    if ($author == ''){
        $error_author = "Author is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $author)){
        $error_author = "Only letters and white space allowed";
        $valid = FALSE;
    }

    $title = test_input($_POST['title']);
    if ($title == ''){
        $error_title = "Title is required";
        $valid = FALSE;
    }

    $price = $_POST['price'];
    if ($price == '' || $price == 'none'){
        $error_price = "Price is required";
        $valid = FALSE;
    }

    //add data into database
    if ($valid){
        //escape inputs data
        $author = $conn->real_escape_string($author); //menghapus tanda petik
        //asign a query
        $query = " UPDATE customers SET author='".$author."', title='".$title."', price='".$price."' WHERE isbn=".$id." ";
        //execute the query
        $result = $conn->query($query);
        if (!$result){
            die ("Could not the query the database: <br />" . $conn->error . '<br>Query:' .$query);
        } else{
            //ketika sudah di submit , maka akan langsung pindah ke halaman view_books.php
            $conn->close();
            header('Location: view_books.php');
        }
    }
}
?>