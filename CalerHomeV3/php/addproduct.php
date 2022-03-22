<?php
include_once ("dbconnect.php");

if (isset($_POST['addbutton']))
{
    if ($_POST["name"] === "" || $_POST["type"] === "" || $_POST[price] === "" || $_POST["qty"] === "")
    {
        echo "<script> alert('Please fill in all required information')</script>";
    }
    else
    {
        $pid = uniqid(CH);
        $pname = $_POST["name"];
        $ptype = $_POST["type"];
        $pdes = $_POST["des"];
        $pprice = $_POST["price"];
        $pqty = $_POST["qty"];

        $sqladdproduct = "INSERT INTO FURNITURE(PRODUCTID,PRODUCTNAME,PRODUCTTYPE,DESCRIPTION,PRODUCTPRICE,PRODUCTQUANTITY) VALUES('$pid','$pname','$ptype','$pdes','$pprice','$pqty')";
        if ($conn->query($sqladdproduct) === true)
        {
            uploadImage($pid);
            echo "<script> alert('Add new furniture successful')</script>";
            echo "<script> window.location.replace('addproduct.php')</script>";
        }
        else
        {
            echo "<script> alert('Add furniture failed')</script>";
        }

    }
}
function uploadImage($pid)
{
    $target_dir = "../images/productimages/";
    $target_file = $target_dir . $pid . ".png";
    move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);
}
?>
   
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/calerhome_style.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <title>Add New Product</title>
   <body>
      <div class="header">
         <h1>Caler Home</h1>
      </div >
      <div class="topnavigatorbar" id="myTopnav">
         <a href="mainpageadmin.php" class="right"><i class="fa fa-home"></i> Home</a>
      </div>
      <div class="main">
         <div class="container">
            <form name="AddProductForm" action="../php/addproduct.php" onsubmit=""
               method="post"  enctype="multipart/form-data">
               <div class="row">
                  <div class="col-25">
                     <label for="name">Name: </label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idname" name="name" placeholder="Please enter furniture name">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="type">Type: </label>
                  </div>
                  <div class="col-75">
                     <select id="idtype" name="type">
                        <option value="Sofa">Sofa</option>
                        <option value="Chair">Chair</option>
                        <option value="Table">Table</option>
                        <option value="Bed">Bed</option>
                        <option value="Cabinet">Cabinet</option>
                        <option value="Kitchen Cabinet">Kitchen Cabinet</option>
                        <option value="Book Rack">Book Rack</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="des">Description: </label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="iddes" name="des" placeholder="Please enter furniture description">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="price">Price: </label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idprice" name="price" placeholder="Please enter furniture price">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="quantity">Quantity: </label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="idqty" name="qty" placeholder="Please enter furniture quantity">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="image">Image: </label>
                  </div>
                  <div class="col-75">
                     <i class="fa fa-image"></i>
                     <input type="file" id="myFile" name="filename">
                  </div>
               </div>
               <div class="row">
                  <div><input type="submit" name="addbutton" value="Add Product"
                     onclick="return confirm('Are you sure want to add new furniture?')">
                  </div>
               </div>
            </form>
         </div>
      </div>
      </div>
   </body>
</html>
