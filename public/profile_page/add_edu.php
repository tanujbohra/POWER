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
$number=count($_POST["Schoolname"]);
for($i=0; $i<$number; $i++){
$query="INSERT INTO edit (user_id,skills,level,school,major,degree,year,languages) VALUES ('".$id."','".$na."','".$na."','".$_POST["Schoolname"][$i]."','".$_POST["Major"][$i]."','".$_POST["Degree"][$i]."','".$_POST["educationDate"][$i]."','".$na."')";
mysqli_query($conn,$query);
}
// include 'profile.php';
redirect_to("profile.php");
?>
