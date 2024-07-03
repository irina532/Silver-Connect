<?php
//session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname ="mysql";
//$schema ="silver connect"

$con = mysqli_connect($server, $username, $password,$dbname);
if(!$con){
    die("connection failed due to" . mysqli_connect_error());
}


//echo "connection successful";
/*$name= $_SESSION['Name'];
$id= $_SESSION['Provider_Id'];

$se =$_SESSION['Service_Name'];
$points=$_SESSION['Points'];

if(isset($_GET['elderlyId'])) {
    $elderlyId = $_GET['elderlyId'];
    
    // Fetch profile details using the Elderly Id
    $sql = "SELECT * FROM `silver connect`.`elderly` WHERE Elderly_Id = '$elderlyId'";
    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        // Display profile details
        $row = mysqli_fetch_assoc($result);
        echo "<h1>Profile of " . $row['Name'] . "</h1>";
        echo "<p>Age: " . $row['Age'] . "</p>";
        echo "<p>Point: " . $row['Points'] . "</p>";
        // Display other profile details as needed
    } else {
        echo "Elderly not found.";
    }
} else {
    echo "Elderly Id not provided.";
}*/

if(!$con){
    die("connection failed due to" . mysqli_connect_error());
}

if(isset($_GET['providerId'])) {
    $providerId = $_GET['providerId'];
    
    // Fetch profile details using the provider Id
    $sql = "SELECT * FROM `silver connect`.`service_provider` WHERE Provider_Id = '$providerId'";
    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        // Display profile details
        $row = mysqli_fetch_assoc($result);
        $name = $row['Name'];
        $id = $row['Provider_Id'];
       // $age = $row['Age'];
        $points = $row['Points'];
$per= $row['Percentage'];
        
        // Display other profile details as needed
    } else {
        echo "Elderly not found.";
    }
} else {
    echo "Elderly Id not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background:#695f2e ;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right,#695f2e, #b29467);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #695f2e,#b29467);
   
        }
        .profile {
            width: 300px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 500px;
        }

        .profile2 {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 500px;
           
        }
        .profile img {
            width: 100%;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        h2 {
      text-align: center;
    }
        .profile h2 {
            margin-bottom: 10px;
            color: #000;
            text-align: center;
        }
        .profile p {
            color: #000;
            line-height: 1.6;
            text-align: center;
        }

    
    
        .register-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0056b3;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 10px;
    margin-left: 110px;
  }
  
  .login-btn:hover,
  .register-btn:hover {
    background-color: #0056b3;
  }

  .button{
    margin-left: 400px;
  }

    </style>
    
</head>
<body>
    <div class="profile">
        <img src="ppp.webp" alt="Profile Picture">
        <h2 ><?php echo $name; ?> </h2>
        <p><strong>Provider id:</strong> <?php echo $id; ?></p>
        <p><strong>Activity:</strong> <?php echo $per; echo "%"; ?></p> 
       <p><strong>Points:</strong><?php echo $points; ?></p> 
       <a href="gossip.php" class="register-btn">BACK</a>

  </div>
</body>
</html>