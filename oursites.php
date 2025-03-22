<?php
$servername = "localhost";
$username = "root"; // Change this if necessary
$password = "root"; // Change this if necessary
$database = "webbuilder"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch data from the `website` table
$sql = "SELECT * FROM website";
$result = $conn->query($sql);

$websites = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $websites[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>

body, html {
    overflow-x: hidden;
}


       
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  /* background-color: #333; */
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 14px;
  text-decoration: none;
}

/* li a:hover {
  background-color: #111;
} */

         @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animated-heading {
        animation: fadeInUp 1s ease-out;
    }
    .animated-content {
        animation: fadeInUp 1s ease-out;
        animation-delay: 0.1s;

    }

   .picture w3-display-container{
    padding: auto;
   }

/* Modal Background */
.modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.8); /* Black with opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #1a1a1a; /* Dark background */
        margin: 10% auto; /* 10% from the top and centered */
        padding: 20px;
        border: 2px solid rgb(25 135 84); /* Orange border */
        border-radius: 10px;
        width: 80%; /* Could be more or less, depending on screen size */
        max-width: 500px;
        color: #fff; /* White text */
        font-family: 'Arial', sans-serif;
    }

    /* Close Button */
    .close {
        color:rgb(25 135 84); /* Orange color */
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color:rgb(25 135 84); /* Lighter orange on hover */
    }

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
        color: rgb(25 135 84); /* Orange color */
    }

    input[type="text"],
    input[type="tel"],
    select {
        padding: 10px;
        margin-top: 5px;
        border: 1px solid rgb(25 135 84); /* Orange border */
        border-radius: 5px;
        background-color: #333; /* Dark input background */
        color: #fff; /* White text */
    }

    input[type="file"] {
        margin-top: 5px;
    }

    button[type="submit"] {
        margin-top: 20px;
        padding: 10px;
        background-color: rgb(25 135 84); /* Orange background */
        color: #fff; /* White text */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    button[type="submit"]:hover {
        background-color: rgb(25 135 84); /* Lighter orange on hover */
    }
  
    /* Mobile View Adjustments */
    @media (max-width: 768px) {
        .bg-success {
            grid-template-columns: 1fr !important; /* Stack elements vertically */
            text-align: center; /* Center-align text */
            padding: 1rem; /* Add padding for better spacing */
        }

        .img-fluid{
            margin-right: 200px;
        }

        .animated-heading {
            font-size: 2rem !important; /* Reduce heading font size */
            margin-bottom: 0.5rem !important; /* Reduce margin */
        }

        .d-flex {
            flex-direction: column; /* Stack button and text vertically */
            align-items:center; 
            margin-left : 100px !important; 
            gap: 0.5rem !important; /* Reduce gap between elements */
        }

        .btn {
            /* display: none; */
            font-size: 1rem !important; /* Reduce button font size */
            padding: 6px 12px !important; /* Adjust button padding */
        }

        .offerDate {
            font-size: 1rem !important; /* Reduce offer text font size */
            text-align: center; /* Center-align text */
        }

        .bg-success img {
            max-width: 80% !important; /* Reduce image size */
            margin-top: 1rem; /* Add spacing above the image */
        }
    }
    /* Ensure the navbar toggler is aligned properly */
.navbar-toggler {
    border: none;
    outline: none;
}
.container b a{
    text-decoration: none;
    color: white;
}
.container{
    max-width: 100%;
}

#subnav {
    display: flex;
    align-items: center;
    overflow: hidden;
    white-space: nowrap;
    position: relative;
    /* background-color: #f1f1f1; */
}

#scrolling_menu {
    background-color:rgb(109 118 126);
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    white-space: nowrap;
    list-style: none;
    padding: 0;
    margin: 0;
}

#scrolling_menu li {
    flex-shrink: 0;
    margin: 5px;
}

#scrolling_menu a {
    text-decoration: none;
}

