<?php
   session_start();
   include_once("dbconnect2.php");
   
   $user_email = $_SESSION["email"];
   
   if ($_SESSION["email"]) {
       if(isset($_GET['button'])) {
              $prtype = $_GET['prtype'];
           if ($prtype == "all") {
        $sqlsearch = "SELECT * FROM FURNITURE ORDER BY DATEADD DESC";
         $stmt = $conn->prepare($sqlsearch);
             $stmt->execute();
             $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
             $rows = $stmt->fetchAll();
    } else{
             $prtype = $_GET['prtype'];
             $sqlsearch = "SELECT * FROM FURNITURE WHERE PRODUCTTYPE = '$prtype' ORDER BY DATEADD DESC";
             $stmt = $conn->prepare($sqlsearch);
             $stmt->execute();
             $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
             $rows = $stmt->fetchAll();}
       }else{
       $sqlloadfurniture = "SELECT * FROM FURNITURE ORDER BY DATEADD DESC";
       $stmt = $conn->prepare($sqlloadfurniture);
       $stmt->execute();
       $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
       $rows = $stmt->fetchAll();}
   } else {
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
   </head>
   <body>
      <div class="header">
         <h1>Caler Home</h1>
         <p>Application For Anyone Who Loves Furniture</p>
      </div>
      <div class="topnavigatorbar" id="myTopnav">
         <a href="login.php" onclick="return confirm('Are you sure want to logout?')" class="right">Logout</a>
         <a href="addproduct.php" class="left">Add New</a>
         <a href="" class="left">Check Order</a>
      </div>
      <div class="main">
      <div class="row-single">
      <div class="card-header" type="submit">
      <h3>Welcome Back Caler Home Admin</h3>
      <p><?php echo $user_email ?></p>
      <?php
         ?>
      <form action="mainpageadmin.php" method="get">
         <div class="row">
            <div class="column">
               <select id="idprtype" name="prtype">
                  <option value="all">All Types</option>
                  <option value="sofas">Sofas</option>
                  <option value="chairs">Chairs</option>
                  <option value="tables">Tables</option>
               </select>
            </div>
            <div class="columns">
               <input type="submit" name="button" value="Search">
            </div>
         </div>
      </form>
      <?php
         echo "<div class='prcontainer'>";
         echo "<div class='card-row'>";
         foreach ($rows as $products){
         echo " <div class='card'>";
         $imgurl = "../images/productimages/" . $products['PRODUCTID'].".png";
         echo "<img src='$imgurl' class='primage'>";
         echo "<h3 align='center' >" . ($products['PRODUCTNAME']) . "</h3>";
         echo "<p class='price' align='center' > Furniture Type: " . ($products['PRODUCTTYPE']) . " </p>";
         echo "<p class='price' align='center' > Price: RM" . number_format($products['PRODUCTPRICE'], 2) . "</p>";
         echo "<p class='price' align='center' > Quantity: " . ($products['PRODUCTQUANTITY']) . " unit/s</p>";
         echo "<p><button>Edit</button></p>";
         echo "</div>";
          }
            echo "</div>";
         echo "</div>"
          ?>
   </body>
</html>