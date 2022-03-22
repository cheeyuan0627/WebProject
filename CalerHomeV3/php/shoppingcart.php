<?php
session_start();
include_once ("dbconnect2.php");
$user_email = $_SESSION["email"];

if ($_SESSION["email"])
{
    $sqlloadcart = "SELECT USERCART.PRODUCTID, USERCART.PRODUCTQTY, FURNITURE.PRODUCTNAME,  FURNITURE.PRODUCTPRICE FROM USERCART INNER JOIN FURNITURE ON USERCART.PRODUCTID = FURNITURE.PRODUCTID WHERE USERCART.EMAIL='$user_email' ORDER BY TIMEADD DESC";
    $stmt = $conn->prepare($sqlloadcart);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

    if (isset($_GET['delete']))
    {
        $proid = $_GET['proid'];
        $sqldelete = "DELETE FROM USERCART WHERE PRODUCTID='$proid' AND EMAIL ='$user_email'";
        $stmt = $conn->prepare($sqldelete);
        if ($stmt->execute())
        {
            echo "<script> alert('Delete Success')</script>";
            echo "<script>window.location.replace('shoppingcart.php')</script>";
        }
        else
        {
            echo "<script> alert('Delete Failed')</script>";
            echo "<script>window.location.replace('mainpage.php')</script>";
        }
    }

    if (isset($_GET['pay']))
    {
        $faddress = $_GET['address'];
        $tprice = $_GET['price'];
        $email = $user_email;
        $phone = $_GET['phone'];
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];

        $api_key = 'ff8c6e68-7b13-4228-a500-086532619923';
        $collection_id = 'sg52frex';
        $host = 'https://billplz-staging.herokuapp.com/api/v3/bills';

        $data = array(
            'collection_id' => $collection_id,
            'email' => $email,
            'mobile' => $phone,
            'name' => $fname . $lname,
            'amount' => $tprice * 100, // RM20
            'description' => 'Payment for order',
            'callback_url' => "https://triold.com/calerhomev3/index.php",
            'redirect_url' => "https://triold.com/calerhomev3/php/paymentupdate.php?userid=$email&mobile=$phone&amount=$tprice&address=$faddress&fname=$fname&lname=$lname"
        );
        $process = curl_init($host);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));

        $return = curl_exec($process);
        curl_close($process);

        $bill = json_decode($return, true);

        // echo "<pre>".print_r($bill, true)."</pre>";
        header("Location: {$bill['url']}");

    }
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
$totalsum = 0.0;
echo "<div class='cartcardrow'>";
foreach ($rows as $products)
{
    $proid = $products['PRODUCTID'];
    $totalprice = 0.0;
    $totalprice = $products['PRODUCTPRICE'] * $products['PRODUCTQTY'];
    echo " <div class='card'>";
    $imgurl = "../images/productimages/" . $products['PRODUCTID'] . ".png";
    echo "<img src='$imgurl' class='primage'>";
    echo "<h3 align='center' >" . ($products['PRODUCTNAME']) . "</h3>";
    echo "<p class='price' align='center' > Price/unit: RM " . number_format($products['PRODUCTPRICE'], 2) . " </p>";
    echo "<p class='price' align='center' > Quantity: " . ($products['PRODUCTQTY']) . " unit/s</p>";
    echo "<p class='price' align='center' > Total Price: RM " . number_format($totalprice, 2) . " </p>";
    echo "<form action='shoppingcart.php' method='get'>";
    echo " <input type='hidden' name='proid' value='$proid' />";
    echo "<button class='btn' name='delete' onclick='return DeleteDialog()' value='delete'><i class='fa fa-trash'></i></button>";
    echo "</form>";
    echo "</div>";
    $totalsum = $totalprice + $totalsum;
}
echo "</div>";
echo "</div>";
?>
          
        <div class="cartcontainer">
  <div class="payment_details">
    <h1>Payment Information</h1>
     <form action="shoppingcart.php" method="get">
    <div class="details_card">
      <div class="name_address">
        <div class="first_lastName">
          <input type="text" name="fname" placeholder="First Name" />
          <input type="text" name="lname" placeholder="Last Name" />
        </div>
        <div class="address">
          <input type="text" name="address" placeholder="Full Address" />
          <input type="text" name="passcode"placeholder="Passcode" />
          <input type="text" name="phone"placeholder="Phone: 10/11 numbers" />
        </div>
      </div>
        <div class="add_savedcard">
          <div class="col-75">
                    <input type="text" id="idemail" name="email" value="<?php echo "User's email: " . $user_email ?>" disabled>
                </div>
                 <div class="col-75">
                    <input type="text" id="idrprice" name="totalprice" value="<?php echo "Total Price to pay: RM" . $totalsum ?>" disabled>
                </div>
                 <div class="col-75">
                    <input type="text" id="idfee" name="fee" value="<?php echo "Delivery Fee: Free for all user" ?>" disabled>
                </div>
                 <div class="col-75">
                    <input type="text" id="iddelivery" name="days" value="<?php echo "Delivery: West Malaysia(3 days)/East Malaysia(5 days)" ?>" disabled>
                </div>
                <div class="col-75">
                    <input type="hidden" name="price" value="<?php echo "$totalsum" ?>"/>
                </div>
        </div>
 
      <div class="proced_payment">
              <input type="submit" name="pay" value="Procced to payment" onclick="return paymentDialog()">
            </div>
         </form>
    </div>
  </div>
   </body>
   
</html>
