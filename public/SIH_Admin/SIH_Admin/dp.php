<?php
$servername = "localhost";
$username = "root";
$password = "";
error_reporting(0);
// Create connection
$conn = mysqli_connect($servername, $username, $password);

$db = mysqli_select_db("SIH",$conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
