<?php include '../includes/connect.php'; ?>
<?php include '../includes/session.php'; ?>


<?php
if (isset($_SESSION["current_user"])) {
  $current_user = $_SESSION["current_user"];
}

error_reporting(0);

if ($_POST['favourite']=="selected") {
$sql = "INSERT INTO favourite (user_id, project_id) VALUES ({$current_user['user_id']},{$_POST['project_id']})";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


if($_POST['favourite']=="notselected"){
$sql = "delete from favourite where user_id={$current_user['user_id']} and project_id={$_POST['project_id']}";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


if ($_POST["like_check"]=="selected") {
	//echo $_POST['cnt'];
$sql = "update project set project_likes=".($_POST['cnt']+1)." where project_id={$_POST['project_id']}";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


if($_POST['like_check']=="notselected"){
$sql = "update project set project_likes=".$_POST['cnt']." where project_id={$_POST['project_id']}";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


if ($_POST["report_check"]=="selected") {
	//echo $_POST['rcnt'];
$sql = "update project set project_reports=".($_POST['rcnt']+1)." where project_id={$_POST['project_id']}";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


if($_POST['report_check']=="notselected"){
$sql = "update project set project_reports=".$_POST['rcnt']." where project_id=1";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


if($_POST['comment_check']=="selected"){
$sql = "insert into comment (project_id,comment,rating) values ({$_POST['project_id']},'".$_POST['text']."','".$_POST['rate']."')";
if ($conn->query($sql) === TRUE) {
    echo '<div class="section-block"><input class="signup-input" type="text" style="color:black" value="'.$_POST['text'].'" disabled><br><span class="star-rating_given" style="font-size:1.75em">';
    for ($i =1; $i <= $_POST['rate']; $i++) {
		echo ''.'<span class="fa fa-star"></span>';
    }
    for ($i =5-$_POST['rate']; $i >=1; $i--) {
		echo ''.'<span class="fa fa-star-o"></span>';
	}
	echo ''.'</span></div>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>