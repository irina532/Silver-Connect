<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Start the session
session_start();

// Database connection parameters
$server = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

// Establish database connection
$con = mysqli_connect($server, $username, $password, $dbname);

// Check if "Request Service" button is clicked
if (isset($_POST['Request_Service'])) {
    // Load PHPMailer classes
    require 'C:\xampp\htdocs\project\PHPMailer\Exception.php';
    require 'C:\xampp\htdocs\project\PHPMailer\PHPMailer.php';
    require 'C:\xampp\htdocs\project\PHPMailer\SMTP.php';

    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();                                   
        $mail->Host       = 'smtp.gmail.com';                
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'your_email@gmail.com';                   
        $mail->Password   = 'your_password';                          
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
        $mail->Port       = 465;                                   

        // Sender information
        $mail->setFrom('your_email@gmail.com', 'SilverConnect');
        
        // Recipient information
        $mail->addAddress('recipient_email@example.com', 'Dear Service Provider');
        
        // Email content
        $mail->isHTML(true);                                
        $mail->Subject = 'New Service Request!';
        $mail->Body    = 'Your service is requested by <br>
                          <i>Elderly name :</i> name<br>
                          <i>Elderly Email : </i> email';

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>

<div class="container">
    <!-- Your HTML content here -->
    <div class="service-provider">
        <!-- Your service provider details here -->

        <!-- Form to trigger email sending -->
        <form action="" method="post">
            <input type="submit" name="Request_Service" value="Request Service">
        </form>
    </div>
</div>

</body>
</html>
