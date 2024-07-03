<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname ="mysql";

$con = mysqli_connect($server, $username, $password,$dbname);
$id= $_SESSION['Elderly_Id'];
$s="Chore Service";

// Fetch service providers for chore service
$sql ="select Provider_Id,Name from `silver connect`.`service_provider` where Service_Name='$s'";
$result = mysqli_query($con, $sql);
if($result){
    $serviceProviders = array();
    while ($row = $result->fetch_assoc()) {
        $serviceProviders[$row['Provider_Id']] = $row['Name'];
    }
}

// Handle sending notification
if (isset($_POST['sendNotification'])) {
    // Iterate through each service provider and send notification
    foreach ($serviceProviders as $providerId => $providerName) {
        // You can implement the notification sending logic here
        // For example, sending emails or notifications via a service
        
        // Assuming a simple message for demonstration purposes
        $message = "Notification for service provider: $providerName";

        // You can replace this with your actual notification sending code
        // For demonstration, we are just echoing the message
        echo "Notification sent to $providerName: $message<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML head content -->
</head>
<body>
    <!-- Your HTML body content -->
    <form method="post" action="">
        <input type="hidden" name="sendNotification" value="1">
        <button type="submit">Send Notification</button>
    </form>
    <!-- Display service providers -->
    <div class="service-providers">
        <h3>Service Providers for Chore Service</h3>
        <?php foreach ($serviceProviders as $providerId => $providerName): ?>
            <div>
                <p>Provider ID: <?php echo $providerId; ?></p>
                <p>Provider Name: <?php echo $providerName; ?></p>
                <!-- Add more details if needed -->
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
