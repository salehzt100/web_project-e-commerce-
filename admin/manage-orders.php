<!DOCTYPE html>
<html lang="en">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zetawiStore";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$getOrdersQuery = "SELECT Order_Details.order_status ,Order_Items.order_id, Order_Items.product_id, Order_Details.order_date, User_Address.street_address, User_Address.city, User_Address.state, User_Address.zip_code, Order_Details.total_amount,User.username
                    FROM Order_Items
                    INNER JOIN Order_Details ON Order_Items.order_id = Order_Details.id
                    INNER JOIN User_Address ON Order_Details.user_id = User_Address.user_id
                    INNER JOIN User ON Order_Details.user_id = User.id";

$runOrdersQuery = mysqli_query($conn, $getOrdersQuery);

if (!$runOrdersQuery) {
    die("Query failed: " . mysqli_error($conn));
}
    ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../styles/admin-basic.css">
    <link rel="stylesheet" href="../styles/admin-manage-orders.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="side-bar">
        <img src="../images/logo.png" onclick="location.href=`../home.php`">
        <ul>
            <li onclick="location.href='dashboard.php'">Dashboard</li>
            <li onclick="location.href='manage-products.php'">Manage Products</li>
            <li onclick="location.href='manage-users.php'">Manage Users</li>
            <li style="color:white; font-weight:600;">Manage Orders</li>
        </ul>
    </div>

    <div class="orders-container">
        <h1> Manage Orders</h1>
        <?php
        while ($rowOrder = mysqli_fetch_array($runOrdersQuery)) {
            $orderID = $rowOrder['order_id'];
            $productID = $rowOrder['product_id'];
            $orderDate = $rowOrder['order_date'];
            $address = $rowOrder['street_address'] . ", " . $rowOrder['city'] . ", " . $rowOrder['state'] . ", " . $rowOrder['zip_code'];
            $totalAmount = $rowOrder['total_amount'];
            $username = $rowOrder['username'];
            $orderStatus=$rowOrder['order_status'];

            echo "
        <div class='order'>
            <h2>#$orderID</h2>
            <div class='main'>
                <div class='order-details'>
                    <p>Product ID: <span>" . htmlspecialchars($productID) . "</span></p>
                    <p>Order Date: <span>" . htmlspecialchars($orderDate) . "</span></p>
                    <p>Total Amount: <span>" . htmlspecialchars($totalAmount) . "</span></p>
                      <p>Order Status: <span>" . htmlspecialchars($orderStatus) . "</span></p>

                </div>
                <div class='order-user'>
                    <p>Address: <span>" . htmlspecialchars($address) . "</span></p>
                    <p>Username: <span>" . htmlspecialchars($username) . "</span></p>

                </div>
            </div>
            <div class='controller'>
                <button class='controller-btns' onClick='manageOrder(\"processing\", $orderID)'>Accept</button>
                <button class='controller-btns' onClick='manageOrder(\"shipped\", $orderID)'>Shipped</button>
                <button class='controller-btns' onClick='manageOrder(\"rejected\", $orderID)'>Reject</button>
            </div>
        </div>
    ";
        }


        mysqli_close($conn);
        ?>

    </div>

</div>
<script src="../jquery/jquery-3.5.1.min.js"></script>
<script src="../scripts/admin.js"></script>
</body>

</html>

