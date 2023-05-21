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
$orderID = $_GET["order_id"];
$userID = $_COOKIE['userID'];

if(!isset($orderID) || !isset($userID))
{
    echo"<script>window.open('home.php', '_self')</script>";
}

if(isset($userID))
{
    $getUser = "select * from User where id='$userID'";
    $runUser = mysqli_query($conn, $getUser);
    $row = mysqli_fetch_array($runUser);
    $userName = $row['username'];
    $userImage = $row['user_imag'];
}

//geting order data

$getOrdersQuery = "SELECT Order_Details.order_date, Order_Items.product_id, Order_Details.order_status, User_Address.street_address AS order_address, User.username AS order_name, User_Address.phone AS order_phone
                    FROM Order_Items
                    INNER JOIN Order_Details ON Order_Items.order_id = Order_Details.id
                    INNER JOIN User_Address ON Order_Details.user_id = User_Address.user_id
                    INNER JOIN User ON Order_Details.user_id = User.id";

$runOrdersQuery = mysqli_query($conn, $getOrdersQuery);

if (!$runOrdersQuery) {
    die("Query failed: " . mysqli_error($conn));
}

$rowOrderData = mysqli_fetch_array($runOrdersQuery);
$orderDate = $rowOrderData['order_date'];
$productID = $rowOrderData['product_id'];
$OrderStatus = $rowOrderData['order_status'];
$OrderAddress = $rowOrderData['order_address'];
$orderName = $rowOrderData['order_name'];
$orderphone = $rowOrderData['order_phone'];

echo"<script> var orderStatus = '$OrderStatus';</script>";

//getting product data
$getProductDataQuery = "select * from Product where id='$productID'";
$runGetProductDataQuery = mysqli_query($conn, $getProductDataQuery);
$rowProductData = mysqli_fetch_array($runGetProductDataQuery);
$productName = $rowProductData['name'];
$productImage = $rowProductData['image_url'];
$productPrice = $rowProductData['price'];
$productDes = $rowProductData['description'];

if(isset($_POST['order-cancel-btn'])){
   
    if(strval($OrderStatus) == 'pending') {
        $changeStatusQuery = "UPDATE Order_details SET order_status='cancelled' WHERE order_id= $orderID";
        $runQuery = mysqli_query($conn, $changeStatusQuery);
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store</title>
    <link rel="stylesheet" href="styles/view-order.css">
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
                    <img id="cart" src="images/shopping-cart.png" onclick="cart()" alt="">
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
            <div class='section-one'>
                <div>
                    <?php echo"<p> Order #$orderID</p>";?>
                    <?php echo"<p id='date'> Placed on $orderDate</p>";?>
                </div>
            </div>
            <?php echo "                  
                <div class='section-two' onclick=location.href='view-product.php?product_id=$productID'>
                    <img src='images/$productImage'>
                    <p id='name'> $productName <br> <spin id='btn'> See more details about this product </spin></p>
                    <p id='price'> Total Price: <span class='highlight'>USD $productPrice</span> <br> Pay by Cash on delivery </p>
                </div>
            "?>

            <div class='section-three'>
                <?php echo"<p id='title2'>Order Status: $OrderStatus</p>";?>
                <div class='order-status'>
                    <div id='line'>
                        <div id='line1'></div>
                        <div id='line2'></div>
                        <div id='line3'></div>
                    </div>
                    <div id='pending'></div>
                    <div id='processing'></div>
                    <div id='shipped'></div>
                    <div id='delivered'></div>
                </div>
                <div class='order-status'>
                    <p id='pending2'>Pending</p>
                    <p id='processing2'>Processing</p>
                    <p id='shipped2'>Shipped</p>
                    <p id='delivered2'>Delivered</p>
                </div>
            </div>

            <div class='section-four'>
                <form name="cancelSubmitForm" method="post" >
                    <button name="order-cancel-btn" id="order-cancel-btn" type='submit'> Cancel Order</button>
                    <button type='button'> Contact zetawi store</button>
                </form>
                
            </div>
        </div>

        <div class='additional'>
            <div class='address'>
            <?php
            echo"
            <h1> Shipping Address</h1>
            <p> $orderName</p>
            <p> $OrderAddress </p>
            <p> $orderphone</p>
            ";
            ?>

            </div>
            <div class='total'>
                <h1> Total Price</h1>
                <div class='table'>
                    <p> Sub Total</p>
                    <?php echo"<p class='right'> USD $productPrice</p>";?>
                    <p> Shipping Fee</p>
                    <p class='right'> USD 0</p>
                    <p class='ftotal'> Total Price </p>
                    <?php echo"<p class='right ftotal'> USD $productPrice</p>";?>

                </div>
            </div>
        </div>

        <div class="footer-container">

        </div>

    </div>
</body>

<script src="jquery/jquery-3.5.1.min.js"></script>
<script src="scripts/view-order.js"></script>

</html>