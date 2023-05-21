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

//getting product data
$getProductDataQuery = "select * from Product where id='$productID'";
$runGetProductDataQuery = mysqli_query($conn, $getProductDataQuery);
$rowProductData = mysqli_fetch_array($runGetProductDataQuery);
$productName = $rowProductData['name'];
$productImage = $rowProductData['image_url'];
$productDes = $rowProductData['description'];
$productPrice = $rowProductData['price'];

$userID = $_COOKIE['userID'];
if(isset($userID))
{
    $getUser = "select * from User where id='$userID'";
    $runUser = mysqli_query($conn, $getUser);
    $rowUser = mysqli_fetch_array($runUser);
    $userName = $rowUser['username'];

    $userImage = $rowUser['image_url'];
}
//det user address
$getUserAddress = "select * from User_Address where id='$userID'";
$runUserAddress = mysqli_query($conn, $getUserAddress);
$rowUserAddress = mysqli_fetch_array($runUserAddress);
   $userAddress = $rowUserAddress['city'].",". $rowUserAddress['street_address'].",". $rowUserAddress['state'].",". $rowUserAddress['zip_code'];
   $userPhone = $rowUserAddress['phone'];


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store</title>
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="stylesheet" href="styles/basic.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <div class="header-container">
            <div class="header">
                <div class="left-side">
                    <h1 onclick="location.href='home.php'">zetawi store</h1>
                </div>
                <div class="center-menu">

                </div>
                <div class="right-side">
                    <?php
                        if(isset($userID))
                        {
                            echo"<img id='dp' src='images/$userImage' alt=''style='border-radius: 50px;' onclick='viewProfile()'/>";
                        }
                        else {
                            echo"<img id='dp' src='images/user.png' alt='' onclick='viewProfile()'>";
                        }
                        ?>
                </div>
            </div>
        </div>

        <div class="order-container">
            <h1 id='title1'>Order Details</h1>
            <?php echo "                  
                <div class='product-container' onclick=location.href='view-product.php?product_id=$productID'>
                    <img src='images/$productImage'>
                    <p id='name'> $productName </p>
                    <p id='price'> Price: <span id='priceValue'>Rs $productPrice</span> </p>
                </div>
            "?>
            <div class='shipping-fee'>
                <p>Shipping Fee</p>
                <p id='value'>Rs 0</p>
                <p>Payment Method</p>
                <p id='value'>Cash on Delivery</p>
            </div>
            <div class='section-three'>
                <p id='title2'>Payment Method: Cash on Delivery</p>
                <div class='payment-method'>
                    <img src='images/cash-on-delivery.png'>
                    <img src='images/credit-card.png'>
                    <img src='images/paypal.png'>
                    <p> Cash on Delivery</p>
                    <p> Debit/Credit Card</p>
                    <p> PayPal</p>
                </div>
            </div>
        </div>

        <div class='additional'>
            <div class='shipping-address'>
                <h1> Shipping Address<spin>
                </h1>
                <?php echo "
                    <form class='shipping-address' method='post'>
                        <input type='text' id='userName' name='userName' value='$userName' placeholder='Receiver name'>
                        <input type='text' id='userAddress' name='userAddress' value='$userAddress' placeholder='Receiver address'>
                        <input type='text' id='userPhone' name='userPhone' value='$userPhone' placeholder='Receiver phone number'>
                        <button type='button'> Edit </button>
                    </form>
                "?>
            </div>
            <div class='total-price'>
                <h1> Total Price</h1>
                <div class='table'>
                    <p> Product Price</p>
                    <?php echo"<p class='right'> Rs $productPrice</p>";?>
                    <p> Shipping Fee</p>
                    <p class='right'> Rs 0</p>
                    <p class='ftotal'> Total Price </p>
                    <?php echo"<p class='right ftotal'> Rs $productPrice</p>";?>
                </div>
                <?php echo"<button type='button' id='confirmBtn' onClick='placeOrder($productID ,\"$productName\")'> Confirm
                    Order</button>"?>
                <div id="loadOrderProcess"></div>
            </div>
        </div>

        <div class="footer-container">
            <div class="footer">

            </div>
        </div>

    </div>
</body>
<script src="jquery/jquery-3.5.1.min.js"></script>
<script src="scripts/checkout.js"></script>

</html>