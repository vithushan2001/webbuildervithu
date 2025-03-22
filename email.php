<?php
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tmithusha05@gmail.com'; 
$mail->Password = 'krfgwbkblqjmyest'; 
$mail->SMTPSecure = 'ssl'; // Try 'ssl' if 'tls' fails
$mail->Port = 465; // Use 465 for SSL

$mail->SMTPDebug = 2; // Enable debugging
$mail->Debugoutput = 'html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['fullName']) && !empty($_POST['phone']) && !empty($_POST['language']) && !empty($_POST['websiteName']) && !empty($_POST['cardTitle'])) {

        $fullName = $_POST['fullName'];
        $phone = $_POST['phone'];
        $language = $_POST['language'];
        $websiteName = $_POST['websiteName'];
        $cardTitle = $_POST['cardTitle'];
        $websiteLogo = "";

        // Corrected "From" email to match SMTP email
        $email = "tmithusha05@gmail.com"; 
        $name = $fullName; 

        if (!empty($_FILES["websiteLogo"]["name"])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $websiteLogo = $targetDir . basename($_FILES["websiteLogo"]["name"]);
            move_uploaded_file($_FILES["websiteLogo"]["tmp_name"], $websiteLogo);
        }

        $subject = " $cardTitle Website Request from $fullName";
        $toemail = 'sivathasvithusan@gmail.com';
        $toname = 'Website Create Service';

        $mail->setFrom($email, $name);
        $mail->addReplyTo($email, $name);
        $mail->addAddress($toemail, $toname);
        $mail->Subject = $subject;

        $body = "<strong>Full Name:</strong> $fullName<br>";
        $body .= "<strong>Phone Number:</strong> $phone <br>";
        $body .= "<strong>Language:</strong> $language<br>";
        $body .= "<strong>Website Name:</strong> $websiteName<br>";
        $body .= "<strong>Website Logo:</strong> $websiteLogo<br>";
        $body .= "<strong>Card Title:</strong> $cardTitle<br>";

        $mail->isHTML(true);
        $mail->Body = $body;

        if (!$mail->send()) {
            die(json_encode(["success" => false, "message" => "Mailer Error: " . $mail->ErrorInfo]));
        }

        echo json_encode(["success" => true, "message" => "Email sent successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required!"]);
    }
}

?>