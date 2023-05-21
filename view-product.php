<!DOCTYPE html>

<?php

//getting users data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zetawiStore";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$productID = $_GET["product_id"];
if(!isset($productID))
{
    echo"<script>window.open('home.php', '_self')</script>";
}

//geting product data
$getProduct = "select * from Product where id='$productID'";
$runProduct = mysqli_query($conn, $getProduct);
$rowProduct = mysqli_fetch_array($runProduct);
$productName = $rowProduct['name'];
$productImage = $rowProduct['image_url'];
$productDes = $rowProduct['description'];
$productPrice = $rowProduct['price'];

$userID = $_COOKIE['userID'];
if(isset($userID))
{
    $getUser = "select * from User where id='$userID'";
    $runUser = mysqli_query($conn, $getUser);
    $row = mysqli_fetch_array($runUser);
    $userName = $row['username'];
    $userImage = $row['user_image'];
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store</title>
    <link rel="stylesheet" href="styles/view-product.css">
    <link rel="stylesheet" href="styles/basic.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
</head>

<body>
<div class="wrapper">

    <div class="header-container">
        <div class="header">
            <div class="left-side">

                <img src="images/logo.png" id="logo1" style="width: 170px;" onclick="location.href='home.php'">

            </div>
            <div class="center-menu">

            </div>
            <div class="right-side">
                <img id="cart" src="images/shopping-cart.png" onclick="cart()" alt="">
                <?php
                if(isset($userID))
                {// user 2020
                    echo"<img id='dp' src='images/$userImage' alt=''style='border-radius: 50px;' onclick='viewProfile()'/>";
                }
                else {
                    echo"<img id='dp' src='images/user.png' alt='' onclick='viewProfile()'>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="product">
        <div class="image">
            <?php echo"<img src='images/$productImage' alt=''>"?>
        </div>
        <div class="details">
            <?php echo"<h1>$productName</h1>"?>
            <?php echo"<h2>Rs $productPrice</h2>"?>
            <?php echo"<p>$productDes</p>"?>
            <div class="buttons">
                <?php echo"<button id='buy_btn' class='buy' onclick=location.href='checkout.php?product_id=$productID'>Buy</button>"?>
                <?php echo"<button id='adcart_btn' class='adcart' onClick='addToCart($productID ,\"$productName\")'>Add to Cart</button>"?>
            </div>
            <div id="cartSucess"></div>
        </div>
    </div>

</div>
</body>

<script src="jquery/jquery-3.5.1.min.js"></script>
<script src="scripts/view-product.js"></script>


</html>