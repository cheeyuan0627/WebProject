<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

include_once("dbconnect.php");
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
             $mail->Body    = "Welcome to CalerHome."."\u{1F603}"." Please use the following link to verify your account :"."\n http://triold.com/calerhome/php/verify_email.php?email=".$email."&key=".$otp;$email.'&key='.$otp;
             $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
             $mail->send();
            echo "<script> alert('Registration successful, please check your email')</script>";
            echo "<script> window.location.replace('../../html/login.html')</script>";
        }else{
            echo "<script> alert('Registration failed')</script>";
            echo "<script> window.location.replace('../../html/register.html')</script>";
        }
     
//    echo 'Message has been sent';
//} catch (Exception $e) {
 //   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//}
