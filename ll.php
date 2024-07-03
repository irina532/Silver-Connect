<?php


$server = "localhost";
$username = "root";
$password = "";
$dbname ="mysql";


$con = mysqli_connect($server, $username, $password,$dbname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
    // Replace this section with your PHP code to fetch provider IDs and names from the database
    // For demonstration purposes, I'm assuming $as_ar is already populated
    $sql ="select Provider_Id,Name from `silver connect`.`service_provider` where Service_Name='Medication'";
    $result = mysqli_query($con, $sql);
    if($result){
        $as_ar= array();
        while ($row = $result->fetch_assoc()) {
            $key = $row['Provider_Id'];
            $value = $row['Name'];
            $as_ar[$key] = $value;
        }
    }
    $as_ar = array(
        '1' => 'Provider 1',
        '2' => 'Provider 2',
        '3' => 'Provider 3'
    );

    // Render buttons for each provider
    foreach ($as_ar as $key => $value) {
        echo "<button class='notify-provider' data-provider-id='$key'>$value</button><br>";
    }
    ?>

    <script>
    $(document).ready(function() {
        $('.notify-provider').click(function() {
            var providerId = $(this).data('provider-id');

            // AJAX request
            $.ajax({
                url: 'send_notification.php',
                type: 'POST',
                data: { providerId: providerId },
                success: function(response) {
                    alert(response); // Display success or error message
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
</body>
</html>
