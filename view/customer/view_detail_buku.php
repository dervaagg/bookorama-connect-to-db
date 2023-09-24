

<?php
require_once("../../connection/connection.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .center-card {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <div class="center-card">
        <div class="card" style="border:none ; width: 50rem;">
            <div class="card-header" style="border: none; background-color: white;"><b>Detail Buku</b></div>
            <div class="card-body">
                <div class="box">
                    <div class="box-header">
                        <div class="row justify-content-between">
                            <div class="">
                                <?php
                                    $id = $_GET['id'];
                                    $query = "select books.isbn, books.author, books.title, categories.name, books.price from books left join categories on books.categoryid = categories.categoryid where isbn = '$id'";
                                    $result = $conn->query($query);

                                    while($row = $result->fetch_object()) {
                                        $book_isbn = $row->isbn;
                                        $book_author = $row->author;
                                        $book_title = $row->title;
                                        $book_category = $row->name;
                                        $book_price = $row->price;
                                    }
                                ?>
                                <div class=" mb-2">
                                    <label for="exampleFormControlInput1" class="form-label" style="font-weight: bold;">ISBN</label>
                                    <p><?php echo $book_isbn ?></p>
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="font-weight: bold;">Author</label>
                                    <p><?php echo $book_author ?></p>
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label" style="font-weight: bold;">Title</label>
                                    <p><?php echo $book_title ?></p>
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="font-weight: bold;">Category</label>
                                    <p><?php echo $book_category ?></p>
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label" style="font-weight: bold;">Price</label>
                                    <p><?php echo $book_price ?></p>
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label" style="font-weight: bold;">Review</label>
                                    <?php
                                        $query = "select * from book_reviews where isbn = '$book_isbn'";
                                        $result = $conn->query($query);
                                        while ($row = $result->fetch_object()) {
                                            echo '<p>' . $row->review . '</p>';
                                        }
                                    ?>
                                    <?php
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $review = $_POST['review'];
                                            $isbn = $book_isbn;
                                        
                                            $query = "INSERT INTO book_reviews (isbn, review) VALUES ('$isbn', '$review')";
                                        
                                            if (mysqli_query($conn, $query)) {
                                                echo "<script>alert('Review ditambahkan!')</script>.";
                                                header('Location: ./view_detail_buku.php?id=' . $book_isbn . '');
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
                                        }
                                    ?>
                                    <form action="" method="POST">
                                        <input name="review" id="review" type="text" class="form-control" />
                                        <div class="text-right" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="./view_available_buku.php" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>