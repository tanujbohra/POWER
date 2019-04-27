<?php include '../includes/session.php';?>
<?php include '../includes/connect.php';?>
<?php include '../includes/functions.php';?>

<?php
session_unset(); 
session_destroy(); 
redirect_to("index.php");
?>