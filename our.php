<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border-radius: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .navbar {
            border-bottom: 3px solid #0056b3;
        }
    </style>
</head>
<body>
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
                    <a class="nav-link" href="mywebsite.php">mywebsites</a>
                </li>
                <li class="nav-item">
                    <a id="logoutBtn" class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow p-4 bg-white">
        <h2 class="text-center mb-4">Business Form</h2>
        <form action="submit.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label">Select Title:</label>
                <select id="title" name="title" class="form-select" required>
                    <option value="" style="background-color: lightblue;">select option</option>
                    <option value="Taxi booking">Taxi booking</option>
                    <option value="Hotel booking">Hotel booking</option>
                    <option value="Real estate">Real estate</option>
                    <option value="Education">Education</option>
                    <option value="Restaurant">Restaurant</option>
                    <option value="Tourism">Tourism</option>
                    <option value="Agency">Agency</option>
                    <option value="Company">Company</option>
                    <option value="Portfolio">Portfolio</option>
                    <option value="Studio">Studio</option>
                    <option value="School">School</option>
                    <option value="Event booking">Event booking</option>
                    <option value="Bakery">Bakery</option>
                    <option value="Accounting company">Accounting company</option>
                    <option value="News">News</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Jewelry shop">Jewelry shop</option>
                    <option value="Furniture shop">Furniture shop</option>
                    <option value="Mobile shop">Mobile shop</option>
                    <option value="PC and mobile repair shop">PC and mobile repair shop</option>
                    <option value="CCTV shop">CCTV shop</option>
                    <option value="Cosmetic store">Cosmetic store</option>
                    <option value="Charity">Charity</option>
                    <option value="YouTuber">YouTuber</option>
                    <option value="Painter">Painter</option>
                    <option value="AC repair">AC repair</option>
                    <option value="Carpentry">Carpentry</option>
                    <option value="Care home">Care home</option>
                    <option value="Hospital">Hospital</option>
                    <option value="Cleaning company">Cleaning company</option>
                    <option value="Construction">Construction</option>
                    <option value="Resume">Resume</option>
                    <option value="Visa consulting">Visa consulting</option>
                    <option value="Security agency">Security agency</option>
                    <option value="Job bank">Job bank</option>
                    <option value="Pet shop">Pet shop</option>
                    <option value="Sticker shop">Sticker shop</option>
                </select>
            </div>
            <div class="mb-3">
              <label for="sample" class="form-label">Sample Count:</label>
              <input type="number" id="sample" name="sample" class="form-control" readonly>
            </div>

            
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="viewmore" class="form-label">View More (URL):</label>
                <input type="url" id="viewmore" name="viewmore" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<script>
document.getElementById("title").addEventListener("change", function() {
    let selectedTitle = this.value;
    
    fetch(`get_sample_count.php?title=${selectedTitle}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("sample").value = data.count+1;
        })
        .catch(error => console.error('Error:', error));
});
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let links = document.querySelectorAll(".nav-link");
        let currentUrl = window.location.pathname.split("/").pop();

        if (currentUrl === "" || currentUrl === "dashboard.php") {
            currentUrl = "dashboard.php";
        }

        links.forEach(link => {
            if (link.getAttribute("href") === currentUrl) {
                link.classList.add("text-white", "fw-bold");
            } else {
                link.classList.remove("text-white", "fw-bold");
            }
        });
    });
</script>

<script>
document.getElementById('logoutBtn').addEventListener('click', function(event) {
    event.preventDefault(); 
    window.location.href = "logout.php"; // Redirect directly to logout
});
</script>


</body>
</html>
