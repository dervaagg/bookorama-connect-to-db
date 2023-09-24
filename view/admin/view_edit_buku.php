<?php
require_once('../../connection/connection.php');
include ('../sidebar.php');

$id = $_GET['id'];

// Variables for form fields and error messages
$author = $title = $category = $price = '';
$error_author = $error_title = $error_category = $error_price = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // Validasi data yang dikirim melalui formulir
    $author = test_input($_POST['author']);
    $title = test_input($_POST['title']);
    $category = test_input($_POST['category']);
    $price = test_input($_POST['price']);

    if (empty($author)) {
        $error_author = "Author is required";
        $valid = false;
    }

    if (empty($title)) {
        $error_title = "Title is required";
        $valid = false;
    }

    if (empty($category)) {
        $error_category = "Category is required";
        $valid = false;
    }

    if (empty($price)) {
        $error_price = "Price is required";
        $valid = false;
    }

    // Jika semua validasi sukses, simpan perubahan ke database
    if ($valid) {
        // Escape data
        $author = $conn->real_escape_string($author);
        $title = $conn->real_escape_string($title);
        $category = $conn->real_escape_string($category);
        $price = $conn->real_escape_string($price);

        // Query untuk mengupdate data buku ke database
        $query = "UPDATE books SET author='$author', title='$title', category='$category', price='$price' WHERE isbn=$id";

        if ($conn->query($query) === true) {
            // Jika query berhasil, kembali ke halaman view_books.php
            header("Location: view_books.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
}

// Mengambil data buku dari database
$query = "SELECT * FROM books WHERE isbn=" . $id;
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $author = $row['author'];
        $title = $row['title'];
        $category = $row['category'];
        $price = $row['price'];
    }
}

// Tutup koneksi database
$conn->close();
?>
    <div class="center-card" style="display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;">
        <div class="card" style="border: none ; width: 50rem;">
            <div class="card-header" style="border: none; background-color: white;"><b>Edit Buku</b></div>
            <div class="card-body">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id) ?>" method="POST">
                    <div class="mb-2">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $id ?>" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author" value="<?= (isset($_GET['author'])) ?>">
                        <div class="error"><?= $error_author ?></div>
                    </div>
                    <div class="mb-2">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
                        <div class="error"><?= $error_title ?></div>
                    </div>
                    <div class="mb-2">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" value="<?= $category ?>">
                        <div class="error"><?= $error_category ?></div>
                    </div>
                    <div class="mb-2">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $price ?>">
                        <div class="error"><?= $error_price ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
<?php
include('../footer.php');
?>