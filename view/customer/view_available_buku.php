<?php
include('../customer/header.php');
?>

<div class="card mt-4">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th style="text-align: center;">ISBN</th>
                <th style="text-align: center;">Title</th>
                <th style="text-align: center;">Category</th>
                <th style="text-align: center;">Author</th>
                <th style="text-align: center;">Price</th>
                <th style="text-align: center;">Action</th>
            </tr>
            <?php

            require_once("../../connection/connection.php");

            $query = " SELECT * FROM books left join categories on books.categoryid = categories.categoryid ORDER BY isbn ";
            $result = $conn->query($query);
            if (!$result) {
                die("Could not the query the database: <br />" . $conn->error . "<br>Query: " . $query);
            }

            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td style="text-align: center;">' . $row->isbn . '</td>';
                echo '<td style="text-align: center;">' . $row->title . '</td>';
                echo '<td style="text-align: center;">' . $row->name . '</td>';
                echo '<td style="text-align: center;">' . $row->author . '</td>';
                echo '<td style="text-align: center;"> $' . $row->price . '</td>';
                echo '<td style="text-align: center;"><a class="btn btn-primary" href="view_cart.php?id=' . $row->isbn . '">Add to Cart</a>&nbsp;
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
<?php
include('../customer/footer.php');
?>