#scroll_left_btn, #scroll_right_btn {
    position: absolute;
    cursor: pointer;
    /* background: rgba(255, 255, 255, 0.8); */
    padding: 5px;
    border-radius: 5px;
    font-size: 18px;
    font-weight: bold;
}

#scroll_left_btn {
    left: 0;
}

#scroll_right_btn {
    right: 0;
}


#scrolling_menu::-webkit-scrollbar {
    height: 6px;
}

#scrolling_menu::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

#scrolling_menu::-webkit-scrollbar-track {
    background: #888;
}
@media screen and (max-width: 768px) {
    #talk-agent-btn {
        display: none;
        position: absolute;
        right:10px; /* Adjust as needed */
        top: 10px;
    }

    .navbar {
        position: absolute;
        left: 10px; /* Adjust as needed */
        top: 10px;
    }
}




    </style>
</head>
<body>
    <header class="bg-light p-2">
        <div class="container d-flex align-items-center justify-content-between flex-wrap">
            <!-- Logo -->
            <img src="photo/complet-logo-psd-1-11735650908.png" alt="Sample Image" class="img-fluid" style="max-width: 200px;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link fs-5 mx-2">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="about.php" class="nav-link fs-5 mx-2">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="oursites.php" class="nav-link fs-5 mx-2">ourwebsites</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link fs-5 mx-2">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
    
            <!-- Talk Agent Button -->
            <button id="talk-agent-btn" class="btn fs-5 text-white" style="background-color: #0c3b24; ">Talk Agent</button>
        </div>
    </header>
    
    

    <nav  id="oursites">
    <div class="container text-center" style="padding: 0px !important; ">
        <div id="subnav" onmousedown="startscrolling_subnav(event)" 
             onmousemove="scrolling_subnav(event)" 
             onmouseup="endscrolling_subnav(event)" 
             onclick="return pellessii(event)">

            <div id="scroll_left_btn" class="w3-hide-medium w3-hide-small" style="display: block;">
                <span onmousedown="scrollmenow(-1)" onmouseup="stopscrollmenow()" onmouseout="stopscrollmenow()">
                    &nbsp;&nbsp;&nbsp;❮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
            </div>

            <ul id="scrolling_menu">
                <?php  
                $uniqueTitles = []; 
                foreach ($websites as $site): 
                    if (!in_array($site['title'], $uniqueTitles)): 
                        $uniqueTitles[] = $site['title'];
                ?>
                    <li>
                        <a href="javascript:void(0)" class="w3-hover-opacity" 
                           onclick="openImg('<?php echo htmlspecialchars($site['title']); ?>')">
                            <button class="w3-bar-item w3-button">
                                <?php echo htmlspecialchars($site['title']); ?>
                            </button>
                        </a>
                    </li>
                <?php 
                    endif; 
                endforeach; 
                ?>
            </ul>

            <div id="scroll_right_btn" style="display: block; right: 0px;" class="w3-hide-medium w3-hide-small">
                <span onmousedown="scrollmenow(1)" onmouseup="stopscrollmenow()" onmouseout="stopscrollmenow()">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;❯&nbsp;&nbsp;&nbsp;
                </span>
            </div>
        </div>
    </div>
</nav>

    <br>
    <br>

 <!-- Display Section -->
 <?php 
$groupedWebsites = []; // Group websites by their title

// Group data by category title
foreach ($websites as $site) {
    $groupedWebsites[$site['title']][] = $site;
}

