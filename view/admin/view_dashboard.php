<?php
require_once("../../connection/connection.php");
include('../sidebar.php');
?>
            <div style="margin-left:50%">
                <h1>Dashboard</h1>
            </div>
            <div style="margin-left: 25%; display: flex; flex-direction: row">
                <div style="width: 500px;">
                    <canvas id="total_buku"></canvas>
                </div>
                <div style="width: 500px;">
                    <canvas id="total_order"></canvas>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById("total_buku").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Novel", "Majalah", "Biografi", "Komik", "Panduan"],
                        datasets: [{
                            label: 'Data Total Buku',
                            data: [
                            <?php 
                            $jumlah_novel = mysqli_query($conn,"select * from books where categoryid=1");
                            echo mysqli_num_rows($jumlah_novel);
                            ?>, 
                            <?php 
                            $jumlah_majalah = mysqli_query($conn,"select * from books where categoryid=2");
                            echo mysqli_num_rows($jumlah_majalah);
                            ?>, 
                            <?php 
                            $jumlah_biografi = mysqli_query($conn,"select * from books where categoryid=3");
                            echo mysqli_num_rows($jumlah_biografi);
                            ?>, 
                            <?php 
                            $jumlah_komik = mysqli_query($conn,"select * from books where categoryid=4");
                            echo mysqli_num_rows($jumlah_komik);
                            ?>, 
                            <?php 
                            $jumlah_panduan = mysqli_query($conn,"select * from books where categoryid=5");
                            echo mysqli_num_rows($jumlah_panduan);
                            ?>
                            ],
                            backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
            <script>
                var ctx = document.getElementById("total_order").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Novel", "Majalah", "Biografi", "Komik", "Panduan"],
                        datasets: [{
                            label: 'Data Total Order',
                            data: [
                            <?php 
                            $jumlah_novel = mysqli_query($conn,"select * from order_items left join books on order_items.isbn = books.isbn where categoryid=1");
                            echo mysqli_num_rows($jumlah_novel);
                            ?>, 
                            <?php 
                            $jumlah_majalah = mysqli_query($conn,"select * from order_items left join books on order_items.isbn = books.isbn where categoryid=2");
                            echo mysqli_num_rows($jumlah_majalah);
                            ?>, 
                            <?php 
                            $jumlah_biografi = mysqli_query($conn,"select * from order_items left join books on order_items.isbn = books.isbn where categoryid=3");
                            echo mysqli_num_rows($jumlah_biografi);
                            ?>, 
                            <?php 
                            $jumlah_komik = mysqli_query($conn,"select * from order_items left join books on order_items.isbn = books.isbn where categoryid=4");
                            echo mysqli_num_rows($jumlah_komik);
                            ?>, 
                            <?php 
                            $jumlah_panduan = mysqli_query($conn,"select * from order_items left join books on order_items.isbn = books.isbn where categoryid=5");
                            echo mysqli_num_rows($jumlah_panduan);
                            ?>
                            ],
                            backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
<?php
include('../footer.php');
?>