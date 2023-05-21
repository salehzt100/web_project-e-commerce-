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
else
{
    echo"<script>window.open('home.php', '_self')</script>";
}

//geting cart data
$getCartQuery = "select * from Cart where user_id='$userID'";
$rungetCartQuery = mysqli_query($conn, $getCartQuery);
$cartItemsCount = mysqli_num_rows($rungetCartQuery);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store | Cart</title>
    <link rel="stylesheet" href="styles/cart.css">
    <link rel="stylesheet" href="styles/basic.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <!--########## Start of Header ##########-->
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
                            if(empty($userImage)){
                                echo"<img id='dp' src='images/user.png' alt='' onclick='viewProfile()'>";
                            } else{
                                echo"<img id='dp' src='storage/users/$userImage' alt=''style='border-radius: 50px;' onclick='viewProfile()'/>";
                            }
                        }
                        else {
                            echo"<img id='dp' src='images/user.png' alt='' onclick='viewProfile()'>";
                        }
                        ?>
                </div>
            </div>
        </div>
        <!--########## End of Header ##########-->

        <!--########## Start of Cart Container ##########-->

        <div class='cart-container'>

            <?php
            if($cartItemsCount > 0) {
            echo"
            <div class='product-container'>
                <h1 id='title'> Cart</h1>";


                while($rowCart = mysqli_fetch_array($rungetCartQuery))
                {
                    $productID = $rowCart['product_id'];
                    $cartID = $rowCart['cart_id'];

                    $getProductQuery = "select * from Product where id='$productID'";
                    $runProductQuery = mysqli_query($conn, $getProductQuery);
                    $rowProduct = mysqli_fetch_array($runProductQuery);
                    $productName = $rowProduct['name'];
                    $productImage = $rowProduct['image_url'];
                    $productDes = $rowProduct['description'];
                    $productPrice = $rowProduct['price'];

                    $totalPrice = (double)$productPrice ;

                    echo"
                    <div class='product'>
                        <div class='main' onclick=location.href='checkout.php?product_id=$productID'>
                            <img src='images/$productImage' alt=''>
                            <h1>$productName</h1>
                            <h2>Rs $productPrice</h2>
                        </div>
                        <img class='delete' src='images/delete.png' alt='' onClick='deleteItem($cartID)'>
                    </div>";
                }
            echo"
            </div>
        
            <div class='cart-summary'>
                <h1>Summary</h1>
                <div>
                    <p class='left'>Sub Total</p> 
                    <p>Rs. $totalPrice </p>
                    <p class='left'>Shipping Fee</p>
                    <p>0</p>
                    <p class='left total'>Total</p>
                    <p class='total'>Rs. $totalPrice </p>
                </div>
            </div> ";
            } else {
                echo"
                <p id='noItemsInCartLabel'> No Items in the Cart.</p>
            ";
            }?>
        </div>

        <!--########## End of Cart Container ##########-->
    </div>

    <div class="footer-container">
        <div class="footer">

        </div>
    </div>

    <script src="scripts/cart.js"></script>
    <script src="jquery/jquery-3.5.1.min.js"></script>

</body>



</html>