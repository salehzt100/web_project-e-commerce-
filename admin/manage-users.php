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

$getUsersQuery = "select * from User";
$runUsersQuery = mysqli_query($conn, $getUsersQuery);


unset($_POST['submit']);

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users </title>
    <link rel="stylesheet" href="../styles/admin-basic.css">
    <link rel="stylesheet" href="../styles/admin-manage-users.css">
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
                <li style="color:white; font-weight:600;">Manage Users</li>
                <li onclick="location.href='manage-orders.php'">Manage Orders</li>
            </ul>
        </div>

        <div class="users-container">
            <h1> Manage Users</h1>
            <?php
                while($rowUsers = mysqli_fetch_array($runUsersQuery))
                {
                    $userName = $rowUsers['username'];
                    $userID = $rowUsers['id'];
                    $userEmail = $rowUsers['email'];
                    $userImage = $rowUsers['user_imag'];
                    echo"
                    <div class='user'>
                        <div class='main' onclick=location.href='../profile.php'>
                            <img src='../images/$userImage' alt=''>    
                            <h2>#$userID</h2>
                            <p> $userName </p>
                            <p> $userEmail </p>
                        </div>
                    <img class='delete' src='../images/delete.png' alt='' onClick='deleteUser($userID)' title='Delete'>
                    </div>";
                }
            ?>
        </div>

    </div>
    <script src="../jquery/jquery-3.5.1.min.js"></script>
    <script src="../scripts/admin.js"></script>
</body>

</html>