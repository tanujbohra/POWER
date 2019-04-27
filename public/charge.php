<?php include '../includes/session.php';?>
<?php include '../includes/connect.php'; ?>

<?php
$current_user = $_SESSION["current_user"];
$user_id = $current_user["user_id"];
$user_type = $current_user["type"];
// $user_id = 5;
$project_id = $_POST["project_id"];
$amount=$_POST["amount"];
$donation_type=$_POST["d_type"];

$transid=$_POST['razorpay_payment_id'];

$transaction_status = null;
if ($user_type==0&&$amount >= 100000) {
	$transaction_status = 0;
	$_SESSION['flag_excess_amt']=1;

} else if($user_type== 1 && amount>=1000000){
	$transaction_status = 0;
	$_SESSION['flag_excess_amt']=1;
}
else{
	$transaction_status = 1;
	$_SESSION['flag_excess_amt']=0;
}

$_SESSION['this_transaction']=$transid;
$_SESSION['amount']=$amount;

//update project fund
$query="SELECT * FROM project WHERE project_id='".$project_id."'";
$result=mysqli_query($conn,$query);
//echo mysql_num_rows($result);
while($row=mysqli_fetch_assoc($result)){
$sum_funds=$row['project_funds_received'];}
$sum_funds_new=$sum_funds+$amount;
$query="UPDATE project SET project_funds_received=$sum_funds_new WHERE project_id=$project_id";
mysqli_query($conn,$query);

//populate transaction table
$query="INSERT INTO transaction (user_id,project_id,razorpay,transaction_amount,transaction_status) VALUES ('".$user_id."','".$project_id."','".$transid."','".$amount."','".$transaction_status."')";
mysqli_query($conn,$query);

//populate donor table
$query="SELECT project_category FROM project WHERE project_id='".$project_id."'";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
$project_category=$row['project_category'];}
$query="INSERT INTO donor (user_id,project_id,user_type,project_category,donation_amount,donation_type) VALUES ('".$user_id."','".$project_id."','".$user_type."','".$project_category."','".$amount."','".$donation_type."')";
mysqli_query($conn,$query);

//populate notification table
if($transaction_status==0){
	$notif="Amount excessive, alert sent to admin, transaction done";
	$query="INSERT into notification (user_id,notification_message,notification_status) VALUES ('".$user_id."','".$notif."','0')";
	mysqli_query($conn,$query);
}

?>

<!-- <script type="text/javascript" language="Javascript">window.open('fpdf/receipt.php');</script> -->

<?php

header("Location: outlier.php");



//include '/fpdf/receipt.php';
?>
