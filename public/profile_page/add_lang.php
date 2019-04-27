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
$number=count($_POST["lang"]);
for($i=0; $i<$number; $i++){
$query="INSERT INTO edit (user_id,skills,level,school,degree,major,languages) VALUES ('".$id."','".$na."','".$na."','".$na."','".$na."','".$na."','".$_POST["lang"][$i]."')";
mysqli_query($conn,$query);
}
// include 'profile.php';
redirect_to("profile.php");
?>
