<?php include '../includes/session.php'; ?>
<?php include '../includes/connect.php'; ?>
<?php include '../includes/functions.php'; ?>
<?php include '../includes/validation_functions.php'; ?>

<?php

if (isset($_POST["otp_submit"])) { //valid auth
    $user_otp = mysql_prep($_POST["user_otp"]);
    if (!($user_otp == $_SESSION["otp"])) { //invalid otp

        $errors["OTP"][] = "Invalid OTP, try again";
        $_SESSION["errors"] = $errors;
        redirect_to("otp_form.php");

    } else { //valid otp
        //below html will be displayed
    }
} else if($_SESSION["retry_otp_submit"]) { //user entered error details
    $_SESSION["retry_otp_submit"] = null;
    //display the form again but add the error messages
} else {
    redirect_to("login_page.php");
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

        <!-- Favicons -->
        <link href="img/favicon.png" rel="icon">
        <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

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
    </head>

    <body>
        <div class="container mb-4">
            <div class="mt-4">
                <!-- this class is to display the messages -->
                <?php
                if ($errors = errors()) {
                    ?>
                    <ul class="list-group">
                        <?php
                        foreach ($errors as $value) {
                            foreach ($value as $val) {
                                echo "<li class=\"list-group-item list-group-item-danger\">" . $val . "</li>";
                            }
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>

            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="p-5 mt-5" style="background-color:#ecebeb;">
                        <form action="user_reg_verify.php" method="post">
                            <h3 class="text-center"><b>Setup User Account</b></h3>
                            <div class="form-group">
                                <label for="exampleInputUser1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputUser1" aria-describedby="emailHelp" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPass1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPass1" aria-describedby="emailHelp" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConPass1">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="exampleInputConPass1" aria-describedby="emailHelp" placeholder="Enter Password">
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary form-control mt-2" style="background-color:#76e292;border:1px solid #76e292;">Create Account</button>
                        </form>
                    </div>
                <div class="col-md-4"></div>
            </div>
        </div>

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
        <!-- Contact Form JavaScript File -->
        <script src="contactform/contactform.js"></script>

        <!-- Template Main Javascript File -->
        <script src="js/main.js"></script>

    </body>
</html>

<?php mysqli_close($conn); ?>
