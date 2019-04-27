<?php
if(isset($_POST["view"]))
{
 include("connect.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE notification SET notification_status=1 WHERE notification_status=0";
  mysqli_query($conn, $update_query);
 }
 $query = "SELECT * FROM notification Where user_id = 5 DESC LIMIT 5";
 $result = mysqli_query($conn, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<li><em>'.$row["notification_message"].'</em></li><li class="divider"></li>';
  }
 }
 else
 {
  $output .= '<li class="text-bold text-italic">No Notification Found</li>';
 }
 
 $query_1 = "SELECT * FROM notification WHERE notification_status=0 and user_id=5";
 $result_1 = mysqli_query($conn, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>