<?php
error_reporting(0);
include_once ("dbconnect.php");
$email = $_GET['userid'];
$phone = $_GET['mobile'];
$tprice = $_GET['amount'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$faddress = $_GET['address'];

$data = array(
    'id' => $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'],
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];

if ($paidstatus == "true")
{
    $receiptid = $_GET['billplz']['id'];

    $sqlinsertpurchased = "INSERT INTO PAYMENT(ORDERID,EMAIL,PAID,STATUS,PHONE,ADDRESS,FNAME,LNAME) VALUES('$receiptid','$email', '$tprice','paid','$phone','$faddress','$fname','$lname')";
    $conn->query($sqlinsertpurchased);
    $sqldeletecart = "DELETE FROM USERCART WHERE email='$email'";
    $conn->query($sqldeletecart);

    echo '<br><br><body><div><h2><br><br><center>Your Receipt</center>
     </h1>
     <table border=1 width=70% height=50% align=center>
     <tr><td>Receipt ID</td><td>' . $receiptid . '</td></tr><tr><td>Email to </td>
     <td>' . $email . ' </td></tr><td>Amount </td><td>RM ' . $tprice . '</td></tr>
     <tr><td>Payment Status </td><td>' . $paidstatus . '</td></tr>
     <tr><td>Date </td><td>' . date("d/m/Y") . '</td></tr>
     <tr><td>Time </td><td>' . date("h:i a") . '</td></tr>
     </table><br>
     <p style="text-align:center">
     <a  href=' . 'https://www.triold.com/calerhomev3/php/shoppingcart.php' . '>Press this link to return to Caler Home</a>
     </p>';

}
else
{
    echo "<script>alert('Payment Failed')</script>";
    echo "<script>window.location.replace('shoppingcart.php')</script>";
}
?>
