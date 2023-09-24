<?php 
    include('header.php');
    require('../../connection/connection.php');
?>

    <div class="card mt-4">
        <div class="card-header text-center">Detail Order</div>
        <div class="card-body">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="off">
                <div class="form-group mb-2">
                    <label for="minDate">Mulai dari Tanggal:</label>
                    <input type="date" class="form-control" id="minDate" name="minDate" value="<?= isset($_POST['minDate']) ? $_POST['minDate'] : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="maxDate">Hingga Tanggal:</label>
                    <input type="date" class="form-control" id="maxDate" name="maxDate" value="<?= isset($_POST['maxDate']) ? $_POST['maxDate'] : ''; ?>">
                </div>
                <div class="error"><?php if (isset($error_date)) echo $error_date ?></div>
                <div class="text-left"><button type="submit" class="btn btn-outline-primary mb-4" name="submit">Cari</button></div>
            </form>

<?php
    
    $query = "SELECT o.orderid AS OrderID, o.customerid AS CustomerID, o.amount AS Amount, o.date AS order_date, oi.isbn AS ISBN, oi.quantity AS Quantity, b.title AS Title FROM orders o JOIN order_items oi ON o.orderid = oi.orderid JOIN books b ON oi.isbn = b.isbn";
    if (!isset($_POST['submit'])) {

        $result = $conn->query($query);

        if (!$result){
            die("Query yang diberikan salah: <br />" . $conn->error . "<br>Query: " . $query);
        } else{
            echo '<table class="table table-striped text-center mt-1">';
            echo '<tr>';
            echo '<th>Order ID</th>';
            echo '<th>Customer ID</th>';
            echo '<th>Amount</th>';
            echo '<th>Tanggal Order</th>';
            echo '<th>ISBN</th>';
            echo '<th>Quantity</th>';
            echo '<th>Title</th>';
            echo '</tr>';

            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->OrderID . '</td>';
                echo '<td>' . $row->CustomerID . '</td>';
                echo '<td>' . $row->Amount . '</td>';
                echo '<td>' . $row->order_date . '</td>';
                echo '<td>' . $row->ISBN . '</td>';
                echo '<td>' . $row->Quantity . '</td>';
                echo '<td>' . $row->Title . '</td>';
                echo '</tr>';
            }
        }

    } 
    else {
        $minDate = $_POST['minDate'];
        $maxDate = $_POST['maxDate'];
        if (!empty($minDate) && !empty($maxDate)) {
            $query .= " WHERE o.date BETWEEN '$minDate' AND '$maxDate' ";
        } else if (!empty($minDate)){
            $query .= " WHERE o.date >= '$minDate'";
        } else if (!empty($maxDate)){
            $query .= " WHERE o.date <= '$maxDate'";
        }

        $result = $conn->query($query);
        
        if (!$result){
            die("Query yang diberikan salah: <br />" . $conn->error . "<br>Query: " . $query);
        } else{
            echo '<table class="table table-striped text-center mt-1">';
            echo '<tr>';
            echo '<th>Order ID</th>';
            echo '<th>Customer ID</th>';
            echo '<th>Amount</th>';
            echo '<th>Tanggal Order</th>';
            echo '<th>ISBN</th>';
            echo '<th>Quantity</th>';
            echo '<th>Title</th>';
            echo '</tr>';
    
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->OrderID . '</td>';
                echo '<td>' . $row->CustomerID . '</td>';
                echo '<td>' . $row->Amount . '</td>';
                echo '<td>' . $row->order_date . '</td>';
                echo '<td>' . $row->ISBN . '</td>';
                echo '<td>' . $row->Quantity . '</td>';
                echo '<td>' . $row->Title . '</td>';
                echo '</tr>';
            }
        }
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';

    $result->free();
    
    $conn->close();
    
    include('../../view/customer/footer.php');
?>