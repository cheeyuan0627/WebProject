<?php
$servername = "localhost";
$username   = "trioldco_calerhomeadmin";
$password   = "Teo169399";
$dbname     = "trioldco_calerhome";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>