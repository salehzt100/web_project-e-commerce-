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

if(isset($userID))
{
    $insertCartQuery = "insert into Cart (user_id, product_id) values ('$userID', '$productID')";
    $runInsertCart = mysqli_query($conn, $insertCartQuery);
    echo"<p class='cart-success'> $productName added to cart. </p>";
}
else
{
    echo"<script>window.open('../login.php', '_self')</script>";
}

?>