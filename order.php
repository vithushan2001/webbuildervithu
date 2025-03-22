<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<?php
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

// Pagination settings
$limit = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total rows
$totalQuery = "SELECT COUNT(*) AS total FROM orders";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch data with pagination
$sql = "SELECT id, cardTitle, fullName, phone, language, websiteName, websiteLogo, plan, adminOption, websitesample FROM orders ORDER BY id DESC LIMIT $limit OFFSET $offset";
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <a class="nav-link" href="our.php">create OurSite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mywebsite.php">mywebsites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactfrom.php">contactfrom</a>
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

    <!-- Search Form -->
    <label for="searchPhone">Search :</label>
    <input type="text" id="searchPhone" class="form-control w-25 d-inline-block mb-4" placeholder="start search">

    <!-- Customer Table -->
    <table id="customerTable">
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
            <th>websitesample</th>
        </tr>
        <tbody id="tableBody">
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

    <!-- Pagination -->
    <nav class="mt-4">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">&laquo;</a></li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">&raquo;</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script>
    $(document).ready(function(){
        $("#searchPhone").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
