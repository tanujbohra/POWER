<?php
$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$conn = mysqli_connect($servername, $username, $password,"power");

// $db = mysql_select_db("SIH",$conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
$selected_user=$_POST["user_id"];
$query = "UPDATE user SET status=1 where user_id='".$selected_user."'";
$result = mysqli_query($conn,$query);
include 'users.php';
?>
