<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_GET['email'];
$otp = $_GET['key'];

$sql = "SELECT * FROM USER WHERE EMAIL = '$email'";
$result = $conn->query($sql);
if($result->num_rows >0){
    $sqlupdate = "UPDATE USER SET OTP = '0' WHERE EMAIL = '$email' AND OTP = '$otp'";
    if ($conn->query($sqlupdate) === TRUE){
        echo "<script> alert('Thank you! Your account has been successfully verified"."\u{1F603}')</script>";
    }else{
        echo "<script> alert('Unable to verify account, please try again later"."\u{1F615}!')</script>";
    }
}else {
    echo "<script> alert('Unable to verify account, please try again later"."\u{1F615}!')</script>";
}

?>