foreach ($groupedWebsites as $title => $sites): 
?>
    <div>
        <div id="<?php echo htmlspecialchars($title); ?>" class="picture w3-display-container" style="display:none ">
            <span onclick="this.parentElement.style.display='none'" 
            class="w3-display-topright w3-button w3-transparent w3-text-white">&times;</span>
            
            <div class="container my-4">
                <div class="row">
                    <?php 
                    $count = 0;
                    foreach ($sites as $site): 
                        if ($count % 3 == 0 && $count != 0) {
                            echo '</div><div class="row">'; // Close current row and start a new one after 3 cards
                        }
                    ?>
                        <div class="col-md-4 pb-3"> <!-- 3 cards per row (col-md-4) -->
                            <div class="card" style="box-sizing: border-box !important;">
                                <img src="<?php echo htmlspecialchars($site['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($site['title']);?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($site['title']); ?></h5>
                                    <p class="card-sample">sample <?php echo htmlspecialchars($site['sample']); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($site['description']); ?></p>
                                    <a href="<?php echo htmlspecialchars($site['view']); ?>" class="btn btn-primary" target="_blank">View</a>
                                    <a href="#" class="btn btn-success" onclick="openPlanPopup(this)">Buy</a>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $count++;
                    endforeach; 
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<br>





