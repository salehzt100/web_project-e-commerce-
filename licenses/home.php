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
$userID = $_COOKIE['userID'];

if(isset($userID))
{
    $getUser = "select * from User where id='$userID'";
    $runUser = mysqli_query($conn, $getUser);
    $row = mysqli_fetch_array($runUser);
    $userName = $row['username'];
    $userImage = $row['user_imag'];
}

//get products data
$getProduct = "select * from Product LIMIT 8";
$runProduct = mysqli_query($conn, $getProduct);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> zetawi store | Home</title>
    <link rel="stylesheet" href="styles/home.css">
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
                            if(empty($userImage)){
                                echo"<img id='dp' src='images/user.png' alt='' onclick='viewProfile()'>";
                            } else{
                                echo"<img id='dp' src='images/$userImage' alt=''style='border-radius: 50px;' onclick='viewProfile()'/>";
                            }
                        }
                        else {
                            echo"<img id='dp' src='images/user.png' alt='' onclick='viewProfile()'>";
                        }
                        ?>
                </div>
            </div>
        </div>

        <div class="banners">
            <div class="slide-show">
                <div class="slide">
                    <img src="images/cover1.webp" alt="">
                </div>
                <div class="slide">
                    <img src="images/cover2.webp" alt="">
                </div>
                <div class="slide">
                    <img src="images/cover3.webp" alt="">
                </div>
            </div>
            <div class="dot-container">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="features">
            <div class="section">
                <img src="images/fast-delivery.png" alt="">
                <h1>Fast Delivery</h1>
            </div>
            <div class="section">
                <img src="images/money-return.png" alt="">
                <h1>Money Return</h1>
            </div>
            <div class="section">
                <img src="images/support.png" alt="">
                <h1>Online Support</h1>
            </div>
            <div class="section">
                <img src="images/security.png" alt="">
                <h1>Payement Security</h1>
            </div>
        </div>

        <div class="serach-bar-container">
            <input id="searchInput" type="text" placeholder="Search for Products">
            <button onclick='search()'>GO</button>
        </div>

        <div class="exclusive-products">
            <h1>Exclusive Products</h1>
            <div class=" container">
                <?php
                    while($rowProduct = mysqli_fetch_array($runProduct)){
                        $productImage = $rowProduct['image_url'];
                        $productName = $rowProduct['name'];
                        $productPrice = $rowProduct['price'];
                        $productID = $rowProduct['id'];

                        echo"
                            <div class='section' onclick=location.href='view-product.php?product_id=$productID'>
                                <img src='images/$productImage' alt=''>
                                <h1>$productName</h1>
                                <h2>USD $productPrice</h2>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>

        <div class="footer-container">

        </div>

    </div>
</body>

<script src="jquery/jquery-3.5.1.min.js"></script>
<script src="scripts/home.js"></script>

</html>