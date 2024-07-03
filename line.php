<!DOCTYPE html>
<html>
<head>
    <title>Services Taken Over Time</title>
    <!-- Include Highcharts library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>

<div id="container" style="width: 100%; height: 400px;"></div>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$query = "SELECT Date AS date, COUNT(*) AS service_count FROM `silver connect`.`booking` GROUP BY Date";
$result = $conn->query($query);

// Prepare data for Highcharts
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'date' => $row['date'],
        'service_count' => intval($row['service_count'])
    );
}

// Convert data to JSON format
$json_data = json_encode($data);
?>

<script>
    // Use the fetched data to render the line chart
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Services Taken Over Time'
        },
        xAxis: {
            type: 'category',
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Number of Services'
            }
        },
        series: [{
            name: 'Services',
            data: <?php echo $json_data; ?>
        }]
    });
</script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
