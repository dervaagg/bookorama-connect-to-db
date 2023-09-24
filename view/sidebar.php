<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        /* Style the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
            display: block;
            overflow-y: auto;
            /* Enable scrolling if the content is too long */
        }

        .sidebar h2 {
            color: white;
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            text-align: center;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        /* Style the content container */
        .content {
            margin-left: 250px;
            /* Adjust this margin to match your sidebar width */
            padding: 20px;
            margin-top: 60px;
            /* Add margin to avoid overlap with navbar */
        }

        /* Style the navigation bar */
        .navbar {
            background-color: #333;
            padding: 10px 0;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Sidebar and Navbar container -->
    <div class="content">
        <!-- Navigation bar -->
        <nav class="navbar" style="position: fixed; margin: auto auto; left: 200px; right: 0; z-index: 100; height: 70px">
            <a class="btn btn-warning" href="../logout.php" style="margin: auto auto; right: 20px; position: fixed;">Log out</a>
        </nav>
    </div>
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="view_dashboard.php">Dashboard</a></li>
            <li><a href="view_order.php">List Order</a></li>
            <li><a href="view_available_buku.php">Data Buku</a></li>
            <li><a href="view_table_span.php">Data Buku Span</a></li>
        </ul>
    </div>
</body>

</html>