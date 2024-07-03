<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";
$con = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Query to retrieve data from the booking table
$query = "SELECT Service_Name, Percentage FROM `silver connect`.`service`";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    echo "Error: " . mysqli_error($con);
    exit();
}

// Initialize arrays to store data for the charts
$pieChartData = array();
$verticalBarChartData = array();

// Loop through the results and populate the arrays
while ($row = mysqli_fetch_assoc($result)) {
    $service_name = $row['Service_Name'];
    $percentage = $row['Percentage'];

    // Add data to pie chart array
    $pieChartData[] = array('name' => $service_name, 'y' => floatval($percentage));

    // Add data to vertical bar chart array
    $verticalBarChartData[$service_name] = floatval($percentage);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie and Vertical Bar Charts</title>
    <!-- Include Highcharts library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <!-- Container for the pie chart -->
    <div id="pieChartContainer" style="width: 45%; height: 400px; display: inline-block;"></div>
    
    <!-- Container for the vertical bar chart -->
    <div id="verticalBarChartContainer" style="width: 45%; height: 400px; display: inline-block;"></div>

    <script>
        // Create the pie chart
        Highcharts.chart('pieChartContainer', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Taken Services (Pie Chart)',
                align: 'left'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f}%'
                    }
                }
            },
            series: [{
                name: 'Percentage',
                colorByPoint: true,
                data: <?php echo json_encode($pieChartData); ?>
            }]
        });

        // Create the vertical bar chart
        Highcharts.chart('verticalBarChartContainer', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Taken Services (Vertical Bar Chart)',
                align: 'left'
            },
            xAxis: {
                categories: <?php echo json_encode(array_keys($verticalBarChartData)); ?>
            },
            yAxis: {
                title: {
                    text: 'Percentage (%)'
                }
            },
            series: [{
                name: 'Percentage',
                data: <?php echo json_encode(array_values($verticalBarChartData)); ?>
            }]
        });
    </script>
</body>
</html>