<div id="" class="picture w3-display-container">
    <span onclick="this.parentElement.style.display='none'" 
    class="w3-display-topright w3-button w3-transparent w3-text-white">&times;</span>
    <div class="container my-4">
    <div class="row">
        <?php 
        $count = 0;
        foreach ($websites as $site): 
            if ($count % 3 == 0 && $count != 0) {
                echo '</div><div class="row">'; // Close current row and start a new one after 3 cards
            }
        ?>
            <div class="col-md-4 pb-3"> <!-- 3 cards per row (col-md-4) -->
                <div class="card">
                    <img src="<?php echo htmlspecialchars($site['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($site['title']); ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($site['title']); ?></h5>
                        <p class="card-sample">sample <?php echo htmlspecialchars($site['sample']); ?></p>
                        <p class="card-text"><?php echo htmlspecialchars($site['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($site['view']); ?>" class="btn btn-primary" target="_blank">View</a>
                        <a href="#" class="btn btn-success" onclick="openPlanPopup(this)">Buy</a>
                    </div>
                </div>
            </div>
        <?php 
            $count++;
        endforeach; 
        ?>
    </div>
 </div>
</div>//


<!-- New Plan Selection Popup -->
<div id="planPopup" class="modal" style="display:none">
    <div class="modal-content p-4">
        <span class="close" onclick="closePlanPopup()">&times;</span>
        <h3 class="text-center mb-3">Select Your Plan</h3>
        <div class="toggle-buttons text-center mb-3">
            <button id="monthlyBtn" class="btn btn-primary active" onclick="changePlan('monthly')">Monthly</button>
            <button id="yearlyBtn" class="btn btn-outline-primary" onclick="changePlan('yearly')">Yearly</button>
        </div>
        <div class="row plan-options">
            <div class="col-md-6 plan border p-3 text-center">
                <h4>With Admin</h4>
                <p>✔ Feature 1</p>
                <p>✔ Feature 2</p>
                <p>✔ Feature 3</p>
                <p>✔ Feature 4</p>
                <h5 id="withAdminPrice">13,000 LKR</h5>
                <button class="btn btn-success" onclick="openPurchaseForm('With Admin')">Order</button>
                <p id="withAdminSubscription">350 LKR Monthly</p>
            </div>
            <div class="col-md-6 plan border p-3 text-center">
                <h4>Without Admin</h4>
                <p>✔ Feature 1</p>
                <p>✔ Feature 2</p>
                <p>✔ Feature 3</p>
                <p>✔ Feature 4</p>
                <h5 id="withoutAdminPrice">15,000 LKR</h5>
                <button class="btn btn-success" onclick="openPurchaseForm('Without Admin')">Order</button>
                <p id="withoutAdminSubscription">250 LKR Monthly</p>
            </div>
        </div>
    </div>
</div>

<!-- Purchase Form Popup -->
<div id="popupForm" class="modal" style="display:none">
    <div class="modal-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h3>Purchase Form</h3>
        <form method="post">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" maxlength="10" minlength="9" required>

            <label for="language">Support Language:</label>
            <select id="language" name="language">
                <option value="tamil">Tamil</option>
                <option value="singalam">Sinhala</option>
                <option value="english">English</option>
            </select>

            <label for="websiteName">Website Name:</label>
            <input type="text" id="websiteName" name="websiteName" required>

            <label for="websiteLogo">Website Logo:</label>
            <input type="file" id="websiteLogo" name="websiteLogo">

            <!-- Hidden fields for plan selection and admin option -->
            <!-- <label for="cardTitleField">Card Title:</label> -->
            <input type="hidden" id="cardTitleField" name="cardTitle" readonly>

            <!-- <label for="cardTitleField">Card sample:</label> -->
            <input type="hidden" id="cardsample" name="cardsample" readonly>
            
            <!-- <label for="planField">Plan:</label> -->
            <input type="hidden" id="planField" name="plan" readonly>
            
            <!-- <label for="adminField">Admin Option:</label> -->
            <input type="hidden" id="adminField" name="adminOption" readonly>

            <button type="submit">Submit</button>
        </form>
    </div>
</div>



    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2025 Your Website. All Rights Reserved.</p>
    </footer>
<script>
    let selectedPlan = 'monthly';
let selectedType = '';

function changePlan(type) {
    selectedPlan = type;
    document.getElementById('monthlyBtn').classList.toggle('active', type === 'monthly');
    document.getElementById('monthlyBtn').classList.toggle('btn-primary', type === 'monthly');
    document.getElementById('monthlyBtn').classList.toggle('btn-outline-primary', type !== 'monthly');
    document.getElementById('yearlyBtn').classList.toggle('active', type === 'yearly');
    document.getElementById('yearlyBtn').classList.toggle('btn-primary', type === 'yearly');
    document.getElementById('yearlyBtn').classList.toggle('btn-outline-primary', type !== 'yearly');

    if (type === 'monthly') {
        document.getElementById('withAdminPrice').innerText = '13,000 LKR';
        document.getElementById('withAdminSubscription').innerText = '350 LKR Monthly';
        document.getElementById('withoutAdminPrice').innerText = '15,000 LKR';
        document.getElementById('withoutAdminSubscription').innerText = '250 LKR Monthly';
    } else {
        document.getElementById('withAdminPrice').innerText = '130,000 LKR';
        document.getElementById('withAdminSubscription').innerText = '3,500 LKR Yearly';
        document.getElementById('withoutAdminPrice').innerText = '150,000 LKR';
        document.getElementById('withoutAdminSubscription').innerText = '2,500 LKR Yearly';
    }
}




</script>

    

<!-- dinamic add website -->
    
<script>
function openImg(title) {
    // Hide all sections
    let sections = document.querySelectorAll('.picture');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    document.getElementById(title).style.display = 'block';
}
</script>
<script>
    let scrolling = false;

function startscrolling_subnav(event) {
    scrolling = true;
}

function scrolling_subnav(event) {
    if (scrolling) {
        document.getElementById("scrolling_menu").scrollLeft += event.movementX;
    }
}

function endscrolling_subnav(event) {
    scrolling = false;
}

function scrollmenow(direction) {
    let menu = document.getElementById("scrolling_menu");
    let scrollAmount = 150 * direction;
    menu.scrollBy({ left: scrollAmount, behavior: "smooth" });
}

function stopscrollmenow() {
    scrolling = false;
}

</script>


<script>
        document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#popupForm button");

    submitButton.addEventListener("click", function () {
        this.style.backgroundColor = "#ff5733"; // Change color
        this.style.color = "white";

        // Reset after 0.3s
        setTimeout(() => {
            this.style.backgroundColor = ""; 
            this.style.color = "";
        }, 300);
    });
});



    function openPlanPopup(button) {
    var cardTitle = button.closest('.card').querySelector('.card-title').innerText;
    var cardsample = button.closest('.card').querySelector('.card-sample').innerText;
    document.getElementById('cardTitleField').value = cardTitle;
    document.getElementById('cardsample').value = cardsample;
    document.getElementById("planPopup").style.display = "block";
}

