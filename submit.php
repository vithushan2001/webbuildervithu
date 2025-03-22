<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "webbuilder";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $viewmore = $_POST["viewmore"];
    $sample = $_POST["sample"];

    // File upload handling
    $image = $_FILES["image"]["name"];
    $imageTmpName = $_FILES["image"]["tmp_name"];
    $imagePath = "uploads/" . basename($image);
    move_uploaded_file($imageTmpName, $imagePath);

    $sql = "INSERT INTO website (image, title, description, view, sample) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $imagePath, $title, $description, $viewmore, $sample);

    if ($stmt->execute()) {
        echo "Record inserted successfully!";
        header("Location: our.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
