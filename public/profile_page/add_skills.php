<?php include '../../includes/functions.php'; ?>
<?php
$id=5;
$servername = "localhost";
$username = "";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$na="NA";
$number=count($_POST["fields"]);
for($i=0; $i<$number; $i++){
$query="INSERT INTO edit (user_id,skills,level,school,degree,major,languages) VALUES ('".$id."','".$_POST["fields"][$i]."','".$_POST["level"][$i]."','".$na."','".$na."','".$na."','".$na."')";
mysqli_query($conn,$query);
}
// include 'profile.php';
redirect_to("profile.php");
?>