function closePlanPopup() {
    document.getElementById("planPopup").style.display = "none";
}

function openPurchaseForm(data) {
    document.getElementById('planField').value = selectedPlan;
    document.getElementById('adminField').value = data;
    closePlanPopup(); // Close the plan selection popup
    document.getElementById("popupForm").style.display = "block";
}

function closePopup() {
    document.getElementById("popupForm").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("#popupForm form").addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData(this); // Create FormData object

        // First, send form data to process_order.php
        fetch("process_order.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closePopup(); // Close the popup if successful
                document.querySelector("#popupForm form").reset();
                // If order processing is successful, send data to email.php
                return fetch("email.php", {
                    method: "POST",
                    body: formData,
                });
            } else {
                throw new Error(data.message); // Handle process_order.php failure
            }
        })
        .then(response => response.json())
        .then(emailData => {
            alert(emailData.message); // Show success or error message for email
            if (emailData.success) {
                 // Reset form
            }
        })
        .catch(error => console.error("Error:", error));
    });
});


</script>
    <script>
        function openImg(imgName) {
          var i, x;
          x = document.getElementsByClassName("picture");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
          }
          document.getElementById(imgName).style.display = "block";
        }
        </script>
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Smooth Scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener("click", function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute("href")).scrollIntoView({
                        behavior: "smooth"
                    });
                });
            });

            // Get Started Button Animation
            const getStartedBtn = document.querySelector(".btn[style*='background-color: #0c3b24']");
            if (getStartedBtn) {
                getStartedBtn.addEventListener("click", function () {
                    this.style.transform = "scale(1.1)";
                    setTimeout(() => {
                        this.style.transform = "scale(1)";
                    }, 150);
                });
            }

            
            });
        
        document.addEventListener("DOMContentLoaded", function () {
    const imageMap = {
        "Newspaper": "photo/newspaper16737838781674996766.jpg",
        "Photography": "photo/photography-min1678016795.jpg",
        "Portfolio": "photo/personal-portfolio-min1678016788.jpg",
        "Wedding": "photo/wedding-min1678016799.jpg",
        "Donation": "photo/donation1659177444.jpg",
        "Ecommerce": "photo/ecommerce1659177446.jpg",
        "Construction": "photo/construction-1-min16743923531674996763.jpg",
        "Support Ticket": "photo/support-ticketing1659177443.jpg"
    };

    const navContainer = document.querySelector(".container.text-center");
    const mainImageContainer = document.querySelector(".bg-success");
    const mainImage = document.querySelector(".bg-success img");

    // Ensure the image container is visible with proper styling
    mainImageContainer.style.display = "flex";
    mainImageContainer.style.alignItems = "center";
    mainImageContainer.style.justifyContent = "center";
    mainImageContainer.style.minHeight = "400px"; // Ensure container height
    mainImage.style.display = "none"; // Initially hidden

    // Set a single onerror event to handle missing images
    mainImage.onerror = function () {
        console.log("Failed to load image:", mainImage.src);
        mainImage.src = "photo/default.jpg"; // Fallback image
        mainImage.alt = "Image not found";
    };
     
    // Event delegation for better performance
    navContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("btn")) {
            event.preventDefault();
            const selectedCategory = event.target.textContent.trim();
            console.log("Selected Category:", selectedCategory);

            if (imageMap[selectedCategory]) {
                mainImage.src = imageMap[selectedCategory];
                mainImage.alt = selectedCategory;
                mainImage.style.display = "block"; 
                console.log("Image updated to:", imageMap[selectedCategory]);
            } else {
                console.log("No image found for this category.");
            }
        }
    });
});
</script>


</body>
</html>



