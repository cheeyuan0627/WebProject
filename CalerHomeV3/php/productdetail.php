<?php
session_start();
include_once ("dbconnect2.php");

$primg = $_GET['primg'];
$proid = $_GET['proid'];
$proname = $_GET['proname'];
$protype = $_GET['protype'];
$prodes = $_GET['prodes'];
$proprice = $_GET['proprice'];
$qty = $_GET['qty'];
$dateadd = $_GET['dateadd'];

$user_email = $_SESSION["email"];

if (isset($_GET['add']))
{
    $proid = $_GET['proid'];
    $prqty = $_GET['qtychoise'];
    $sqlcheckqty = "SELECT * FROM FURNITURE WHERE PRODUCTID = '$proid' ";
    $stmt = $conn->prepare($sqlcheckqty);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    foreach ($rows as $product)
    {
        $quantity = $product['PRODUCTQUANTITY'];
        if ($quantity == 0)
        {
            echo "<script>alert('Furniture out of stock');</script>";
            echo "<script> window.location.replace('mainpage.php')</script>";
        }
        else
        {
            $sqlcheckcart = "SELECT * FROM USERCART WHERE PRODUCTID = '$proid' AND  EMAIL = '$user_email'";
            $stmt = $conn->prepare($sqlcheckcart);
            $stmt->execute();
            $number_of_result = $stmt->rowCount();
            if ($number_of_result == 0)
            {
                $sqladdtocart = "INSERT INTO USERCART (EMAIL, PRODUCTID, PRODUCTQTY) VALUES ('$user_email','$proid','$prqty')";
                if ($conn->exec($sqladdtocart))
                {
                    echo "<script>alert('Add Success')</script>";
                    echo "<script> window.location.replace('mainpage.php')</script>";
                }
                else
                {
                    echo "<script>alert('Add Failed')</script>";
                    echo "<script> window.location.replace('mainpage.php')</script>";
                }
            }
            else
            {
                $sqlupdatecart = "UPDATE USERCART SET PRODUCTQTY = '$prqty' WHERE PRODUCTID = '$proid' AND EMAIL = '$user_email'";
                if ($conn->exec($sqlupdatecart))
                {
                    echo "<script>alert('Update Success')</script>";
                    echo "<script> window.location.replace('mainpage.php')</script>";
                }
                else
                {
                    echo "<script>alert('Update Failed')</script>";
                    echo "<script> window.location.replace('mainpage.php')</script>";
                }
            }
        }
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onload="loadCookies()">
	<div class="header">
		<h1>Caler Home</h1>
		<p>Application For Anyone Who Loves Furniture</p>
	</div>
	<div class="topnavigatorbar" id="myTopnav">
		<a href="mainpage.php" class="right"><i class="fa fa-home"></i> Home</a>
	</div>
	 <?php
echo " <img src='$primg' class='detailimg' align='left' />";
echo " <div class='detailcard'>";
echo "<h2 align='center' >" . ($proname) . "</h2>";
echo "<p class='price' align='center' > Furniture ID: " . ($proid) . " </p>";
echo "<p class='price' align='center' > Furniture Type: " . ($protype) . " </p>";
echo "<p class='price' align='center' > Furniture Description: " . ($prodes) . " </p>";
echo "<p class='price' align='center' > Furniture Price: " . ($proprice) . " </p>";
echo "<p class='price' align='center' > Furniture QTY: " . ($qty) . " </p>";
echo "<p class='price' align='center' > Date Add: " . ($dateadd) . " </p>";
echo "<form action='productdetail.php' method='get'>";
echo " <input type='hidden' name='proid' value='$proid' />";
echo "<input type='number' value='0' id='qtychoise' name='qtychoise' min='0' max='$qty'>";
echo "<input style='margin-top: 3%;' type='submit'value='Add To Cart' name='add' onclick='return cartDialog()'>";
echo "</form>";
echo "</div>";
?>
</body>

</html>
