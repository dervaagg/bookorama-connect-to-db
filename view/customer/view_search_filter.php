<?php 
    include('header.php');
    require_once('../../connection/connection.php');
?>

    <div class="card mt-5 mb-5">
        <h5 class="card-header" style="text-align: center">Pencarian Buku</h5>
        <div class="card-body">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="on">
                <div class="form-group mb-2">
                    <label for="category">Kategori:</label>
                    <select name="categoryid" id="categoryid" class="form-control" required>
                        <option value="Semua" <?php if (isset($_POST['categoryid']) && $_POST['categoryid'] == "Semua") echo 'selected' ?>>Semua</option>
                        <option value="1" <?php if (isset($_POST['categoryid']) && $_POST['categoryid'] == "1") echo 'selected' ?>>Novel</option>
                        <option value="2" <?php if (isset($_POST['categoryid']) && $_POST['categoryid'] == "2") echo 'selected' ?>>Majalah</option>
                        <option value="3" <?php if (isset($_POST['categoryid']) && $_POST['categoryid'] == "3") echo 'selected' ?>>Biografi</option>
                        <option value="4" <?php if (isset($_POST['categoryid']) && $_POST['categoryid'] == "4") echo 'selected' ?>>Komik</option>
                        <option value="5" <?php if (isset($_POST['categoryid']) && $_POST['categoryid'] == "5") echo 'selected' ?>>Panduan</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="isbn">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?= isset($_POST['isbn']) ? $_POST['isbn'] : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?= isset($_POST['author']) ? $_POST['author'] : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="title">Judul Buku</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="minPrice">Harga Minimal</label>
                    <input type="text" class="form-control" id="minPrice" name="minPrice" value="<?= isset($_POST['minPrice']) ? $_POST['minPrice'] : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="maxPrice">Harga Maksimal</label>
                    <input type="text" class="form-control" id="maxPrice" name="maxPrice" value="<?= isset($_POST['maxPrice']) ? $_POST['maxPrice'] : ''; ?>">
                </div>
                <div class = "text-center">
                    <button type="submit" class="btn btn-outline-primary mt-2 mb-4" name="submit">Cari</button>
                </div>
                <div class="error"><?php if (isset($error_price)) echo $error_price ?></div>
            </form>

    <?php

        require_once('../../connection/connection.php');
        
        $query = "SELECT isbn AS ISBN, title AS Title, categoryid AS Category, author AS Author, price AS Price FROM books WHERE 1";
        
        if (!isset($_POST['submit'])){
            $ISBN = '';
            $Author = '';
            $Title = '';
            $minPrice = '';
            $maxPrice = '';

            $result = $conn->query($query);
    
            if (!$result) {
                die("Query yang diberikan salah: <br />" . $conn->error . "<br>Query: " . $query);
            } 

            echo '<table class="table table-striped text-center">';
            echo '<tr>';
            echo '<th>ISBN</th>';
            echo '<th>Title</th>';
            echo '<th>Category</th>';
            echo '<th>Author</th>';
            echo '<th>Price</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->ISBN . '</td>';
                echo '<td>' . $row->Title . '</td>';
                echo '<td>' . $row->Category . '</td>';
                echo '<td>' . $row->Author . '</td>';
                echo '<td>' . $row->Price . '</td>';
                echo '<td><a class="btn btn-outline-primary btn-sm" href="./view_detail_buku.php?id=' . $row->ISBN . '">Detail</a>&nbsp;<a class="btn btn-warning btn-sm" href="./view_cart.php?id=' . $row->ISBN . '">+ Add To Cart</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';

            $result->free();

            $conn->close();

        }
        else {
            $valid = TRUE;
            
            $Category = $_POST['categoryid'];
            if ($Category != "Semua") {
                $query .= " AND categoryid = '$Category'";
            }

            $ISBN = test_input($_POST['isbn']);
            if (isset($ISBN) && !empty($ISBN)) {
                $query .= " AND (isbn LIKE '%$ISBN%')";
            }

            $Title = test_input($_POST['title']);
            if (isset($Title) && !empty($Title)) {
                $query .= " AND (title LIKE '%$Title%')";
            }
            
            $Author = test_input($_POST['author']);
            if (isset($Author) && !empty($Author)) {
                $query .= " AND (author LIKE '%$Author%')";
            }

            $minPrice = test_input($_POST['minPrice']);
            $maxPrice = test_input($_POST['maxPrice']);
            if (!empty($minPrice) && !empty($maxPrice)) {
                if (!is_numeric($minPrice) && !is_numeric($maxPrice)) {
                    $error_price = "Harga buku harus berupa numerik!";
                    $valid = FALSE;
                } else {
                    $query .= " AND price BETWEEN $minPrice AND $maxPrice ORDER BY price";
                }
            } else if (!empty($minPrice)) {
                if (!is_numeric($minPrice)) {
                    $error_price = "Harga buku harus berupa numerik!";
                    $valid = FALSE;
                } else {
                    $query .= " AND price >= $minPrice ORDER BY price";
                }
            } else if (!empty($maxPrice)) {
                if (!is_numeric($maxPrice)) {
                    $error_price = "Harga buku harus berupa numerik!";
                    $valid = FALSE;
                } else {
                    $query .= " AND price <= $maxPrice ORDER BY price";
                }
            }

            if ($valid){
                $result = $conn->query($query);
    
                if (!$result) {
                    die("Query yang diberikan salah: <br />" . $conn->error . "<br>Query: " . $query);
                } 
    
                echo '<table class="table table-striped text-center">';
                echo '<tr>';
                echo '<th>ISBN</th>';
                echo '<th>Title</th>';
                echo '<th>Category</th>';
                echo '<th>Author</th>';
                echo '<th>Price</th>';
                echo '<th>Action</th>';
                echo '</tr>';
    
                // Tampilkan data
                while ($row = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . $row->ISBN . '</td>';
                    echo '<td>' . $row->Title . '</td>';
                    echo '<td>' . $row->Category . '</td>';
                    echo '<td>' . $row->Author . '</td>';
                    echo '<td>' . $row->Price . '</td>';
                    echo '<td><a class="btn btn-outline-primary btn-sm" href="./view_detail_buku.php?id=' . $row->ISBN . '">Detail</a>&nbsp;<a class="btn btn-warning btn-sm" href="./view_cart.php?id=' . $row->ISBN . '">+ Add To Cart</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
                echo '</div>';

                $result->free();
    
                $conn->close();
            }

        } 

    include('footer.php');
?>