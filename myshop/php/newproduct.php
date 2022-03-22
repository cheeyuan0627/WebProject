<?php 
   include_once("dbconnect.php");
   
    if(isset($_POST['addbutton'])) {
          if ($_POST["name"] === "" || $_POST["type"] === "" || $_POST[price] === "" || $_POST["qty"] === "" ) {
           echo "<script> alert('Please fill in all required information')</script>";
       }else {
       $pid = uniqid(Myshop);
       $pname = $_POST["name"];
       $ptype = $_POST["type"];
       $pprice = $_POST["price"];
       $pqty = $_POST["qty"];
       
    $sqladdproduct = "INSERT INTO tbl_products(prid,prname,prtype,prprice,prqty) VALUES('$pid','$pname','$ptype','$pprice','$pqty')";
     if ($conn->query($sqladdproduct) === TRUE){
           uploadImage($pid);
          echo "<script> alert('Add product successful')</script>";
           echo "<script> window.location.replace('../index.php')</script>";
     }else{
          echo "<script> alert('Add product failed')</script>";
     }
           
       }
   }
   function uploadImage($pid)
   {
       $target_dir = "../images/";
       $target_file = $target_dir . $pid . ".png";
       move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/style.css">
   </head>
   <title>Add New Product</title>
   <body>
      <div class="header">
         <h1>MyShop</h1>
      </div >
      <div class="main">
         <div class="container">
            <form name="AddProductForm" action="../php/newproduct.php" onsubmit=""
               method="post"  enctype="multipart/form-data">
               <div class="row">
                  <div class="col-25">
                     <label for="name">Product Name</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idname" name="name" placeholder="Please enter product name">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="type">Product Type</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idtype" name="type" placeholder="Please enter product type">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="price">Product Price</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idprice" name="price" placeholder="Please enter product price">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="quantity">Product Quantity</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idqty" name="qty" placeholder="Please enter product quantity">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="image">Product Image</label>
                  </div>
                  <div class="col-75">
                     <input type="file" id="myFile" name="filename">
                  </div>
               </div>
               <div class="row">
                  <div><input type="submit" name="addbutton" value="Add Product"
                     onclick="return confirm('Are you sure want to add product?')">
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div id="container-floating" >
         <div class="nd1 nds" data-toggle="tooltip" onClick="window.location='../index.php'" data-placement="left">
            <img class="reminder">
            <p class="letter">Home Page</p>
         </div>
         <div id="floating-button" data-toggle="tooltip" data-placement="left">
            <p class="plus">+</p>
            <img class="edit" src="../edit.png">
         </div>
      </div>
   </body>
</html>