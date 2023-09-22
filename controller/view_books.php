<?php
    require_once("../connection/connection.php");

    $query = 'select * from books';
    $result = $conn->query($query);
    if(!$result) die("Database access failed: " . $conn->error . "<br>Query: " . $query);

    $i = 1;
    while($row = $result->fetch_object()){
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td>' . $row->isbn . '</td>';
        echo '<td>' . $row->author . '</td>';
        echo '<td>' . $row->title . '</td>';
        echo '<td>' . $row->price . '</td>';
        echo '</tr>';
        $i++;
    }

    echo '</table>';
    echo '<br />';
    echo ' Total Rows = ' . $result->num_rows . '<br />';

    $result->free();
    $conn->close();
?>
