<?php
include ('../sidebar.php');
include '../../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $categoryid = $_POST['categoryid'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    $query = "INSERT INTO books (isbn, title, categoryid, author, price) VALUES ('$isbn', '$title', '$categoryid', '$author', '$price')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Buku berhasil ditambahkan')</script>.";
        header('Location: ./view_available_buku.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
    <div class="center-card mt-4" style="margin-left: 18%; margin-right: 1%; border: none;">
        <div class="card" style="border:none ; width: 50rem;">
            <div class="card-header" style="border: none; background-color: white;"><b>Tambah Buku</b></div>
            <div class="card-body">
                <div class="box">
                    <div class="box-header">
                        <form method="POST" action="">
                            <div class="mb-2">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input id="isbn" name="isbn" class="form-control" type="text" placeholder="Masukan Nomor ISBN" aria-label="default input example">
                            </div>
                            <div class="mb-2">
                                <label for="author" class="form-label">Author</label>
                                <input id="author" name="author" class="form-control" type="text" placeholder="Masukan Nama Penulis" aria-label="default input example">
                            </div>
                            <div class="mb-2">
                                <label for="title" class="form-label">Title</label>
                                <input id="title" name="title" class="form-control" type="text" placeholder="Masukan Judul Buku" aria-label="default input example">
                            </div>
                            <div class="mb-2">
                                <label for="categoryid" class="form-label">Category</label>
                                <select name="categoryid" class="form-select" aria-label="Default select example">
                                    <option value="">--Select Category--</option>
                                    <?php
                                    $category = mysqli_query($conn, "SELECT * FROM categories");
                                    while ($c = mysqli_fetch_array($category)) {
                                    ?>
                                        <option value="<?php echo $c['categoryid'] ?>"><?php echo $c['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="price" class="form-label">Price</label>
                                <input id="price" name="price" class="form-control" type="text" placeholder="Masukan Harga Buku" aria-label="default input example">
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-warning">Tambah Buku</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include('../footer.php');
?>