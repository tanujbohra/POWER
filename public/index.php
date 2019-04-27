<?php include '../includes/session.php';
include '../includes/connect.php';
include '../includes/functions.php'; ?>

<?php //cheeck if user logged in
if (isset($_SESSION["current_user"])) {
  $current_user = $_SESSION["current_user"];
  //$user_details = $_SESSION["result_list_array"];
} else {
  $current_user = null;
  $user_details = null;
}

$user_login = false; //login status boolean
if (isset($current_user)) {
  $user_login = true;
}

?>

<?php
    $trending_home_project_list = find_home_trending_projects();
    if ($user_login) {
      $location = find_user_location($current_user["user_id"],
            $current_user["type"]);
      $nearby_projects = find_nearby_projects($location);
    } else {
      $nearby_projects = null;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>P.O.W.E.R</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/home_style.css" rel="stylesheet">
  <style>
  #element{
    overflow-x: hidden;
  }
  </style>
</head>

<body>
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="index.php" class="scrollto">P.O.W.E.R</a></h1>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><!--Google translate-->
    <div id="google_translate_element" style="margin-top: 0px; margin-left: 30px">
    </div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!--End of google translate-->
  </li>
          <li class="menu-active"><a href="index.php">Home</a></li>
          <li class="menu-has-children"><a href="category_page.php">Explore</a>
            <ul>
              <li><a href="category_page.php?category=Education">Education</a></li>
              <li><a href="category_page.php?category=Charity">Charity</a></li>
              <li><a href="category_page.php?category=Animals">Animals</a></li>
              <li><a href="category_page.php?category=Medical">Medical</a></li>
              <li><a href="category_page.php?category=Sports">Sports</a></li>
              <li><a href="category_page.php?category=Child">Child</a></li>
              <li><a href="category_page.php?category=Food">Food</a></li>
              <li><a href="category_page.php?category=Clothes">Clothes</a></li>
              <li><a href="category_page.php?category=Sanitation">Sanitation</a></li>
              <li><a href="category_page.php?category=Art">Art</a></li>
              <li><a href="category_page.php?category=Entertainment">Entertainment</a></li>
            </ul>
          </li>
          <!-- <li><a href="category_page.php">Explore</a></li> -->
          <?php

          if ($user_login == true) {
            echo "<li><a href=\"investor.php\">Investors</a></li>";
            echo "<li><a href=\"Post_project.php\">Post A Project</a></li>";
            echo "<li><a href=\"profile_page/profile.php\">Profile</a></li>";
            echo "<li><a href=\"logout.php\">Logout</a></li>";
          } else {
            echo "<li><a href=\"login_page.php\">Login</a></li>";
          }

          ?>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active">
            <div class="carousel-background"><img src="images/1.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Empowering Women</h2>
                <p>“A woman is the full circle. Within her is the power to create, nurture and transform.”</p>
                <?php if ($user_login){?>
                <a href="Post_project.php" class="btn-get-started scrollto">Post a Project</a>
                <?php } ?>
                <a href="category_page.php" class="btn-get-started scrollto">I want to work</a>

                <!-- <a href="#featured-services" class="btn-get-started scrollto">I want to Hire</a>
                <a href="#featured-services" class="btn-get-started scrollto">I want to work</a> -->
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="images/2.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Human Resource</h2>
                <p>“You cannot predict the outcome of human development. All you can do is like a farmer create the conditions under which it will begin to flourish.” </p>
                <?php if ($user_login){?>
                <a href="Post_project.php" class="btn-get-started scrollto">Post a Project</a>
                <?php } ?>
                <a href="category_page.php" class="btn-get-started scrollto">I want to work</a>
                </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="images/3.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Education</h2>
                <p>“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>
               <?php if ($user_login){?>
                <a href="Post_project.php" class="btn-get-started scrollto">Post a Project</a>
                <?php } ?>
                <a href="category_page.php" class="btn-get-started scrollto">I want to work</a>
                </div>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->
  <section id="about">
        <div class="container">
          <header class="section-header">
            <h3>CROWDFUNDING / COACHING / CONNECTIONS &nbsp;&nbsp;&nbsp;<b>022-33721596</b></h3>
          </header>
         <div class="row about-cols"></div>
         <p>Crowdfunding is an efficient and low risk way to raise cash for your startup or small business. Our coaching staff will help get your campaign up and running. The connections you will make through our private Slack network of entrepreneurs will propel your business forward.</p>
       </div>
     </section>
  <!-- <main id="main">
    <div class="row">
      <div class="container">
        <h3 class="section-header">CROWDFUNDING / COACHING / CONNECTIONS &nbsp;&nbsp;&nbsp;<b>022-33721596</b></h3>
        <p>Crowdfunding is an efficient and low risk way to raise cash for your startup or small business. Our coaching staff will help get your campaign up and running. The connections you will make through our private Slack network of entrepreneurs will propel your business forward.</p>
      </div>
    </div> -->
    <!--==========================
      Stats Section
    ============================-->

    <?php
    $total_backers = find_total_backers();
    $funded_project = find_funded_project();

    $project_result = find_all_projects();
    $live_project =  mysqli_num_rows($project_result);
    ?>

    <section id="featured-services">
      <div class="row counters">
      <div class="container">
         <div class="row">

          <div class="col-lg-4 box">
            <center>
            <i class="icon ion-briefcase"></i>
            <h4 class="title"><a href="">Total Backers</a></h4>
            <!-- <p data-toggle="counter-up" style="font-size: 50px;">11,10,552</p> -->
            <p data-toggle="counter-up" style="font-size: 50px;">
              <?php echo htmlentities($total_backers)?></p>
          </center>
          </div>

          <div class="col-lg-4 box">
            <center>
            <i class="icon ion-cash"></i>
            <h4 class="title"><a href="">Funded Projects</a></h4>
            <!-- <p data-toggle="counter-up" style="font-size: 50px;">274</p> -->
            <p data-toggle="counter-up" style="font-size: 50px;">
              <?php echo htmlentities($funded_project)?></p>
          </center>
          </div>

          <div class="col-lg-4 box">
            <center>
            <i class="icon ion-earth"></i>
            <h4 class="title"><a href="">Live Projects</a></h4>
            <!-- <p data-toggle="counter-up" style="font-size: 50px;">274</p> -->
            <p data-toggle="counter-up" style="font-size: 50px;">
              <?php echo htmlentities($live_project)?></p>
            </center>
          </div>
          </div>
        </div>
      </div>
    </section><!-- #featured-services -->

    <!--==========================
      Trending Section
    ============================-->

    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Trending Projects</h3>
        </header>

        <div class="row about-cols">

           <?php
                if (mysqli_num_rows($trending_home_project_list) > 0) {
                    while ($trending_row = mysqli_fetch_assoc($trending_home_project_list)) {
                        $image_path = "UploadsImages/" . $trending_row["project_image"];
                        $progress = find_project_progress($trending_row);
                        ?>

                        <!-- individual card -->
                        <a href="project_details.php?project=<?php echo $trending_row["project_id"]; ?>">
                        <div class="col-md-4" style="height:450px;">
                            <div class="about-col border rounded">
                                <div class="img"> <!-- image div -->
                                    <img src="<?php echo $image_path; ?>" alt="" style="height:200px;width:100%;" class="img-fluid">
                                    <!-- <div class="icon"><i class="ion-ios-eye-outline"></i></div> -->
                                </div>
                                <div class="pl-3 pr-3 mb-1 text-right" style="height:210px;">
                                    <!-- Title -->
                                    <h5 class="mt-3 text-left mb-2 text-truncate" style="color:black;"><?php echo htmlentities($trending_row["project_title"]);?></h5>
                                    <!-- Description -->
                                    <div class="" style="height:95px;overflow:hidden;">
                                        <p class="text-justify font-weight-light"><?php echo htmlentities($trending_row["project_short_description"]);?></p>
                                    </div>
                                    <!-- Progress bar -->
                                    <div class="progress mt-3 text-left" style="height:3px;">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo (int)$progress[0] . "%"; ?>;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-2 text-left small"><?php echo (int)$progress[0]; ?>% Complete</div>
                                    <hr class="mt-1 mb-2">
                                    <a class="text-right small" oject_details.php?project=<?php echo $trending_row["project_id"]; ?>>View project details ></a>
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

      </div>

      <hr>

  <?php
  if ($user_login) { //user is logged in
  ?>

  <!-- Nearby you -->
  <div class="container">

    <header class="section-header">
      <h3>Projects Near You</h3>
    </header>

    <div class="row about-cols">

       <?php
            if (mysqli_num_rows($nearby_projects) > 0) {
                while ($nearby_row = mysqli_fetch_assoc($nearby_projects)) {
                  $image_path = "UploadsImages/" . $nearby_row["project_image"];
                  $progress = find_project_progress($nearby_row);
                    ?>

                    <!-- individual card -->
                    <a href="project_details.php?project=<?php echo $nearby_row["project_id"]; ?>">
                    <div class="col-md-4" style="height:450px;">
                        <div class="about-col border rounded">
                            <div class="img"> <!-- image div -->
                                <img src="<?php echo $image_path; ?>" alt="" style="height:200px;width:100%;" class="img-fluid">
                            </div>
                            <div class="pl-3 pr-3 mb-1 text-right" style="height:210px;">
                                <!-- Title -->
                                <h5 class="mt-3 text-left mb-2 text-truncate" style="color:black;"><?php echo htmlentities($nearby_row["project_title"]);?></h5>
                                <!-- Description -->
                                <div class="" style="height:95px;overflow:hidden;">
                                    <p class="text-justify font-weight-light"><?php echo htmlentities($nearby_row["project_short_description"]);?></p>
                                </div>
                                <!-- Progress bar -->
                                <div class="progress mt-3 text-left" style="height:3px;">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo (int)$progress[0] . "%"; ?>;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-2 text-left small"><?php echo (int)$progress[0]; ?>% Complete</div>
                                <hr class="mt-1 mb-2">
                                <a class="text-right small" href="project_details.php?project=<?php echo $nearby_row["project_id"]; ?>">View project details ></a>
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
  </div>

  <?php
  }
  ?>

    </section>
    <section id="clients" class="wow fadeInUp">
      <div class="container">

        <header class="section-header">
          <h3>Categories</h3>
        </header>

        <div class="owl-carousel clients-carousel">
          <!-- <img src="img/clients/client-1.png" alt=""> -->

        <div>
          <center>
            <a href="category_page.php?category=Education"><img src="icons/edu.png" alt="" style="width:65px;height:80px"></a>
            <h6 class="title">Education</h6>
          </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Charity"><img src="icons/charity.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Charity</h6>
        </center>
      </div>
      <div>
            <center>
              <a href="category_page.php?category=Medical"><img src="icons/heartbeat.png" alt="" style="width:65px;height:80px"></a>
              <h6 class="title">Medical</h6>
            </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Animals"><img src="icons/paw.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Animals</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Sports"><img src="icons/sports.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Sports</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Child"><img src="icons/child.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Child</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Food"><img src="icons/food.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Food</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Clothes"><img src="icons/cloth.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Clothes</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Sanitation"><img src="icons/sanitation.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Sanitation</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Art"><img src="icons/art.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Art</h6>
        </center>
      </div>
      <div>
        <center>
          <a href="category_page.php?category=Entertainment"><img src="icons/entertainment.png" alt="" style="width:65px;height:80px"></a>
          <h6 class="title">Entertainment</h6>
        </center>
      </div>
        </div>

      </div>
    </section><!-- #clients -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>P.O.W.E.R</h3>
            <p>Description about Power Portal</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <!-- <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
            </ul> -->
          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <!-- <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form> -->
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Plot No. U-15, <br>
              J.V.P.D. Scheme,<br>
              Bhaktivedanta Swami Marg,<br>
              Vile Parle(West),Mumbai - 400056<br>
              <strong>Phone:</strong> +91-9999988888<br>
              <strong>Email:</strong> power@gmail.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>



        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>P.O.W.E.R</strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
<?php mysqli_close($conn); ?>
