<?php include '../includes/connect.php'; ?>
<?php include '../includes/functions.php'; ?>
<?php include '../includes/session.php'; ?>

<?php
if (isset($_SESSION["current_user"])) {
    $current_user = $_SESSION["current_user"];
}

// $user_id=5;
// $type=0;
$final=array();
$user_id = $current_user["user_id"];
$type = $current_user["type"];
echo $type;
if($type == 0){
	$query  = "SELECT *
                FROM transaction as t
                where user_id='{$user_id}';";
                $result1 = mysqli_query($conn,$query);
                $result = mysqli_num_rows($result1);
                //echo $result;

                confirm_query($result);
                // echo "first pass";
    if($result < 10){
    	//echo "Less than 10.";
    	$query = "SELECT *
                FROM transaction as t
                where user_id='{$user_id}'";
                $query .= ";";
                $result1 = mysqli_query($conn,$query);
                //confirm_query($result);
                while($row1=mysqli_fetch_assoc($result1)){
     					$query1 = "UPDATE transaction set flag = 1 where transaction_amount > 100000 and user_id ='{$user_id}';";
     					$result1 = mysqli_query($conn,$query1);

     					confirm_query($result1);
              // echo "sec pass";
     	}
    }
    else{
    	$query = "SELECT transaction_amount
    				FROM transaction as t
    				where user_id='{$user_id}';";
    	$result1 = mysqli_query($conn,$query);
    	confirm_query($result1);
    	while( $row = mysqli_fetch_assoc($result1)) {
    		array_push($final, $row['transaction_amount']);
    	}

    	print_r($final);
    	$q1 = Quartile_25($final);
    	$q3 = Quartile_75($final);
    	$threshold = $q3 + 1.5*($q3-$q1);

    	$query = "SELECT transaction_amount
    				FROM transaction as t
    				where user_id='{$user_id}';";
    	$result1 = mysqli_query($conn,$query);
    	confirm_query($result1);

    	while($row1=mysqli_fetch_assoc($result1)){
      					$query1 = "UPDATE transaction set flag = 1 where transaction_amount > $threshold and user_id ='{$user_id}';";
      					$result1 = mysqli_query($conn,$query1);
      					confirm_query($result1);
     	}
    }
}

else{
	$query  = "SELECT *
                FROM transaction as t
                where user_id='{$user_id}';";
                $result1 = mysqli_query($conn,$query);
                $result = mysqli_num_rows($result1);
                //echo $result;
                //confirm_query($result);
    if($result < 10){
    	//echo "Less than 10.";
    	$query = "SELECT *
                FROM transaction as t
                where user_id='{$user_id}'";
                $query .= ";";
                $result1 = mysqli_query($conn,$query);
                //confirm_query($result);
                while($row1=mysqli_fetch_assoc($result1)){
     					$query1 = "UPDATE transaction set flag = 1 where transaction_amount > 100000 and user_id ='{$user_id}';";
     					$result1 = mysqli_query($conn,$query1);
     					confirm_query($result1);
     	}
    }
    else{
    	$query = "SELECT transaction_amount
    				FROM transaction as t
    				where user_id='{$user_id}';";
    	$result1 = mysqli_query($conn,$query);
    	confirm_query($result1);
    	while( $row = mysqli_fetch_assoc($result1)) {
    		array_push($final, $row['transaction_amount']);
    	}

    	print_r($final);
    	$q1 = Quartile_25($final);
    	$q3 = Quartile_75($final);
    	$threshold = $q3 + 1.5*($q3-$q1);

    	$query = "SELECT transaction_amount
    				FROM transaction as t
    				where user_id='{$user_id}';";
    	$result1 = mysqli_query($conn,$query);
    	confirm_query($result1);

    	while($row1=mysqli_fetch_assoc($result1)){
      					$query1 = "UPDATE transaction set flag = 1 where transaction_amount > $threshold and user_id ='{$user_id}';";
      					$result1 = mysqli_query($conn,$query1);
      					confirm_query($result1);
     	}
    }
}


function Quartile_25($Array) {
  return Quartile($Array, 0.25);
}

function Quartile_75($Array) {
  return Quartile($Array, 0.75);
}

function Quartile($Array, $Quartile) {

  $pos = (count($Array) - 1) * $Quartile;
  $base = floor($pos);
  $rest = $pos - $base;

  if( isset($Array[$base+1]) ) {
    return $Array[$base] + $rest * ($Array[$base+1] - $Array[$base]);
  } else {
    return $Array[$base];
  }
}
header("Location: project_details.php?project={$project_id}");

?>
