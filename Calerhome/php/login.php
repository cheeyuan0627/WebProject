<?php
include_once("dbconnect.php");
$email = $_POST['email'];
$password = sha1($_POST['password']);

$sqllogin = "SELECT * FROM USER WHERE EMAIL= '$email' AND PASSWORD= '$password' AND OTP = '0'";
$result = $conn->query($sqllogin);

if($result->num_rows >0){
    while($row = $result -> fetch_assoc()){
    echo "<script> alert('Login successful')</script>";
    echo "<script> window.location.replace('../html/mainpage.html')</script>";
    }
}else{
    echo "<script> alert('Login fail')</script>";
    echo "<script> window.location.replace('../html/login.html')</script>";
}

?>
