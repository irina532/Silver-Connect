<?php
// Connect to the database
$server = "localhost";
$username = "root";
$password = "";
$dbname = "mysql"; // Replace with your actual database name

$con = mysqli_connect($server, $username, $password, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['providerId'])) {
    $providerId = $_POST['providerId'];

    // Fetch provider details from the database
    $sql = "SELECT * FROM service_provider WHERE Provider_Id = '$providerId'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $providerName = $row['Name'];
        $providerEmail = $row['Email']; // Assuming email is stored in the 'Email' column
        
        // Construct the notification message
        $message = "Hello $providerName, You have a new notification.";

        // Send notification (This is just an example. You may need to use a proper email/SMS sending library or service)
        $subject = "New Notification";
        $headers = "From: your@example.com"; // Replace with your email address or a valid sender
        if (mail($providerEmail, $subject, $message, $headers)) {
            echo "Notification sent successfully to $providerName";
        } else {
            echo "Failed to send notification to $providerName";
        }
    } else {
        echo "Provider not found.";
    }
} else {
    echo "Provider ID not provided.";
}
?>
