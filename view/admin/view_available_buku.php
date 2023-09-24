<?php
require_once("../../connection/connection.php");
include('../sidebar.php');
?>
<div class="card" style="margin-left: 18%; margin-right: 1%; border:none">
    <!-- <div class="card-header">Data Buku</div> -->
    <div style="display: flex; justify-content: end; padding-right: 10px;">
        <a class="btn btn-primary" href="view_tambah_buku.php"><span style="font-weight: bold;">+</span> Tambah Buku</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th style="text-align: center">ISBN</th>
                <th style="text-align: center">Title</th>
                <th style="text-align: center">Category</th>
                <th style="text-align: center">Author</th>
                <th style="text-align: center">Price</th>
                <th style="text-align: center">Action</th>
            </tr>
            <?php

            // execute the query
            $query = " SELECT * FROM books left join categories on books.categoryid = categories.categoryid ORDER BY isbn";
            $result = $conn->query($query);
            if (!$result) {
                die("Could not the query the database: <br />" . $conn->error . "<br>Query: " . $query);
            }

            // fetch and display the results
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td style="text-align: center;">' . $row->isbn . '</td>';
                echo '<td style="text-align: center;">' . $row->title . '</td>';
                echo '<td style="text-align: center;">' . $row->name . '</td>';
                echo '<td style="text-align: center;">' . $row->author . '</td>';
                echo '<td style="text-align: center;"> $' . $row->price . '</td>';
                echo '<td style="text-align: center;"><a class="btn btn-primary" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a>&nbsp;
                                        <a class="btn btn-warning" href="view_detail_buku.php?id=' . $row->isbn . '">Detail</a>
                                        </td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<br />';
            echo 'Total Rows = ' . $result->num_rows;
            $result->free();
            $conn->close();
            ?>
    </div>
</div>
</div>
<?php
include('../footer.php');
?>