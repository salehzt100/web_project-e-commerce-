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
$userEmail = $_COOKIE['userEmail'];
$userAddress = $_POST['userAddress'];

$userName = $_POST['userName'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userEmail = htmlentities(mysqli_real_escape_string($_POST['userEmail']));
    echo"<script>alert($userName)</script>";
}



if(isset($userEmail) && isset($userID))
{
    echo"<script>alert($userID )</script>";
    $insertUserDataQuery = "update User set email='$userEmail', name='$userName', user_address='$userAddress' where user_id = '$userID'";
    echo"<script>alert($userID )</script>";
    $runinsertUserDataQuery = mysqli_query($conn, $insertUserDataQuery);
}
else
{
    //echo"<script>window.open('../home.php', '_self')</script>";
}

?>