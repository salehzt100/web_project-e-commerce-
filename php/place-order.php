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
$productID = $_POST['productID'];
$productName = $_POST['productName'];
$userName = $_POST['userName'];
$userAddress = $_POST['userAddress'];
$userPhone = $_POST['userPhone'];

if(isset($userID) && isset($productID))
{
    $orderID = rand(111111111,999999999);

    $insertOrderQuery="INSERT INTO Order_Items (order_id, product_id, quantity, price)
VALUES ($orderID, $productID, 3, 10.99)";


    $insertOrderQuery = "INSERT INTO Order_Details (user_id, order_date, total_amount)
VALUES ($orderID, NOW(), 50.99)";

    $insertOrderQuery = "insert into Order ( user_id, product_id, order_date, order_status, order_address, order_name, order_phone) values ('$orderID', '$userID', '$productID', NOW(), 'pending', '$userAddress', '$userName', '$userPhone')";
    $runInsertOrder = mysqli_query($conn, $insertOrderQuery);
    //echo"<p class='cart-success'> $productName order complete. </p>";
    echo"<script>window.open('../view-order.php?order_id=$orderID', '_self')</script>";
}
else
{
    echo"<script>window.open('../login.php', '_self')</script>";
}

?>