<?php include '../includes/functions.php'; ?>
<?php include '../includes/layouts/header.php';?>

<?php
  if (isset($_POST['category'])) {
    $category = $_POST['category'];
    $category_list = find_all_projects($category);
    $category_count = mysqli_num_rows($category_list);
} 
  else {
    $category = 'All Investors';
    $category_list = find_all_projects($category);
    $category_count = mysqli_num_rows($category_list);
}
?>
  <main id="main" style="margin-top:0px;margin-bottom:10px;">
      
      <!-- Filter -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a class="navbar-brand" href="#">Filter</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <!-- <span class="navbar-toggler-icon"></span> -->
      <b>filter</b>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto"></ul>
      <form class="form-inline mt-2 mr-2 my-lg-0" method="post" action="investor.php">
        <select class="form-control mt-2 mr-lg-4" id="category" name="category">
          <option value="All Investors" selected>Show All</option>
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
        
        <input class="btn btn-outline-success ml-lg-5 my-2 my-sm-0" type="submit" value="Apply Filter">
      </form>
    </div>
  </nav>

  <!-- Main page content -->
  <div class="container">
    <div class="mt-5 text-truncate">
      <h1 class="title text-truncate"><b> <?php echo $category; ?> </b></h1>
      </div>

<?php

?>

    <hr>
    <div class="row" style="max-height:900px;overflow:auto;">
                <!-- Individual card-->
                <?php
                
                $query  = "SELECT *
                FROM donor as d 
                Join individual as i
                on d.user_id = i.user_id
                join user as u
                on d.user_id = u.user_id";
                    if ($category!='All Investors') {
                        $query .= " WHERE d.project_category like '{$category}'";
                    }
                $query .= ";";
                $result = mysqli_query($conn,$query);
                confirm_query($result);

                while($row1=mysqli_fetch_assoc($result)){
                  $imgsrc = "UploadsImages/Individuals/" . $row1["image"];
                        ?>
                    <!-- individual card -->
                        <div class="col-md-4" style="height:450px;">
                            <div class="about-col border rounded">
                                <div class="img"> <!--Investor image div -->
                                    <img src="<?php echo $imgsrc; ?>" alt="" style="height:300px;width:100%;" class="img-fluid">
                                    <!-- <div class="icon"><i class="ion-ios-eye-outline"></i></div> -->
                                </div>
                                <div class="pl-3 pr-3 mb-1 text-right" style="height:110px;">
                                    <!-- Title -->
                                    <center><h5 class="mt-3 text-left mb-2 text-truncate" style="color:black;"><?php echo htmlentities($row1["individual_name"]);?> </h5></center>
                                    <!-- Donation Amount-->
                                    <div class="mt-2 text-left">&#x20B9; <?php echo htmlentities($row1["donation_amount"]);?>
                                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;   
                                      <?php echo htmlentities($row1["project_category"]);?>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <a class="text-right small" href="profile_page/profile.php?id=<?php echo $row1["user_id"]; ?>">View investor details ></a>
                                </div>
                            </div>
                        </div>
<?php
}
?>

<?php
                
                $query  = "SELECT *
                FROM donor as d 
                Join organization as o
                on d.user_id = o.user_id
                join user as u
                on d.user_id = u.user_id";
                    if ($category!='All Investors') {
                        $query .= " WHERE d.project_category like '{$category}'";
                    }
                $query .= ";";
                $result = mysqli_query($conn,$query);
                confirm_query($result);
                while($row1=mysqli_fetch_assoc($result)){
                  $imgsrc = "UploadsImages/Organizations/" . $row1["image"];
                        
?>
                    <!-- individual card -->
                        <div class="col-md-4" style="height:450px;">
                            <div class="about-col border rounded">
                                <div class="img"> <!--Investor image div -->
                                    <img src="<?php echo $imgsrc; ?>" alt="" style="height:300px;width:100%;" class="img-fluid">
                                    <!-- <div class="icon"><i class="ion-ios-eye-outline"></i></div> -->
                                </div>
                                <div class="pl-3 pr-3 mb-1 text-right" style="height:110px;">
                                    <!-- Title -->
                                    <center><h5 class="mt-3 text-left mb-2 text-truncate" style="color:black;"><?php echo htmlentities($row1["org_name"]);?> </h5></center>
                                    <!-- Donation Amount-->
                                    <div class="mt-2 text-left">&#x20B9; <?php echo htmlentities($row1["donation_amount"]);?>
                                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                      <?php echo htmlentities($row1["project_category"]);?>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <a class="text-right small" href="profile_page/profile.php?id=<?php echo $row1["user_id"]; ?>">View investor details ></a>
                                </div>
                            </div>
                        </div>
                        <!-- End of individual card -->
<?php
}      
?>

</div>
</div>  
</main>

<?php include '../includes/layouts/page_footer.php';?>