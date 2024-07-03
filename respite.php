<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname ="mysql";


$con = mysqli_connect($server, $username, $password,$dbname);
$id= $_SESSION['Elderly_Id'];
//echo $id;
//making associative array for corresponding service provider and keeping id name in it
$s="Respite care";

$sql ="select Provider_Id,Name from `silver connect`.`service_provider` where Service_Name='$s'";
$result = mysqli_query($con, $sql);
if($result){
    $as_ar= array();
    while ($row = $result->fetch_assoc()) {
        $key = $row['Provider_Id'];
        $value = $row['Name'];
        $as_ar[$key] = $value;
    }
}

//Fetching provider id then updating

if (isset($_POST['givePoints'])) {
    $providerId = $_POST['providerId'];
//echo $providerId;
    
    $sql ="select * from `silver connect`.`service_provider` where Provider_Id='$providerId'";
  $result = mysqli_query($con, $sql);
  $ro = $result->fetch_assoc();
  $Points =$ro['Points'];
  //echo $Points;

  $sql1 = "UPDATE `silver connect`.`service_provider` SET Points = Points + 20 WHERE Provider_Id = '$providerId'";

  //here for elderly
  $sql3 ="select * from `silver connect`.`elderly` where Elderly_Id='$id'";
  $result3 = mysqli_query($con, $sql3);
  $ron = $result3->fetch_assoc();
  $Points =$ron['Points'];
  //echo $Points;



$sql2 = "UPDATE `silver connect`.`elderly` SET Points = Points - 20 WHERE Elderly_Id = '$id'";
if ($con->query($sql2) === TRUE) {
 // echo "Record updated successfully";
//inserting the update into booking table
  $sql3 = "INSERT INTO `silver connect`.`booking` (`Service_Name`, `Status`, `Elderly_Id`,`Provider_Id`) VALUES ('$s', 'In Process', '$id','$providerId');";

  if ($con->query($sql3) === TRUE) {
     echo "Points are discarded successfully";
  } else {
      echo "Error inserting booking record: " . $con->error;
  }
} else {
  echo "Error updating record: " . $con->error;
}


  if ($con->query($sql1) === TRUE) {
    //echo "Record updated successfully";

        //get the number of total service taken
   $t= "SELECT COUNT(*) AS total_rows FROM `silver connect`.`booking`";
   $taken_result = mysqli_query($con, $t);
            $row = mysqli_fetch_assoc($taken_result);
            $total_services = $row['total_rows'];
            //echo $total_services;


            // Get the number of services taken
            $services_taken_sql = "SELECT COUNT(*) AS services_taken FROM `silver connect`.`booking` WHERE Service_Name = '$s'";
            $services_taken_result = mysqli_query($con, $services_taken_sql);
            $services_taken_row = mysqli_fetch_assoc($services_taken_result);
            $services_taken = $services_taken_row['services_taken'];

            // Calculate the percentage
            $percentage = ($services_taken / $total_services) * 100;

            // Update the service table with the new percentage value
            $update_sql = "UPDATE `silver connect`.`service` SET Percentage = $percentage WHERE Service_Name = '$s'";
            if ($con->query($update_sql) === TRUE) {
               // echo "Percentage updated successfully";
            } else {
                echo "Error updating percentage: " . $con->error;
            }

            //for elderly percentage

$services = "SELECT COUNT(*) AS services FROM `silver connect`.`booking` WHERE Elderly_Id = '$id'";
$services_result = mysqli_query($con, $services);
$services_row = mysqli_fetch_assoc($services_result);
$services_taken1 = $services_row['services'];
//echo $services_taken1;
$per=($services_taken1 / $total_services) * 100;
$update_sql = "UPDATE `silver connect`.`elderly` SET Percentage = $per WHERE Elderly_Id = '$id'";
if ($con->query($update_sql) === TRUE) {
//echo "Percentage updated successfully";
} else {
echo "Error updating percentage: " . $con->error;
}

} else {
    echo "Error updating record: " . $conn->error;
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
    body {
        font-family: Arial, sans-serif;
        background: #6a766b;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #4ca2cd, #6a766b);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #4ca2cd, #6a766b); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
   
        margin: 80px;
        padding: 0;
    }

    .container {
        
        max-width: 600px;
        margin: 20px auto;
        background-color: #afb6b6;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .service-provider {
        margin-bottom: 15px;
        padding: 10px;
        
    }

    .service-provider h3 {
        margin-top: 0;
    }
    h3 {
    margin-bottom: 2px;
    color: #000000
;}

    .service-provider p {
        margin-bottom: 5px;
        padding: 2pxpx;
    }

    .service-provider button {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-left: 500px;
    }
    .buttons{
        margin-left: 300px;
    }
    
    .service-provider .buttons {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        
    }
    .login-btn,
  .register-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0a777e;
    color: #fff;
   
    border-radius: 5px;
    margin: 0 5px;
    white-space: 10px;
    margin-left: 15px;
   
    text-decoration: none;
   
    
  }
  .disbutton {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0056b3;
    color: #fff;
   
    border-radius: 5px;
    margin: 0 5px;
    white-space: 10px;
    margin-left: 500px;
   
    text-decoration: none;
   
    
  }

    .service-provider button:hover {
        background-color: #0056b3;
       
    }
</style>
</head>
<body>

<div class="container">
    <div class="service-provider">
        <h3>Respite Care(20)</h3><br>
        <?php
        

// Use the fetched data in the HTML section
foreach ($as_ar as $key => $value) {
    //echo "<p>Provider: $key, $value </p>";
    echo "<p>Provider: <a href='respiteprofile.php?providerId=$key'>$value</a></p>";

    $sql = "SELECT * FROM `silver connect`.`service_provider` WHERE Provider_Id='$key'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $phone = $row['P_Contact'];
        echo "<p>Email: $email</p>";
        echo "<p>Contact: $phone</p>";
    } else {
        echo "Error in SQL query: " . mysqli_error($con);
    }

        


echo "<form action='respite.php' method='post'>";
echo "<input type='hidden' name='providerId' value='$key'>";
echo "<p><button type='submit' name='givePoints'>Give Points</button></p>";
echo "</form>";


}

?>

<a href="ef_profile.php" class="login-btn">BACK</a>

        

        
    </div>


</div>

</body>
</html>