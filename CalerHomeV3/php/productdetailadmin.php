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

if (isset($_GET['delete']))
{
    $proid = $_GET['proid'];
    $sqldelete = "DELETE FROM FURNITURE WHERE PRODUCTID = '$proid' ";
    if ($conn->exec($sqldelete))
    {
        echo "<script>alert('Delete Success');</script>";
        echo "<script> window.location.replace('mainpageadmin.php')</script>";
    }
}

if (isset($_POST['update']))
{
    $proid = $_POST['proid'];
    $pname = $_POST['pname'];
    $pdes = $_POST['pdes'];
    $ptype = $_POST['ptype'];
    $pprice = $_POST['pprice'];
    $pqty = $_POST['pqty'];

    $sqlupdate = "UPDATE FURNITURE SET PRODUCTNAME = '$pname', DESCRIPTION = '$pdes', PRODUCTTYPE = '$ptype', PRODUCTPRICE = '$pprice', PRODUCTQUANTITY = '$pqty' WHERE PRODUCTID = '$proid' ";
    if ($conn->exec($sqlupdate))
    {
        uploadImage($proid);
        echo "<script>alert('Update Success');</script>";
        echo "<script> window.location.replace('mainpageadmin.php')</script>";
    }
    else
    {
        echo "<script>alert('Update Failed');</script>";
        echo "<script> window.location.replace('mainpageadmin.php');</script>";
    }
}

function uploadImage($proid)
{
    $target_dir = "../images/productimages/";
    $target_file = $target_dir . $proid . ".png";
    move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../javascript/calerhome.js"></script>
	<link rel="stylesheet" href="../css/calerhome_style.css">
	<link rel="stylesheet" href="../css/calerhome_style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onload="loadCookies()">
	<div class="header">
		<h1>Caler Home</h1>
		<p>Application For Anyone Who Loves Furniture</p>
	</div>
	<div class="topnavigatorbar" id="myTopnav">
		<a href="mainpageadmin.php" class="right"><i class="fa fa-home"></i> Home</a>
	</div>
	 <?php
echo "<h2 class='price' align='center' > Furniture ID: " . ($proid) . " </h2>";
echo "<form action='productdetailadmin.php' method='post'enctype='multipart/form-data'>";
echo " <img src='$primg' class='editdetailimg' align='left' />";
echo " <div class='detailedit'>";
echo "<input type='text' id='pname' name='pname' placeholder='Furniture Name: $proname'>";
echo "<select id='idprtype' name='ptype' >
     <option selected value='default' selected disabled hidden>$protype</option>
                   <option value='Sofa'>Sofa</option>
                        <option value='Chair'>Chair</option>
                        <option value='Table'>Table</option>
                        <option value='Bed'>Bed</option>
                        <option value='Cabinet'>Cabinet</option>
                        <option value='Kitchen Cabinet'>Kitchen Cabinet</option>
                        <option value='Book Rack'>Book Rack</option>
               </select>";
echo "<input type='text' id='pdes' name='pdes'  placeholder='Furniture Description: $prodes'>";
echo "<input type='text' id='pprice' name='pprice'  placeholder='Furniture price: RM$proprice'>";
echo "<input type='text' id='pqty' name='pqty'  placeholder='Furniture Quantity: $qty unit/s'>";
echo " <input type='hidden' name='proid' value='$proid' />";
echo " <i class='fa fa-image'></i>";
echo " <input type='file' id='myFile' name='filename'>";
echo "<input style='margin-top: 5%; ' type='submit' value='Update Product' name='update' onclick='return UpdateDialog()'>";
echo "</form>";
echo "<form action='productdetailadmin.php' method='get'>";
echo " <input type='hidden' name='proid' value='$proid' />";
echo "<input  ' type='submit'value='Delete Product' name='delete' onclick='return DeleteDialog()'>";
echo "</form>";
echo "</div>";
?>
</body>

</html>
