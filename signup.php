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


if(isset($_POST['signup_btn'])){

    $userName = htmlentities(mysqli_real_escape_string($conn,$_POST['userName']));
    $userEmail = htmlentities(mysqli_real_escape_string($conn,$_POST['userEmail']));
    $userPassword = htmlentities(mysqli_real_escape_string($conn,$_POST['userPassword']));

    $check_email = "select * from User where email = '$userEmail'";
    $run_email = mysqli_query($conn,$check_email);
    $check = mysqli_num_rows($run_email);

    if(empty($userName) || empty($userEmail) || empty($userPassword)){
        $_SESSION["error"] = "Fields can not be empty.";
    }
    else if($check == 1){
        $_SESSION["error"] = "Email already exists.";
    }

    if (isset($userName) && isset($userEmail) && isset($userPassword) && $check != 1){

        // Encrypt the password
        $encryptedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $insert = "INSERT INTO User (username, email, password, isadmin, user_imag)
           VALUES ('$userName', '$userEmail', '$encryptedPassword', false, 'user.png')";
        $query = mysqli_query($conn, $insert);
        $userID = mysqli_insert_id($conn);

        setcookie("userID", $userID, time() + (86400 * 7));
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zetawi store - Sign Up</title>
    <link rel="stylesheet" href="styles/login-signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="scripts/cookies-manage.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-container">
                <div class="left-side">
                    <h1><a href="home.php">zetawi store</a></h1>
                </div>
                <div class="right-side">
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
        <div class="main-box">
            <h1>Get Started with zetawi store</h1>
            <form method="post" class="form" action="">

                <input id="user-name" type="text" placeholder="username" name="userName" value="<?php  if (isset($_POST['userName']))  echo $_POST['userName'];?>">
                <input  id="user-email" type="email" placeholder="email" name="userEmail" value="<?php  if (isset($_POST['userEmail']))  echo $_POST['userEmail'];?>">
                <span id="error" ></span>

                <input id="user-password" type="password" placeholder="password" name="userPassword" value="<?php  if (isset($_POST['userPassword']))  echo $_POST['userPassword'];?>">
                <span id="errorpass" ></span>

                <?php if(isset($_SESSION["error"])) {?>
                <p class="error"><?=$_SESSION["error"]?></p>
                <?php unset($_SESSION["error"]);}?>

                <button type="submit" name="signup_btn" onclick="validate()">Sign Up</button>

            </form>
            <p>By clicking signup button, you agree to our Terms of Services and Privacy Policy.</p>
        </div>
    </div>
<script>


    window.onload = function() {
        document.getElementById('user-name').focus();
    };

    // Email validation
    document.getElementById('user-email').addEventListener('keyup', function() {
        var email = this.value;
        var error = document.getElementById('error');
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            error.innerHTML = 'Please enter a valid email address';
            error.style.fontSize = '10px';
            this.style.borderColor = 'red';
        } else {
            error.innerHTML = '';
            this.style.borderColor = 'green';
        }
    });

    // Password validation
    document.getElementById('user-password').addEventListener('keyup', function() {
        var password = this.value;
        var errorpass = document.getElementById('errorpass');
        var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*])[0-9a-zA-Z!@#$%&*]{8,}$/;
        if (!passwordPattern.test(password)) {
            errorpass.innerHTML = 'Password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long';
            errorpass.style.fontSize = '10px';
            errorpass.style.width = this.offsetWidth + 5 + 'px';
            this.style.borderColor = 'red';
        } else {
            errorpass.innerHTML = '';
            this.style.borderColor = 'green';
        }
    });

        function validate() {
            var isValid = true;

            // Password validation
            var password = document.getElementById("user-password").value;
            var errorpass = document.getElementById('errorpass');
            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*])[0-9a-zA-Z!@#$%&*]{8,}$/;
            if (!passwordPattern.test(password)) {
                errorpass.innerHTML = 'Password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long';
                errorpass.style.fontSize = '10px';
                errorpass.style.width = document.getElementById("user-password").offsetWidth + 5 + 'px';
                document.getElementById("user-password").style.borderColor = 'red';
                isValid = false;
            } else {
                errorpass.innerHTML = '';
                document.getElementById("user-password").style.borderColor = 'green';
            }

            // Email validation
            var email = document.getElementById("user-email").value;
            var error = document.getElementById('error');
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                error.innerHTML = 'Please enter a valid email address';
                error.style.fontSize = '10px';
                document.getElementById("user-email").style.borderColor = 'red';
                isValid = false;
            } else {
                error.innerHTML = '';
                document.getElementById("user-email").style.borderColor = 'green';
            }

            return isValid;
        }

        if (validate()){
            window.location.href=`home.php`;
        }
</script>
</body>

</html>