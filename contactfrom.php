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

// Pagination settings
$limit = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total rows
$totalQuery = "SELECT COUNT(*) AS total FROM form_submissions";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch data with pagination
$sql = "SELECT id, name, phone, websitename, message, created_at FROM form_submissions ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Websites Table</title>
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
                    <a class="nav-link" href="our.php">create OurSite </a>
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
    <h2>my websites Table</h2>

    <label for="searchPhone">Search:</label>
    <input type="text" id="searchPhone" class="form-control w-25 d-inline-block mb-4" placeholder="Start search">

    <table id="customerTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>phone number</th>
                <th>website name</th>
                <th>message</th>
                <th>created_at</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr id="row-<?php echo $row['id']; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['websitename']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <nav>
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
    $(document).ready(function() {
        $("#searchPhone").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // $(".delete-btn").on("click", function() {
        //     var id = $(this).data("id");
        //     if (confirm("Are you sure you want to delete this entry?")) {
        //         $.ajax({
        //             url: "delete_website.php",
        //             type: "POST",
        //             data: { id: id },
        //             success: function(response) {
        //                 if (response == "success") {
        //                     $("#row-" + id).remove();
        //                 } else {
        //                     alert("Failed to delete the record.");
        //                 }
        //             }
        //         });
        //     }
        // });
    });
</script>
</body>
</html>
<?php $conn->close(); ?>
