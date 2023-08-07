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

$productCountQuery = "select * from Product";
$runproductCountQuery = mysqli_query($conn,$productCountQuery);
$productCount = mysqli_num_rows($runproductCountQuery);

$usersCountQuery = "select * from User";
$runusersCountQuery = mysqli_query($conn,$usersCountQuery);
$usersCount = mysqli_num_rows($runusersCountQuery);

$getUserQuery = "select * from User Order by id desc limit 5";
$rungetUser = mysqli_query($conn, $getUserQuery);

$ordersCountQuery = "select * from Order_Details";
$runOrdersCountQuery = mysqli_query($conn,$ordersCountQuery);
$ordersCount = mysqli_num_rows($runOrdersCountQuery);

$getOrderQuery = "select * from Order_Details Order by id desc limit 5";
$rungetOrder = mysqli_query($conn, $getOrderQuery);

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/admin-basic.css">
    <link rel="stylesheet" href="../styles/admin-dashboard.css">
    <link rel="stylesheet" href="../css/all.min.css">


</head>

<body>
    <div class="container">
        <div class="side-bar">
            <img src="../images/logo.png" onclick="location.href=`../home.php`">
            <ul>
                <li style="color:white; font-weight:600;">Dashboard</li>
                <li onclick="location.href='manage-products.php'">Manage Products</li>
                <li onclick="location.href='manage-users.php'">Manage Users</li>
                <li onclick="location.href='manage-orders.php'">Manage Orders</li>
            </ul>
            <p>Settings</p>
        </div>
        <div class="work-place">
            <div class="summary">
                <div class="products" onclick="location.href='manage-products.php'">
                    <i class="fa-brands fa-product-hunt"></i>

                    <?php echo" <h1>0$productCount Products</h1> "; ?>
                    <p>All products</p>
                </div>
                <div class="users" onclick="location.href='manage-users.php'">
                    <i class="fa-solid fa-users"></i>
                    <?php echo" <h1>0$usersCount Users </h1> "; ?>
                    <p>Registered users</p>
                </div>
                <div class="orders" onclick="location.href='manage-orders.php'">
                    <i class="fa-solid fa-cart-flatbed"></i>

                    <?php echo" <h1>0$ordersCount Orders </h1> "; ?>
                    <p>Pending orders</p>
                </div>
                <div class="admins">
                    <i class="fa-solid fa-user"></i>
                    <h1>01 Admins</h1>
                    <p>Admin panel</p>
                </div>
            </div>

            <div class="summary-two">
                <div class="users-two">
                    <h1> Latest Users </h1>
                    <div class="list">
                        <?php
                        while($rowUsers = mysqli_fetch_array($rungetUser))
                        {
                            $userName = $rowUsers['username'];
                            $userID = $rowUsers['id'];
                            $userImage=$rowUsers['user_imag'];

                            echo"
                           <img src='../images/$userImage' id='userimg'>
                            <p> $userName</p>
                            <p class='right'> #$userID</p>
                            ";
                        }
                        ?>
                    </div>
                </div>
                <div class="orders-two">
                    <h1> Pending Orders </h1>
                    <div class="list">
                        <?php
                        while($rowOrders = mysqli_fetch_array($rungetOrder))
                        {
                            $orderID = $rowOrders['id'];
                            $orderDate = $rowOrders['order_date'];
                            $totalAmount=$rowOrders['total_amount'];


                            echo"
                            <p>  $orderDate </p>
                            <p>$totalAmount$</p>
                            <p class='right'>  #$orderID </p>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/admin.js"></script>
</body>

</html>