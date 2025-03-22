<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$database = "webbuilder"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['fullName']) && !empty($_POST['phone']) && !empty($_POST['language']) && !empty($_POST['websiteName']) && !empty($_POST['cardTitle'])) {

        $fullName = $_POST['fullName'];
        $phone = $_POST['phone'];
        $language = $_POST['language'];
        $websiteName = $_POST['websiteName'];
        $cardTitle = $_POST['cardTitle'];
        $websiteLogo = "";
        $plan = $_POST['plan'];
        $adminOption = $_POST['adminOption'];
        $cardsample = $_POST['cardsample'];

        // Handle file upload
        if (!empty($_FILES["websiteLogo"]["name"])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $websiteLogo = $targetDir . basename($_FILES["websiteLogo"]["name"]);
            move_uploaded_file($_FILES["websiteLogo"]["tmp_name"], $websiteLogo);
        }

        // Insert data into the database
$stmt = $conn->prepare("INSERT INTO orders (cardTitle, fullName, phone, language, websiteName, websiteLogo, plan, adminOption, websitesample) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die(json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]));
}

// Bind parameters
$stmt->bind_param("sssssssss", $cardTitle, $fullName, $phone, $language, $websiteName, $websiteLogo, $plan, $adminOption, $cardsample);

// Execute and handle the result
if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to place order: " . $stmt->error]);
}


        // Close statement
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required!"]);
    }
}

// Close the database connection
$conn->close();
?>
