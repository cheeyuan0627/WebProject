<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

include_once("dbconnect.php");

if(isset($_POST['registerbutton'])){
   $name = $_POST["name"];
     $email = $_POST["email"];
     $phone = $_POST["phone"];
     $pass = $_POST["password"];
     $shapass = sha1($pass);  
     $otp = rand(1000,9999);

    //Server settings
  //  $mail->SMTPDebug = 2;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'mail.triold.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'calerhome@triold.com';                     
    $mail->Password   = 'Teo169399';                              
    $mail->SMTPSecure = 'ssl';  //tls       
    $mail->Port       = 465;    //587                               


        $sqlregister = "INSERT INTO USER(NAME,EMAIL,PHONE,PASSWORD,OTP) VALUES('$name','$email','$phone','$shapass','$otp')";
  if ($conn->query($sqlregister) === TRUE){
             echo "success";
             $mail->setFrom('calerhome@triold.com', 'calerhome');
             $mail->addAddress($email, 'Receiver'); 
             $mail->isHTML(true);                                
             $mail->Subject = 'From CalerHome. Verify your account';
             $mail->Body    = "Welcome to CalerHome."."\u{1F603}"." Please use the following link to verify your account :"."\n http://triold.com/calerhomev2/php/verify_email.php?email=".$email."&key=".$otp;$email.'&key='.$otp;
             $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
             $mail->send();
            echo "<script> alert('Registration successful, please check your email')</script>";
            echo "<script> window.location.replace('../login.php')</script>";
        }else{
            echo "<script> alert('Registration failed')</script>";
            echo "<script> window.location.replace('register.php')</script>";
        }
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../javascript/calerhome.js"></script>
	<link rel="stylesheet" href="../../css/calerhome_style.css">
</head>

<body>
	<div class="header">
		<h1>Caler Home</h1>
		<p>Application For Anyone Who Loves Furniture</p>
	</div>
	<div class="topnavigatorbar">
		<a href="../login.php" class="right">Login</a>
		<a href="../../index.php" class="right">Landing Page</a>
	</div>

	<div class="main">
		<center><img src="../../images/calerhome.png"></center>
		<div class="container">
			<form name="registerForm" action="register.php" onsubmit="return validateRegister()"
				method="post">
				<div class="row">
					<div class="col-25">
						<label for="name">Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="idname" name="name" placeholder="Please enter your name">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="email">Email</label>
					</div>
					<div class="col-75">
						<input type="text" id="idemail" name="email" placeholder="Please enter your email">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="phone">Phone</label>
					</div>
					<div class="col-75">
						<input type="tel" id="idphone" name="phone" placeholder="Please enter your phone number">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="password">Password</label>
					</div>
					<div class="col-75">
						<input type="password" id="idpass" name="password" placeholder="Please enter your password">
					</div>
				</div>
				<div class="row">
					<div><input type="submit" name="registerbutton" value="Register"
							onclick="return confirm('Are you sure want to register?')">
					</div>
				</div>

			</form>

		</div>


	</div>

</body>

</html>