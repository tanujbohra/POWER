<?php include '../includes/functions.php'; ?>
<?php include '../includes/layouts/header.php';?>

<?php

if (isset($_SESSION["current_user"])) {
    $current_user = $_SESSION["current_user"];
}

if (isset($_POST["filter"]) || isset($_GET["category"])) { //filter was applied
    if (isset($_POST["category"])) {
        $category = $_POST["category"];
    } else {
        $category = null;
    }
    if (isset($_POST["pref"])) {
        $pref = $_POST["pref"];
    } else {
        $pref = null;
    }
    //$pref = $_POST["pref"];
    $location_status = (int)isset($_POST["location"]);

    if ($location_status == 1) {
        //TODO: get user location
        $location = find_user_location($current_user["user_id"],
            $current_user["type"]);
    } else {
        $location = null;
    }

    if (isset($_GET["category"])) {
        $category = mysql_prep($_GET["category"]);
        $pref = null;
        $location = null;
    }

    $category_list = find_all_projects($category,$pref,$location);
    $category_count = mysqli_num_rows($category_list);

    $featured_project_row = find_featured_project($category,$pref,$location);
    $trending_project_list = find_all_trending_projects($category,$pref,$location);


} else { //user clicked on explore
    $category_list = find_all_projects();
    $category_count = mysqli_num_rows($category_list);

    $featured_project_row = find_featured_project();
    $trending_project_list = find_all_trending_projects();
}

?>


<body>

<main id="main" style="margin-bottom:10px;">
    <!-- Filter -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Filter</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <b>filter</b>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <form action="category_page.php" method="post" class="form-inline mt-2 mr-2 my-lg-0">
                <select name="category" class="form-control mt-2 mr-lg-4" id="exampleFormControlSelect0">
                    <option value="" selected disabled>Categories</option>
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
                <select name="pref" class="form-control mt-2  mr-lg-4" id="exampleFormControlSelect1">
                    <option value="" selected disabled>Preference</option>
                    <option value="job">Search job</option>
                    <option value="fund">Fund project</option>
                    <option value="all">All</option>
                </select>
                <div class="form-check form-check-inline">
                    <input name="location" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1">
                    <label class="form-check-label" for="inlineCheckbox1">Near me</label>
                </div>

                <input class="btn btn-outline-success ml-lg-5 my-2 my-sm-0" type="submit" name="filter" value="apply filter">
            </form>
        </div>
    </nav>
    <!--End of filter-->

    <!-- Main page content -->
    <div class="container">
        <div class="mt-5 text-truncate">
<!--            <h1 class="title text-truncate"><b>Category name</b></h1>-->
            <h1 class="title text-truncate"><b>
                    <?php if (isset($category)) { //filter was applied
                        echo ucfirst(htmlentities($category));
                    } else {
                        echo "Explore all projects";
                    }
                    ?>
                </b></h1>
<!--            <p class="text-truncate">Category description...Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
        </div>

        <hr>

        <!-- Featured project -->
        <div class="row">
            <div class="col-lg-6">
                <!-- card for featured project -->
                <div class="container mb-5">
                    <p>Featured</p>
                    <div class="" style="width:100%;height:300px;">
                        <!-- TODO : featured project image-->
                        <a href="project_details.php?project=<?php echo $featured_project_row["project_id"]; ?>"><img src="<?php echo 'UploadsImages/' . $featured_project_row['project_image']; ?>" alt="" style="width:100%;height:300px"></a>
                    </div>
