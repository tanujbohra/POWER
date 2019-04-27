<?php include '../includes/session.php';?>
<?php include '../includes/connect.php'; ?>

<?php //cheeck if user logged in
if (isset($_SESSION["current_user"])) {
  $current_user = $_SESSION["current_user"];
  //$user_details = $_SESSION["result_list_array"];
} else {
  $current_user = null;
  $user_details = null;
}

$user_login = true; //login status boolean
if (isset($current_user)) {
  $user_login = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
   <!--  <link rel="stylesheet" href="css/bootstrap.min.css">
 -->

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/home_style.css" rel="stylesheet">


</head>

<body>
<header id="header" style="background-color: rgb(0,0,0,0.9)">
    <div class="container-fluid">

        <div id="logo" class="pull-left">
            <h1><a href="#intro" class="scrollto">P.O.W.E.R</a></h1>
        </div>

        <nav id="nav-menu-container">
        <ul class="nav-menu">

          <li class="menu-active"><a href="index.php">Home</a></li>
          <li><a href="category_page.php">Explore</a></li>
          <?php 

          if ($user_login == true) {
            echo "<li><a href=\"investor.php\">Investors</a></li>";
            echo "<li><a href=\"Post_project.php\">Post A Project</a></li>";
            echo "<li><a href=\"profile.php\">Profile</a></li>";
            
            echo '<li class="menu-has-children"><a href=""><span class="label label-pill label-danger count" style="border-radius:10px;"></span><i class="fa fa-envelope" aria-hidden="true"></i></a>
            <ul class="dropdown-menu"></ul>
          </li>';/*
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
                  <ul class="dropdown-menu"></ul>
                  </li>;*/
            echo "<li><a href=\"logout.php\">Logout</a></li>";
          } else {
            echo "<li><a href=\"login_page.php\">Login</a></li>";
          }
          ?>
          
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->
<!--Google translate-->
    <div id="google_translate_element" style="margin-top: 100px; margin-left: 30px">
    </div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!--End of google translate-->
    <script>
$(document).ready(function(){
var view='';
 function load_unseen_notification(view)
{
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType: 'json',
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();

$(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
