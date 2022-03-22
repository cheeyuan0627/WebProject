<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <title>MyShop</title>
   <body>
      <div class="header">
         <h1>MyShop</h1>
      </div >
      <?php 
         include_once("dbconnect.php");
         
          $sqlloadproduct = "SELECT * FROM tbl_products";
          $result = $conn-> query($sqlloadproduct);
          
         echo "<table border='1'  class='styled-table'>
          <thead>
         <tr>
         <th>Product Image</th>
         <th>Product Id</th>
         <th>Product Name</th>
         <th>Product Type</th>
         <th>Product Price</th>
         <th>Product Quantity</th>
         <th>Date Created</th>
         <th></th>
         </tr></thead>";
         
         $array = array();
         
         while($row = mysqli_fetch_array($result)){
         echo "<td>" . "<img src=","images/".$row['prid'].".png"," width='250' height='150' />". "</td>";
         echo "<td>" . $row['prid'] . "</td>";
         echo "<td>" . $row['prname'] . "</td>";
         echo "<td>" . $row['prtype'] . "</td>";
         echo "<td>" . $row['prprice'] . "</td>";
         echo "<td>" . $row['prqty'] . "</td>";
         echo "<td>" . $row['datecreated'] . "</td>";
         echo "</tr>";
         }
             
         echo "</table>";
         ?>
      <div id="container-floating" >
         <div class="nd1 nds" data-toggle="tooltip" onClick="window.location='php/newproduct.php'" data-placement="left">
            <img class="reminder">
            <p class="letter">Add Product</p>
         </div>
         <div id="floating-button" data-toggle="tooltip" data-placement="left">
            <p class="plus">+</p>
            <img class="edit" src="edit.png">
         </div>
      </div>
   </body>
</html>