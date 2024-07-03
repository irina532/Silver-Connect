<?php

if(isset($_POST['Name'])){
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

    $con = mysqli_connect($server, $username, $password, $dbname);

    if(!$con){
        die("connection failed due to" . mysqli_connect_error());
    }

    $Name = $_POST['Name'];
    $Password = $_POST['Password'];
    $sql = "SELECT * FROM `silver connect`.`service_provider` WHERE Name='$Name' AND Password='$Password'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $ro = $result->fetch_assoc();
        $point = $ro['Points'];

        $Age = $_POST['Age'];
        $Address = $_POST['Address'];
        $Contact = $_POST['Contact'];

        // Insert into elderly table with points from service provider
        $sql_insert = "INSERT INTO `silver connect`.`elderly` (`Name`, `Age`, `Address`, `Points`, `Contact`, `Password`) VALUES ('$Name', '$Age', '$Address', '$point', '$Contact', '$Password')";
        if($con->query($sql_insert) === true){
            // echo "successfully inserted";
            header("Location: p_success_reg.html");
            exit();
        } else{
            echo "ERROR: $sql_insert <br> $con->error";
        }
    } else {
        //checking duplicate username or password for elderly
        $sql_elderly = "SELECT * FROM `silver connect`.`elderly` WHERE Name='$Name' or Password='$Password'";
        $result_elderly = mysqli_query($con, $sql_elderly);
        $count_elderly = mysqli_num_rows($result_elderly);
        if($count_elderly > 0){
            echo "Duplicate Username or Password";
        } else {
            // Insert into elderly table without points
            $Age = $_POST['Age'];
            $Address = $_POST['Address'];
            $Contact = $_POST['Contact'];

            $sql_elderly_insert = "INSERT INTO `silver connect`.`elderly` (`Name`, `Age`, `Address`, `Contact`, `Password`) VALUES ('$Name', '$Age', '$Address', '$Contact', '$Password')";
        
            if($con->query($sql_elderly_insert) === true){
                // echo "successfully inserted";
                header("Location: p_success_reg.html");
                exit();
            } else{
                echo "ERROR: $sql_elderly_insert <br> $con->error";
            }
        }
    }

    $con->close();
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elderly </title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('elderly register.jpeg'); /* Replace 'background.jpg' with the path to your image */
    background-size: cover;
    background-position: center;
  }

    .container {
        width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin-left: 100px;
    }

    h2 {
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #0e573c;
      color: #ffffff;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #0e573c;
    }
    .login-btn,
  .register-btn {
   
    display: inline-block;
    padding: 10px 20px;
    background-color: #0e573c;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 10px;
  }
  
  .login-btn:hover,
  .register-btn:hover {
    background-color: #ffffff;
  }

    .link {
      color: #4caf50;
      text-decoration: none;
    }

    .link:hover {
      text-decoration: none;
    }
    .link2 {
      color: #ffffff;
      text-decoration: none;
    }

    .link2:hover {
      text-decoration: none;
    }

  </style>
</head>
<body>

<div class="container">
  <h2>Elderly</h2>
  <form action="elderly.php" method="POST">
    
    <input type="text" name="Name" id="Name" placeholder="Username" required>
    <input type="number" name="Age" id="Age" placeholder="Age" required>
    <input type="text" name="Address" id="Address" placeholder="Address" required>
    <input type="number" name="Contact" id="Contact" placeholder="contact" required>

    <input type="password" name="Password" id="Password" placeholder="Password" required>
    

    <button type="submit" class="button">Submit</button>
  </form>
  <p>Already Registered? <a href="elderly_login.php" class="link">Login here</a></p>
</div>

</body>
</html>