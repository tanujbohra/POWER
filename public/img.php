<?php

  $userid=1;
  //$userid = $_SESSION['user_id'];
  //making connection
  $user= '';
  $pass= '';
  $db= '';

  $conn= new mysqli('localhost',$user,$pass,$db) or die("Unable to Connect");
  //checking connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{
    echo "Connected successfully";
  }

  $sql = "select * from project where (project_id='8')";
  echo $sql;
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $imagedata = $row["project_photo"];
      $imgsrc = 'UploadsImages/1-Okay-';
      //$imagetype = $_FILES["photo"]["type"];
  }
}
echo "<img src=" . $imgsrc . $imagedata . ">";
  //header("content-type: image/jpeg");
  echo $imagedata;
  $conn->close();
?>
