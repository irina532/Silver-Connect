<?php

session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname ="mysql";
//$schema ="silver connect"

$con = mysqli_connect($server, $username, $password,$dbname);
$name= $_SESSION['Name'];
$id= $_SESSION['Elderly_Id'];
$points=$_SESSION['Points'];
$age =$_SESSION['Age'];
$ads =$_SESSION['Address'];
$per=$_SESSION['Percentage'];

$s="select * from `silver connect`.`booking` where Elderly_Id='$id'";
$result3 = mysqli_query($con, $s);
$count = mysqli_num_rows($result3);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Profile</title>
    <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <style>
        body {
    background: #67B26F;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #4ca2cd, #67B26F);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #4ca2cd, #67B26F); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    padding: 0;
    margin: 0;
    font-family: 'Lato', sans-serif;
    color: #000;
}
.student-profile .card {
    margin-top: 50px;
    border-radius: 10px;
    
}
.student-profile .card .card-header .profile_img {
    width: 300px;
    height: 300px;
    object-fit: cover;
     margin-top: 50px auto;
    border: 5px solid #ccc;
    border-radius: 50%;
}
.student-profile .card h3 {
    font-size: 20px;
    font-weight: 700;
}
.student-profile .card p {
    font-size: 16px;
    color: #000;
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
  
  h3 {
   margin-top: 10px ;
   margin-left: 100px;
   margin-bottom:10px;
   color: #000000
   
;
 }
  
  .login-btn:hover,
  .register-btn:hover {
    background-color: #fff;
    text-decoration: none;
   

  }
.student-profile .table th,
.student-profile .table td {
    font-size: 14px;
    padding: 5px 10px;
    color: #000;
}
.register {
    display: inline-block;
    padding: 10px 20px;
    background-color: #236ebf;
    color: #fff;
   
    border-radius: 5px;
    margin: 0 5px;
    white-space: 10px;
    margin-left: 100px;
   
    text-decoration: none;
   
    
  }
  .register:hover {
    background-color: #0a777e;
    text-decoration: none;
    color:#fff;
   

  }
  .login {
    display: inline-block;
    padding: 10px 20px;
    background-color: #236ebf;
    color: #fff;
   
    border-radius: 5px;
    margin: 0 5px;
    white-space: 10px;
    margin-left: 280px;
   
    text-decoration: none;
   
    
  }
  .login:hover {
    background-color: #0a777e;
    text-decoration: none;
    color:#fff;
 
   

  }
    </style>
</head>
<body>
  <div class="student-profile py-6">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent text-center">
              <img class="profile_img" src="fem.jpg" alt="student dp">
              <h2><?php echo $name; ?></h2>
            </div>
            <div class="card-body">
              <p class="mb-1"><strong class="pr-1">Elderly ID:</strong><?php echo $id; ?></p>
              <p class="mb-1"><strong class="pr-1">Points:</strong><?php echo $points; ?></p>
              <p class="mb-4"><strong class="pr-1">Activity:</strong><?php echo $per; echo "%"; ?></p>
              
              <a href="logout.php" class="register">LOG OUT</a>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-0">
              <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
            </div>
            <div class="card-body pt-0">
              <table class="table table-bordered">
                <tr>
                  <th width="30%">Name</th>
                  <td width="2%">:</td>
                  <td><?php echo $name; ?></td>
                </tr>
                <tr>
                  <th width="30%">Elderly Id</th>
                  <td width="2%">:</td>
                  <td><?php echo $id; ?></td>
                </tr>
                <tr>
                  <th width="30%">Age</th>
                  <td width="2%">:</td>
                  <td><?php echo $age; ?></td>
                </tr>
                <tr>
                  <th width="30%">Address</th>
                  <td width="2%">:</td>
                  <td><?php echo $ads; ?></td>
                </tr>
                <tr>
                  <th width="30%">Number of the taken services</th>
                  <td width="2%">:</td>
                  <td><?php echo $count; ?><a href="histry.php" class="login">Service History</a></td>
                </tr>
                
              </table>
            </div>
          </div>
            <div style="height: 2px"></div>
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-0">
              <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Which types of services do you want to get?</h3>
            </div>
            <div class="card-body pt-2">
            
              
            <a href="personal.php?elderlyId=<?php echo $id; ?>" class="login-btn">Personal care</a>
             
            <a href="dance.php" class="register-btn">Dance Partner</a>
             
             <a href="meal.php" class="register-btn">Meal Delivery</a>
             <a href="house.php" class="register-btn">Housekeeping</a><br><br>
             <a href="health.php" class="register-btn">Health Checkup</a>
             <a href="respite.php" class="register-btn">Respite care</a>
             <a href="hsafety.php" class="register-btn">Home safety</a>
             <a href="tra.php" class="register-btn">Transpotation</a><br><br>
             <a href="finan.php" class="register-btn">Financial Help</a>
             <a href="gossip.php" class="register-btn"> Gossip Partner</a>
             <a href="medi.php" class="register-btn">Medication</a>
             
             <a href="choreservice.php" class="register-btn">Chore Service</a>
             
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>