<!--                    <h5 class="mt-2 text-weight-bold text-truncate text-uppercase">Featured Project Name</h5>-->
                        <h5 class="mt-2 text-weight-bold text-truncate text-uppercase"><?php echo htmlentities($featured_project_row["project_title"]);?></h5>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="container">
                    Trending
                    <hr>
                    <!-- Box for Trending -->
                    <div style="width:100%;height:350px;overflow-y: auto; overflow-x: hidden;">
                        <?php
                        if (mysqli_num_rows($trending_project_list) > 0) {
                            while ($trending_row = mysqli_fetch_assoc($trending_project_list)) {
                                $progress = find_project_progress($trending_row);
                                ?>
                                <!-- Individual trending page -->
                                <div class="row ml-2" style="width:100%;height:70px;">
                                    <h5 class="text-left mb-1 text-truncate"
                                        style="color:black;height:20px;width:100%;">
                                        <a href="project_details.php?project=<?php echo $trending_row["project_id"]; ?>"><?php echo htmlentities($trending_row["project_title"]); ?></a>
                                    </h5>
                                    <p class="text-left mt-1 text-truncate small mb-0"
                                       style="width:100%;"><?php echo htmlentities($trending_row["project_short_description"]); ?></p>
                                    <p class="text-left small mt-1" style="width:100%;"><?php echo (int)$progress[0];?>% Complete</p>
                                </div>
                                <hr class="mt-0">
                                <!--End of individual trending page-->
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- End of featured -->
        <hr>

        <!-- Display all project(OR flitered, filtered incase filter is used) -->
        <div class="container">
<!--            <h3>Explore 23,456 projects</h3>-->
            <h3>Explore <?php echo htmlentities($category_count);?></h3>
            <?php
            if (isset($category)) { //if filter was applied
                $small_display = "|";
                if (isset($category)) {
                    $small_display .= " " . htmlentities(ucfirst($category)) . " |";
                }
                if (isset($location)) {
                    $small_display .= " " . htmlentities(ucfirst($location)) . " |";
                }
                if (isset($pref)) {
                    $small_display .= " " . htmlentities(ucfirst($pref)) . " |";
                }
                echo "<p>" . $small_display . "</p>";
            }
            ?>

            <div class="row" style="max-height:900px;overflow:auto;">

                <!-- Individual card-->
                <?php
                if (mysqli_num_rows($category_list) > 0) {
                    while ($category_row = mysqli_fetch_assoc($category_list)) {
                        $image_path = "UploadsImages/" . $category_row["project_image"];
                        $progress = find_project_progress($category_row);
                        ?>

                        <!-- individual card -->
                        <a href="project_details.php?project=<?php echo $category_row["project_id"]; ?>">
                        <div class="col-md-4" style="height:450px;">
                        <div class="about-col border rounded">
                            <div class="img"> <!-- image div -->
                                <img src="<?php echo $image_path; ?>" alt="" style="height:200px;width:100%;" class="img-fluid">
                            </div>
                            <div class="pl-3 pr-3 mb-1 text-right" style="height:210px;">
                                <!-- Title -->
                                <h5 class="mt-3 text-left mb-2 text-truncate" style="color:black;"><?php echo htmlentities($category_row["project_title"]);?></h5>
                                <!-- Description -->
                                <div class="" style="height:95px;overflow:hidden;color: black;">
                                    <p class="text-justify font-weight-light"><?php echo htmlentities($category_row["project_short_description"]);?></p>
                                </div>
                                <!-- Progress bar -->
                                <div class="progress mt-3 text-left" style="height:3px;">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo (int)$progress[0] . "%"; ?>;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-2 text-left small"><?php echo (int)$progress[0]; ?>% Complete</div>
                                <hr class="mt-1 mb-2">
                                <a class="text-right small" href="project_details.php?project=<?php echo $category_row["project_id"]; ?>">View project details ></a>
                            </div>
                        </div>
                    </div>
                </a>
                        <!-- End of individual card -->

                <?php
                    }
                }
                ?>



            </div>
            <!-- end of row with all cards -->
        </div>
        <div class="text-right">
            <?php
            if ($category_count > 6) {
                echo "scroll for more";
            }
            ?>

        </div>
        <hr>

        
        <!-- TODO: Apply suggestions here-->
        <!--Suggested start-->
        

        <div class="container-fluid" style="overflow-y:scroll;">
            <h3>Recommended for you</h3>
            <div class="row flex-row flex-nowrap">
                 <?php
            $recommended=find_recommended_projects($current_user['user_id']);
          
            for($i=0;$i<sizeof($recommended);$i++) {
                $image_path = "UploadsImages/" . $recommended[$i]["project_image"];
                $progress = find_project_progress($recommended[$i]);
            ?>
                <!-- individual card -->
                        <a href="project_details.php?project=<?php echo $recommended[$i]['project_id']; ?>">
                        <div class="col-md-4" style="height:450px;">
                        <div class="about-col border rounded">
                            <div class="img"> <!-- image div -->
                                <img src="<?php echo $image_path; ?>" alt="" style="height:200px;width:100%;" class="img-fluid">
                            </div>
                            <div class="pl-3 pr-3 mb-1 text-right" style="height:210px;">
                                <!-- Title -->
                                <h5 class="mt-3 text-left mb-2 text-truncate" style="color:black;"><?php echo htmlentities($recommended[$i]["project_title"]);?></h5>
                                <!-- Description -->
                                <div class="" style="height:95px;overflow:hidden;color: black;">
                                    <p class="text-justify font-weight-light"><?php echo htmlentities($recommended[$i]["project_short_description"]);?></p>
                                </div>
                                <!-- Progress bar -->
                                <div class="progress mt-3 text-left" style="height:3px;">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo (int)$progress[0] . "%"; ?>;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-2 text-left small"><?php echo (int)$progress[0]; ?>% Complete</div>
                                <hr class="mt-1 mb-2">
                                <a class="text-right small" href="project_details.php?project=<?php echo $category_row["project_id"]; ?>">View project details ></a>
                            </div>
                        </div>
                    </div>
                </a>
                <?php 
            }
            ?>
                <!-- End of individual card -->
            </div>
            <div class="text-right"></div>
            <hr>
        </div>
        <!--End of suggested-->

    </div>
    <!-- End of page main content(class type container) -->

</main>
<?php include '../includes/layouts/page_footer.php';?>