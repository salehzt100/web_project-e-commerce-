<?php
session_start(); // Add this line to start the session

//getting users data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zetawiStore";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login_btn'])) {
    $userEmail = htmlentities(mysqli_real_escape_string($conn, $_POST['userEmail']));
    $userPassword = htmlentities(mysqli_real_escape_string($conn, $_POST['userPassword']));

    $selectUser = "select * from User where email='$userEmail'";
    $query = mysqli_query($conn, $selectUser);
    $check = mysqli_num_rows($query);

    if(empty($userEmail) || empty($userPassword)){
        $_SESSION["error"] = "Fields can not be empty.";
    }

    else {
        if($check == 1) {
            $row = mysqli_fetch_array($query);
            $storedPassword = $row['password'];

            // Verify the entered password with the stored password
            if (password_verify($userPassword, $storedPassword)) {
                $userID = $row['id'];
                $isAdmin = $row['isadmin'];
                setcookie("userID", $userID, time() + (86400 * 7));
                if ($isAdmin){
                    echo"<script>window.open('admin/dashboard.php', '_self')</script>";
                } else {
                    echo "<script>window.open('home.php', '_self')</script>";
                }
            } else {
                $_SESSION["error"] = "Wrong email or password.";
            }
        }
        else {
            $_SESSION["error"] = "Wrong email or password.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store - Login</title>
    <link rel="stylesheet" href="/styles/login-signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-container">
                <div class="left-side">
                    <h1><a href="home.php">zetawi store</a></h1>
                </div>
                <div class="right-side">
                    <a href="signup.php">SignUp</a>
                </div>
            </div>
        </div>
        <div class="main-box">
            <h1>Welcome Back</h1>
            <form method="POST" class="form" action="" >

                <input type="text" placeholder="email" name="userEmail" id="user-email">
                <span id="error" ></span>
                <input type="password" placeholder="password" name="userPassword" id="user-password">
                <span id="errorpass" ></span>


                <?php if(isset($_SESSION["error"])) {?>
                <p class="error"><?=$_SESSION["error"]?></p>
                <?php unset($_SESSION["error"]);}?>

                <p class="fp">Forgot Password?</p>
                <button type="submit" name="login_btn" >Login</button>
            </form>
        </div>
    </div>
   <script src="login.js"></script>
</body>

</html>