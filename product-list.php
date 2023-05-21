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
$searchKeyword = $_GET["search_keyword"];

if(isset($userID))
{
    $getUser = "select * from User where id='$userID'";
    $runUser = mysqli_query($conn, $getUser);
    $row = mysqli_fetch_array($runUser);
    $userName = $row['username'];
    $userImage = $row['user_image'];
}

//get products data
if(isset($searchKeyword))
{
    $getProductQuery = "select * from Product where name like '%".$searchKeyword."%'";
    $runProductQuery = mysqli_query($conn, $getProductQuery);
    $numberOfProducts = mysqli_num_rows($runProductQuery);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store | Home</title>
    <link rel="stylesheet" href="styles/product-list.css">
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

        <div class="main-container">
            <div class="serach-bar">
                <?php echo"<input id='searchInput' type='text' value='$searchKeyword' placeholder='Search for Products'>";?>
                <button onclick='search()'>GO</button>
            </div>
            <div class="product-list">
                <?php
                if($numberOfProducts != 0)
                {
                    while($productRow = mysqli_fetch_array($runProductQuery)){
                        $productImage = $productRow['image_url'];
                        $productName = $productRow['name'];
                        $productPrice = $productRow['price'];
                        $productID = $productRow['id'];

                        echo"
                        <div class='product' onclick=location.href='view-product.php?product_id=$productID'>
                            <img src='images/$productImage' alt=''>
                            <h1>$productName</h1>
                            <h2>Rs $productPrice</h2>
                        </div>
                        ";
                    }
                } else {
                    echo"<h3>None of the products matched this search</h3>";
                }
                
                ?>
            </div>
        </div>



    </div>
</body>

<script src="jquery/jquery-3.5.1.min.js"></script>
<script src="scripts/home.js"></script>

</html>