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

.about-section {
            background: #0c3b24;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .about-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        .about-content {
            max-width: 600px;
            text-align: justify;
            margin: 20px;
        }
        .about-image {
            max-width: 400px;
            border-radius: 10px;
            margin: 20px;
        }
        @media (max-width: 768px) {
            .about-container {
                flex-direction: column;
                text-align: center;
            }
        }

        .contact-section {
            background: #0c3b24;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .contact-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .contact-content {
            max-width: 600px;
            text-align: justify;
            margin: 20px;
        }

        .contact-form {
            max-width: 600px;
            margin: 20px;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
        }
        .contact-image {
            max-width: 400px;
            border-radius: 10px;
            margin: 20px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid rgb(25 135 84);
        }

        .contact-form button {
            width: 100%;
            padding: 10px;
            background-color: rgb(25 135 84);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .contact-form button:hover {
            background-color: rgb(25 135 84);
        }

        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                text-align: center;
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
    
   

    <div class="contact-section">
        <div class="container contact-container">
            <div class="contact-content">
                <h1>Contact Us</h1>
                <p>If you have any questions, feel free to reach out to us. We would love to hear from you and assist with your website development needs.</p>
                <h2>Our Office</h2>
                <p>Thaddara Junction, KKS Road, Jaffna, Sri Lanka</p>
                <h2>Contact Details</h2>
                <p>Email: contact@webbuilder.com<br>Phone: +94 123 456 789</p>
            </div>
            <div class="contact-form">
                <h3>Get in Touch</h3>
                <form action="submit_form.php" method="POST">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your name">

                    <label for="phone">Your Phone Number</label>
                    <input type="text" id="phone" name="phone" required placeholder="Enter your phonenumber">

                    <label for="websitename">Your Website Name</label>
                    <input type="text" id="websitename" name="websitename" required placeholder="Enter your websitename">

                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" required placeholder="Enter your message"></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
        <!-- <img src="photo/programming-amico-min1735894346.png" alt="Web Development" class="contact-image"> -->

    </div>

    <footer class="bg-dark text-white text-center p-3 mt-4" style="margin-top: 0px !important;">
        <p>&copy; 2025 WebBuilder. All Rights Reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>