<!DOCTYPE html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zetawiStore";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$userID = $_COOKIE['userID'];
$cartID = $_POST['cartID'];

if (isset($userID) && isset($cartID)) {
    $deleteItemQuery = "DELETE FROM Cart WHERE cart_id = $cartID";
    $runDeleteItem = mysqli_query($conn, $deleteItemQuery);

    $getCartQuery = "SELECT * FROM Cart WHERE user_id='$userID'";
    $rungetCartQuery = mysqli_query($conn, $getCartQuery);
    $cartItemsCount = mysqli_num_rows($rungetCartQuery);
    $totalPrice = 0;

    if ($cartItemsCount > 0) {
        echo "
        <div class='product-container'>
            <h1 id='title'> Cart</h1>";

        while ($rowCart = mysqli_fetch_array($rungetCartQuery)) {
            $productID = $rowCart['product_id'];
            $cartID = $rowCart['cart_id'];

            $getProductQuery = "SELECT * FROM Product WHERE id='$productID'";
            $runProductQuery = mysqli_query($conn, $getProductQuery);
            $rowProduct = mysqli_fetch_array($runProductQuery);
            $productName = $rowProduct['name'];
            $productImage = $rowProduct['image_url'];
            $productDes = $rowProduct['description'];
            $productPrice = $rowProduct['price'];

            $totalPrice = (double)$productPrice + $totalPrice;

            echo "
            <div class='product'>
                <div class='main' onclick=location.href='checkout.php?product_id=$productID'>
                    <img src='../images/$productImage' alt=''>
                    <h1>$productName</h1>
                    <h2>Rs $productPrice</h2>
                </div>
                <img class='delete' src='images/delete.png' alt='' onClick='deleteItem($cartID)'>
            </div>";
        }
        echo "
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
        echo "
            <p id='noItemsInCartLabel'> No Items in the Cart.</p>
        ";
    }
} else {
    echo "<script>
    window.open('../home.php', '_self')
    </script>";
}
?>
