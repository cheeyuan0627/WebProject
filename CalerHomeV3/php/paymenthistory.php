<?php
session_start();
include_once ("dbconnect2.php");
$user_email = $_SESSION["email"];

if ($_SESSION["email"])
{
    $sqlloadpayment = "SELECT * FROM PAYMENT WHERE EMAIL ='$user_email' ORDER BY DATE DESC ";
    $stmt = $conn->prepare($sqlloadpayment);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
}
else
{
    echo "<script> alert('Please login again')</script>";
    echo "<script> window.location.replace('../php/login.php')</script>";
}

?>

<!DOCTYPE html>
<html>
   <head>
      <title>Main Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/calerhome_style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="../javascript/calerhome.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   </head>
   <body>
        <div class="header">
         <h1>Caler Home</h1>
         <p>Application For Anyone Who Loves Furniture</p>
      </div>
      <div class="topnavigatorbar" id="myTopnav">
         <a href="mainpage.php" class="right"><i class="fa fa-home"></i> Home</a>
      </div>
      <div class="main">
      <div class="row-single">
      <div class="card-header" type="submit">
      <?php
echo "<div class='cardpayment'>";
foreach ($rows as $products)
{
    echo " <div class='card'>";
    echo "<h3 align='center' >Your Order Id: " . ($products['ORDERID']) . "</h3>";
    echo "<p class='price' align='left' > Total Paid: RM " . number_format($products['PAID'], 2) . " </p>";
    echo "<p class='price' align='left' > Payment Status: " . ($products['STATUS']) . " </p>";
    echo "<p class='price' align='left' > Address: " . ($products['ADDRESS']) . " </p>";
    echo "<p class='price' align='left' > Date/Time Paid: " . ($products['DATE']) . " </p>";
    echo "</div>";
}
echo "</div>";
echo "</div>";
?>
   </body>
   
</html>
