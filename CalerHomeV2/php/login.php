<?php
session_start();
include_once("dbconnect.php");

if(isset($_POST['submitbutton'])){
$email = $_POST['email'];
$password = sha1($_POST['password']);
$emailadmin = 'admin01@gmail.com';

$_SESSION["email"] = $email;

$sqllogin = "SELECT * FROM USER WHERE EMAIL= '$email' AND PASSWORD= '$password' AND OTP = '0' AND EMAIL!= 'admin01@gmail.com'";
$result = $conn->query($sqllogin);
$sqlloginadmin = "SELECT * FROM USER WHERE EMAIL= '$emailadmin' AND PASSWORD= '$password' AND OTP = '0'";
$resultadmin = $conn->query($sqlloginadmin);

if($result->num_rows >0){
    while($row = $result -> fetch_assoc()){
    echo "<script> alert('Login successful')</script>";
    echo "<script> window.location.replace('../php/mainpage.php')</script>";
    }
}else if($resultadmin->num_rows >0){
    while($row = $resultadmin -> fetch_assoc()){
    echo "<script> alert('Admin Login successful')</script>";
    echo "<script> window.location.replace('../php/mainpageadmin.php')</script>";
    }
}
else{
    echo "<script> alert('Login Fail')</script>";
    echo "<script> window.location.replace('../php/login.php')</script>";
}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../javascript/calerhome.js"></script>
	<link rel="stylesheet" href="../css/calerhome_style.css">
</head>

<body onload="loadCookies()">
	<div class="header">
		<h1>Caler Home</h1>
		<p>Application For Anyone Who Loves Furniture</p>
	</div>
	<div class="topnavigatorbar" id="myTopnav">
		<a href="PHPMailer/register.php" class="right">Register</a>
		<a href="../index.php" class="right">Landing Page</a>
	</div>
	<div class="main">
		<center>
			<img src="../images/calerhome.png">
		</center>
		<div class="container">
			<form name="loginForm" action="../php/login.php" onsubmit="return validateLogin()" method="post">
				<div class="row">
					<div class="col-25">
						<label for="femail">Email</label>
					</div>
					<div class="col-75">
						<input type="text" id="idemail" name="email" placeholder="Please enter your email">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="lname">Password</label>
					</div>
					<div class="col-75">
						<input type="password" id="idpass" name="password" placeholder="Please enter your password">
					</div>
				</div>
				<div class="row">
					<input type="submit" name="submitbutton" value="Login">
				</div>
			</form>
		</div>


	</div>
</body>

</html>