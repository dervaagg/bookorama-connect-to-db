<?php
require_once('../../connection/connection.php');
include('../sidebar.php');
?>

<div class="card mt-4" style="margin-left: 18%; margin-right: 1%;">
    <div class="card-header">Kategori</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>Category</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
            </tr>

            <?php

            $query = "SELECT books.isbn AS ISBN, books.title AS Title, categories.name AS Category, books.author AS Author, books.price AS Price FROM books
                left join categories on books.categoryid = categories.categoryid";

            $result = $conn->query($query);

            if (!$result) {
                die("Could not query the database: <br />" . $conn->error . "<br>Query: " . $query);
            } else {
                $categoryData = array();

                while ($row = $result->fetch_object()) {
                    $Category = $row->Category;
                    if (isset($categoryData[$Category])) {
                        $categoryData[$Category][] = $row;
                    } else {
                        $categoryData[$Category] = array($row);
                    }
                }

                ksort($categoryData);

                foreach ($categoryData as $category => $categoryRows) {
                    $i = 0;
                    foreach ($categoryRows as $row) {
                        if ($i == 0) {
                            echo '<tr>';
                            echo '<td rowspan="' . count($categoryRows) . '">' . $row->Category . '</td>';
                        } else {
                            echo '<tr>';
                        }
                        echo '<td>' . $row->ISBN . '</td>';
                        echo '<td>' . $row->Title . '</td>';
                        echo '<td>' . $row->Author . '</td>';
                        echo '<td>' . $row->Price . '</td>';
                        echo '</tr>';
                        $i++;
                    }
                }

                echo '</table>';
                echo '</div>';
                echo '</div>';

                $result->free();

                $conn->close();
            }

            include('../footer.php');

            ?>