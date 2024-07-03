<?php
// Assuming you have a MySQL connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the notification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider = $_POST["provider"];

    // You can customize the notification message here
    $notificationMessage = "You have a new notification from Silver Connect. Click Accept to proceed or Decline to ignore.";

    // Insert the notification into the database or perform any other action
    $sql = "INSERT INTO notifications (provider, message) VALUES ('$provider', '$notificationMessage')";
    if ($conn->query($sql) === TRUE) {
        echo "Notification sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
