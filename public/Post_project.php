 <script language="Javascript" src="jquery.js"></script>
    <script type="text/JavaScript" src='state.js'></script>

<?php include '../includes/layouts/header.php';?>
<?php

if (isset($_SESSION["current_user"])) {
    $current_user = $_SESSION["current_user"];
}
else{
  header("Location: index.php");
  exit;
}

?>

<body style="background-color: #ecebeb">
<div class="container" style="background-color: white; width: 60%;margin-top: 10px">
  <h1 style="padding-top: 20px;font-weight: bold;">Tell us what you need</h1>
  <br>
  <form action="formconnect.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <h3><label for="title">Choose a name for your project:</label></h3>
      <input type="text" class="form-control" id="title" placeholder="Enter name of your project" name="title" required maxlength="100">
    </div>
    <br>

    <div class="form-group">
      <h3><label for="shortdesc">Enter a short description about your project:</label></h3>
      <input type="text" class="form-control" id="shortdesc" placeholder="Short description in 1-2 sentences" name="shortdesc" required maxlength="300">
    </div>
    <br>

    <div class="form-group">
      <h3><label for="desc">Tell us more about your project:</label></h3>
      <p>Great project descriptions include a little bit about yourself, details of what you are trying to achieve, and any decisions that you have already made about your project.</p>
      <textarea class="form-control" rows="5" id="desc" placeholder="Describe your project here..." name="desc" required maxlength="2500"></textarea>
    </div>
    <br>

    <div class="form-group">
      <h3><label for="photo">Upload any images that might be helpful in explaining your project brief here:</label></h3>
    <input type="file" id="photo" name="photo">
    </div>
    <br>

    <div class="form-group">
      <h3><label for="cat">What category does your project belong to?</label></h3>
      <select class="form-control" name="cat" id="cat" required>
        <option value="Education">Education</option>
        <option value="Charity">Charity</option>
        <option value="Animals">Animals</option>
        <option value="Medical">Medical</option>
        <option value="Sports">Sports</option>
        <option value="Child">Child</option>
        <option value="Food">Food</option>
        <option value="Clothes">Clothes</option>
        <option value="Sanitation">Sanitation</option>
        <option value="Art">Art</option>
        <option value="Entertainment">Entertainment</option>
      </select>
    </div>
      <br>

      <div class="form-group">
      <h3><label for="listBox">Which State does your project belong to?</label></h3>
        <select class="form-control" name="listBox" id="listBox" onchange='selct_district(this.value)' required></select><br>
        <h3><label for="secondlist">Which city does your project belong to?</label></h3>
        <select class="form-control" name="secondlist" id='secondlist' required></select>
    </div>
      <br>

      <div class="form-group">
      <h3><label for="url">Enter any website or url related to your project: </label></h3>
      <input type="text" class="form-control" id="url" placeholder="Website of your project" name="url">
    </div>
    <br>

    <div class="form-group">
      <h3><label for="days">Enter number of days to complete your project: </label></h3>
      <input type="number" class="form-control" id="days" placeholder="Deadline of your project" name="days" required>
    </div>
    <br>

  <div class="row">
    <div class="col-lg-4"><button type="button" onclick="fundinfo()" id="funds" class="btn" style="background-color: #76e292; color: white; font-size: 17px; font-weight: 600; padding: 10px 25px;">I want funds.</button></div>

    <div class="col-lg-4"><button type="button" id="workers" onclick="workerinfo()" class="btn" style="background-color: #76e292; color: white; font-size: 17px; font-weight: 600; padding: 10px 25px">I want workers.</button></div>

    <div class="col-lg-4"><button type="button" id="both" onclick="bothinfo()" class="btn" style="background-color: #76e292; color: white; font-size: 17px; font-weight: 600; padding: 10px 25px;">I want both.</button></div>
  </div>
<br>

  <div class="field-wrapper">
  </div>
<br>
    <script type="text/javascript">

    function fundinfo(){
    var wrapper = $(".field-wrapper");
    var fieldHTML1 = '<div class="form-group"><h3><label for="budget">Enter the budget of your project:</label></h3><input type="number" class="form-control" id="budget" placeholder="Budget in rupees" name="budget" required></div><br>';
    var fieldHTML2 = '<div class="form-group"><h3><label for="account_no">Enter the account number where you want your funds transfered:</label></h3><input type="number" class="form-control" id="account_no" placeholder="Account Number" name="account_no" required></div><br>';
    var fieldHTML3 = '<div class="form-group"><h3><label for="ifsc_code">Enter the IFSC code of your bank:</label></h3><input type="text" class="form-control" id="ifsc_code" placeholder="IFSC Code" name="ifsc_code" required></div><br>';
    $(wrapper).empty();
    $(wrapper).append(fieldHTML1);
    $(wrapper).append(fieldHTML2);
    $(wrapper).append(fieldHTML3);
  }

    function workerinfo(){
    var wrapper = $(".field-wrapper");
    var fieldHTML = '<div class="form-group"><h3><label for="worker">Enter the number of workers for your project:</label></h3><input type="number" class="form-control" id="worker" placeholder="No. of workers required" name="worker" required></div><br>';
    $(wrapper).empty();
    $(wrapper).append(fieldHTML);
  }

    function bothinfo(){
    var wrapper = $(".field-wrapper");
    $(wrapper).empty();
    var fieldHTML1 = '<div class="form-group"><h3><label for="budget">Enter the budget of your project:</label></h3><input type="number" class="form-control" id="budget" placeholder="Budget in rupees" name="budget" required></div><br>';
    $(wrapper).append(fieldHTML1);
    var fieldHTML3 = '<div class="form-group"><h3><label for="account_no">Enter the account number where you want your funds transfered:</label></h3><input type="number" class="form-control" id="account_no" placeholder="Account Number" name="account_no" required></div><br>';
    var fieldHTML4 = '<div class="form-group"><h3><label for="ifsc_code">Enter the IFSC code of your bank:</label></h3><input type="text" class="form-control" id="ifsc_code" placeholder="IFSC Code" name="ifsc_code" required></div><br>';
    $(wrapper).append(fieldHTML3);
    $(wrapper).append(fieldHTML4);
   var fieldHTML2 = '<div class="form-group"><h3><label for="worker">Enter the number of workers for your project:</label></h3><input type="number" class="form-control" id="worker" placeholder="No. of workers required" name="worker" required></div><br>';
    $(wrapper).append(fieldHTML2);
  }

</script>
    <button type="submit" class="btn btn-lg" style="background-color: #76e292; color: white; font-size: 17px; font-weight: 600; padding: 10px 25px; margin-bottom: 15px;"> SUBMIT PROJECT
    </button>
  </form>
</div>
</div>
<?php
exec("python ML_scripts/image_processing.py");
include '../includes/layouts/page_footer.php';?>
