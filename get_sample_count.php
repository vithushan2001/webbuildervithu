<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "webbuilder";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = isset($_GET['title']) ? $_GET['title'] : '';

$sql = "SELECT COUNT(*) as count FROM website WHERE title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo json_encode(["count" => $row['count']]);

$stmt->close();
$conn->close();
?>
