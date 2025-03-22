<?php
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webbuilder"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $websitename = mysqli_real_escape_string($conn, $_POST['websitename']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // SQL query to insert data
    $sql = "INSERT INTO form_submissions (name, phone, websitename, message) 
            VALUES ('$name', '$phone', '$websitename', '$message')";

    // Execute the query and insert data into the database
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";

        // Sending email using PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tmithusha05@gmail.com'; 
        $mail->Password = 'krfgwbkblqjmyest'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->SMTPDebug = 2; // Enable debugging for troubleshooting
        $mail->Debugoutput = 'html';

        // Email content and setup
        $subject = "New Form Submission from $name";
        $toemail = 'sivathasvithusan@gmail.com'; // Recipient email
        $toname = 'Website Service Team';

        $mail->setFrom('sivathasvithusan@gmail.com', $name);
        $mail->addReplyTo('sivathasvithusan@gmail.com', $name);
        $mail->addAddress($toemail, $toname);
        $mail->Subject = $subject;

        // HTML email body
        $body = "<strong>Full Name:</strong> $name<br>";
        $body .= "<strong>Phone Number:</strong> $phone <br>";
        $body .= "<strong>Website Name:</strong> $websitename<br>";
        $body .= "<strong>Message:</strong> $message<br>";

        $mail->isHTML(true);
        $mail->Body = $body;

        // Send email and handle errors
        if (!$mail->send()) {
            die(json_encode(["success" => false, "message" => "Mailer Error: " . $mail->ErrorInfo]));
        }

        // Respond with success message
        echo json_encode(["success" => true, "message" => "Email sent successfully!"]);
        header("Location: contact.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
