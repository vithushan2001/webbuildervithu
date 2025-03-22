<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "root";
$database = "webbuilder";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch last 10 rows
$sql = "SELECT id, cardTitle, fullName, phone, language, websiteName, websiteLogo, plan, adminOption, websitesample FROM orders ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Order Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="our.php">Our Site Sample</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mywebsite.php">My Websites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2>Customer Table</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Card Title</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Language</th>
            <th>Website Name</th>
            <th>Website Logo</th>
            <th>Plan</th>
            <th>Admin Option</th>
            <th>Website Sample</th>
        </tr>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["cardTitle"] . "</td>";
                    echo "<td>" . $row["fullName"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["language"] . "</td>";
                    echo "<td>" . $row["websiteName"] . "</td>";
                    echo "<td><img src='" . $row["websiteLogo"] . "' width='50'></td>";
                    echo "<td>" . $row["plan"] . "</td>";
                    echo "<td>" . $row["adminOption"] . "</td>";
                    echo "<td>" . $row["websitesample"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
