<?php include '../includes/session.php'; ?>
<?php include '../includes/connect.php'; ?>
<?php include '../includes/functions.php'; ?>
<?php include '../includes/validation_functions.php'; ?>
<?php include 'sendsms.php'; ?>

<?php //when the form is submitted

if (isset($_POST["OTP"])) {

    $unique_id = mysql_prep($_POST["UIN"]);
    $mobile_number = mysql_prep($_POST["mobile_number"]);
    $organization_status = (int)$_POST["is_organization"];

    $required_fields = array("UIN","mobile_number");

    has_given_length($_POST["mobile_number"],10,"mobile_number");

    if ($organization_status == 1) { //check pan_sandbox
        //redirect_to("index.html");

        //validations
        is_valid_pan($_POST["UIN"],$required_fields);

        if (!empty($errors)) { //errors exist
            $_SESSION["errors"] = $errors;
            redirect_to("register.php");
        }

        //check gov db to check if the user is valid
        $query  = "SELECT * ";
        $query .= "FROM pan_sandbox ";
        $query .= "WHERE pan_number like '{$unique_id}' ";
        $query .= "AND mobile_number like '{$mobile_number}';";

        $result = mysqli_query($conn,$query);

        if (mysqli_num_rows($result) == 1) { //valid user
            $organization_list = mysqli_fetch_assoc($result);

            // $otp = generate_OTP($mobile_number);
            $otp = "123456";

            if (!isset($otp)) { //OTP generation error
                $errors["OTP"][] = "OTP generation error, please try again";
                $_SESSION["errors"] = $errors;
                redirect_to("register.php");
            }

            $_SESSION["result_list_array"] = $organization_list;
            $_SESSION["type"] = "1";
            $_SESSION["otp"] = $otp;

        } else { //not valid user
            $errors["pan"][] = "PAN details not valid";
            $_SESSION["errors"] = $errors;
            redirect_to("register.php");
        }

    } else { //aadhaar_sandbox

        //validations
        is_valid_aadhaar($_POST["UIN"],$required_fields);

        if (!empty($errors)) { //errors exist
            $_SESSION["errors"] = $errors;
            redirect_to("register.php");
        }

        //check gov db to check if the user is valid
        $query  = "SELECT * ";
        $query .= "FROM aadhaar_sandbox ";
        $query .= "WHERE aadhaar_number like '{$unique_id}' ";
        $query .= "AND mobile_number like '{$mobile_number}';";

        $result = mysqli_query($conn,$query);

        if (mysqli_num_rows($result) == 1) { //valid user
            $organization_list = mysqli_fetch_assoc($result);

            // $otp = generate_OTP($mobile_number);
              $otp = "123456";

            if (!isset($otp)) { //OTP generation error
                $errors["OTP"][] = "OTP generation error, please try again";
                $_SESSION["errors"] = $errors;
                redirect_to("register.php");
            }

            $_SESSION["result_list_array"] = $organization_list;
            $_SESSION["type"] = "0";
            $_SESSION["otp"] = $otp;

        } else { //not valid user
            $errors["aadhaar"][] = "Aadhaar details not valid";
            $_SESSION["errors"] = $errors;
            redirect_to("register.php");
        }

    }

} else {
    //unauth access
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

        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="p-5 mt-5" style="background-color:#ecebeb;">
                        <form action="user_registration.php" method="post">
                            <h3 class="text-center"><b>Verify OTP</b></h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">OTP</label>
                                <input type="number" name="user_otp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter 6 digit OTP">
                                <small id="emailHelp" class="form-text text-muted">Enter the otp sent on your mobile.</small>
                            </div>

                            <button type="submit" name="otp_submit" class="btn btn-primary form-control mt-2" style="background-color:#76e292;border:1px solid #76e292;">Submit OTP</button>
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
