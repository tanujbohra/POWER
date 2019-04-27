<?php include '../includes/session.php';?>
<?php include '../includes/connect.php'; ?>
<?php
  ini_set('file_uploads', '1');
if (isset($_POST['budget'])) {
    $budget = $_POST['budget'];
} else {
    $budget = ' ';
}
if (isset($_POST['worker'])) {
    $worker = $_POST['worker'];
} else {
    $worker = ' ';
}
if (isset($_POST['account_no'])) {
    $account_no = $_POST['account_no'];
} else {
    $account_no = ' ';
}
if (isset($_POST['ifsc_code'])) {
    $ifsc_code = $_POST['ifsc_code'];
} else {
    $ifsc_code = ' ';
}

$userid = $_SESSION["current_user"]["user_id"];
$title=$_POST['title'];
$shortdesc=$_POST['shortdesc'];
$desc=$_POST['desc'];
$cat=$_POST['cat'];
$url=$_POST['url'];
$days=$_POST['days'];
//$location=$_POST['location'];
//$photo=$_POST['photo'];

$id = $userid . '-';
$target_dir1 = "UploadsImages/" . $id;
$target_file1 = $target_dir1 . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
//$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name'])); //SQL Injection defence!
$photo_name = addslashes($_FILES['photo']['name']);
$photo_name1 = $id . $photo_name;
// Check file size
if ($_FILES["photo"]["size"] > 5000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
&& $imageFileType1 != "gif" && $imageFileType1 != "PNG" && $imageFileType1 != "JPEG") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file1)) {
        echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



  $query1="INSERT into project (user_id,project_title,project_short_description,project_description,project_image,project_category,project_website,project_funds,project_people,project_deadline,project_timestamp,project_photo,project_state_location,project_location,bank_account_number,ifsc_code) VALUES ('$userid','$_POST[title]','$_POST[shortdesc]','$_POST[desc]','$photo_name1','$cat','$url','$budget','$worker','$days',(now()),'{$photo_name}','$_POST[listBox]','$_POST[secondlist]','$account_no','$ifsc_code');";
  if ($conn->query($query1) === TRUE) {
     echo "New record created successfully";
     echo "Entry made";
  } else {
     echo "Error: " . $query1 . "<br>" . $conn->error;
  }
  
  $conn->close();
  header("Location: index.php");
 // echo "<script>window.location.href='index.html'</script>";
?>
