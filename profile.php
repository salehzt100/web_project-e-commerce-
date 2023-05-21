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
$userID = $_COOKIE['userID'];



if(isset($userID))
{
    $getUser = "select * from User where id='$userID'";
    $runUser = mysqli_query($conn, $getUser);
    $row = mysqli_fetch_array($runUser);
    $userName = $row['username'];
    $userEmail = $row['email'];
    $userImage = $row['user_imag'];


    $getUserAddress = "select * from User_Address where id='$userID'";
    $runUserAddress = mysqli_query($conn, $getUserAddress);
    $rowAddress = mysqli_fetch_array($runUserAddress);
    $userAddress = $rowAddress["city"].",".$rowAddress['street_address'].",".$rowAddress["state"].",".$rowAddress["zip_code"];
    $userPhone = $rowAddress['phone'];

    $getOrdersQuery = "SELECT Order_Items.product_id, Order_Items.order_id, Order_Details.order_date
FROM Order_Items
JOIN Order_Details ON Order_Items.order_id = Order_Details.id
";
    $runOrdersQuery = mysqli_query($conn, $getOrdersQuery);
    $ordersCount = mysqli_num_rows($runOrdersQuery);

}
else {
    echo"<script>window.open('home.php', '_self')</script>";
}


?>

    <!DOCTYPE html>
    <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo"$userName"; ?></title>
    <link rel="stylesheet" href="styles/profile.css">
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
            </div>
        </div>
    </div>

    <div class="profile-area">
        <h1 id="title"> Profile</h1>
        <div class="section-one">
            <div class="left">
                <?php
                if(empty($userImage)) {
                    echo" <img src='images/user.png' alt=''>";
                } else {
                    echo" <img src='images/$userImage' alt=''>";
                }
                ?>

            </div>
            <div class="right">
                <?php
                echo"
                    <h1> $userName<h1>
                    <h3> $userEmail <h3>
                    ";
                ?>
            </div>
        </div>
        <div class="section-two">
            <?php
            if(empty($userAddress)) {
                echo"<p> <spin  id='left'>Address:</spin> none </p>";
            } else {
                echo"<p>  <spin  id='left'>Address:</spin> $userAddress </p>";
            }

            if(empty($userPhone)) {
                echo"<p> <spin  id='left'>Phone:</spin> none </p>";
            } else {
                echo"<p>  <spin  id='left'>Phone:</spin> $userPhone </p>";
            }
            ?>

        </div>
        <div class="button-container">
            <button id="editProfileBtn" type='button' onclick='editProfile()'> Edit Profile </button>
            <button id="logoutBtn" type='button' onclick='userLogout()'> Logout </button>
        </div>
    </div>

    <div class='orders-area'>
        <h1 id='title'> Orders</h1>
        <div class='orders'>
            <?php
            if($ordersCount > 0)
            {
                while($rowOrders = mysqli_fetch_array($runOrdersQuery)) {
                    $productID = $rowOrders['product_id'];
                    $orderID = $rowOrders['order_id'];
                    $orderDateTime = $rowOrders['order_date'];

                    $orderDateTimepieces = explode(" ", $orderDateTime);

                    $getProductQuery = "select * from Product where id='$productID'";
                    $runGetProductQuery = mysqli_query($conn, $getProductQuery);
                    $rowProduct = mysqli_fetch_array($runGetProductQuery);

                    $productName = $rowProduct['name'];
                    $productImage = $rowProduct['image_url'];

                    echo"
                   
                        <div class='section' onclick=location.href='view-order.php?order_id=$orderID'>
                            <img src='images/$productImage'>
                            <p id='name'> $productName </p>
                            <p id='id'> #$orderID </p>
                            <p id='date'> $orderDateTimepieces[0] </p>
                        </div>
                     
                    ";
                }
            } else {
                echo"
                    <p id='emptyOrders'> No Orders</p>
                ";
            }
            ?>
        </div>
    </div>

</div>

<div class="footer-container">
    <div class="footer">


    </div>
</div>

<script src="jquery/jquery-3.5.1.min.js"></script>
<script src="scripts/profile.js"></script>

</body>

    </html><?php
