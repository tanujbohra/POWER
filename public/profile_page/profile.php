<?php include '../../includes/session.php';
include '../../includes/connect.php';
include '../../includes/functions.php'; ?>
<?php

if (!isset($_SESSION["current_user"])) {
  redirect_to("../index.php");
}

// $id=5;
// $location="Mumbai";
// $email="user@eg.com";
// $viewid=5;

$current_user = $_SESSION["current_user"];
$type = $current_user["type"];

$id=$current_user["user_id"];
$location=find_user_location($id,$type);
$email=$current_user["email"];
$viewid=$id;

 ?>
<!DOCTYPE html>
<head>
    <title>P.O.W.E.R</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML5 Website Landing Page for Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <!-- github calendar css -->
    <link rel="stylesheet" href="assets/plugins/github-calendar/dist/github-calendar.css"
/>
    <!-- github acitivity css -->
    <link rel="stylesheet" href="assets/plugins/github-activity/src/github-activity.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/profile_style.css">

<script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
#header {
padding: 30px 0;
height: 90px;
position: fixed;
left: 0;
top: 0;
right: 0;
transition: all 0.5s;
z-index: 997;
background: rgba(0, 0, 0, 0.9);
}

#header.header-scrolled {
background: rgba(0, 0, 0, 0.9);
padding: 20px 0;
height: 72px;
transition: all 0.5s;
}

#header #logo {
float: left;
}

@media (min-width: 1024px) {
#header #logo {
  padding-left: 60px;
}
}

#header #logo h1 {
font-size: 34px;
margin: 0;
padding: 0;
line-height: 1;
font-family: "Montserrat", sans-serif;
font-weight: 700;
letter-spacing: 3px;
}

#header #logo h1 a, #header #logo h1 a:hover {
color: #fff;
padding-left: 10px;
border-left: 4px solid #18d26e;
}

#header #logo img {
padding: 0;
margin: 0;
}

@media (max-width: 768px) {
#header #logo h1 {
  font-size: 28px;
}
#header #logo img {
  max-height: 40px;
}
}

.nav-menu, .nav-menu * {
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav-menu ul {
  position: absolute;
  display: none;
  top: 100%;
  left: 0;
  z-index: 99;
}

.nav-menu li {
  position: relative;
  white-space: nowrap;
}

.nav-menu > li {
  float: left;
}

.nav-menu li:hover > ul,
.nav-menu li.sfHover > ul {
  display: block;
}

.nav-menu ul ul {
  top: 0;
  left: 100%;
}

.nav-menu ul li {
  min-width: 180px;
}

/* Nav Menu Arrows */
.sf-arrows .sf-with-ul {
  padding-right: 30px;
}

.sf-arrows .sf-with-ul:after {
  content: "\f107";
  position: absolute;
  right: 15px;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
}

.sf-arrows ul .sf-with-ul:after {
  content: "\f105";
}

/* Nav Meu Container */
#nav-menu-container {
  float: right;
  margin: 0;
}

@media (min-width: 1024px) {
  #nav-menu-container {
    padding-right: 60px;
  }
}

@media (max-width: 768px) {
  #nav-menu-container {
    display: none;
  }
}

/* Nav Meu Styling */
.nav-menu a {
  padding: 0 8px 10px 8px;
  text-decoration: none;
  display: inline-block;
  color: #fff;
  font-family: "Montserrat", sans-serif;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  outline: none;
}

.nav-menu li:hover > a, .nav-menu > .menu-active > a {
  color: #18d26e;
}

.nav-menu > li {
  margin-left: 10px;
}

.nav-menu ul {
  margin: 4px 0 0 0;
  padding: 10px;
  box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
  background: #fff;
}

.nav-menu ul li {
  transition: 0.3s;
}

.nav-menu ul li a {
  padding: 10px;
  color: #333;
  transition: 0.3s;
  display: block;
  font-size: 13px;
  text-transform: none;
}

.nav-menu ul li:hover > a {
  color: #18d26e;
}

.nav-menu ul ul {
  margin: 0;
}

/* Mobile Nav Toggle */
#mobile-nav-toggle {
  position: fixed;
  right: 0;
  top: 0;
  z-index: 999;
  margin: 20px 20px 0 0;
  border: 0;
  background: none;
  font-size: 24px;
  display: none;
  transition: all 0.4s;
  outline: none;
  cursor: pointer;
}

#mobile-nav-toggle i {
  color: #fff;
}

@media (max-width: 768px) {
  #mobile-nav-toggle {
    display: inline;
  }
}

/* Mobile Nav Styling */
#mobile-nav {
  position: fixed;
  top: 0;
  padding-top: 18px;
  bottom: 0;
  z-index: 998;
  background: rgba(0, 0, 0, 0.8);
  left: -260px;
  width: 260px;
  overflow-y: auto;
  transition: 0.4s;
}

#mobile-nav ul {
  padding: 0;
  margin: 0;
  list-style: none;
}

#mobile-nav ul li {
  position: relative;
}

#mobile-nav ul li a {
  color: #fff;
  font-size: 13px;
  text-transform: uppercase;
  overflow: hidden;
  padding: 10px 22px 10px 15px;
  position: relative;
  text-decoration: none;
  width: 100%;
  display: block;
  outline: none;
  font-weight: 700;
  font-family: "Montserrat", sans-serif;
}

#mobile-nav ul li a:hover {
  color: #fff;
}

#mobile-nav ul li li {
  padding-left: 30px;
}

#mobile-nav ul .menu-has-children i {
  position: absolute;
  right: 0;
  z-index: 99;
  padding: 15px;
  cursor: pointer;
  color: #fff;
}

#mobile-nav ul .menu-has-children i.fa-chevron-up {
  color: #18d26e;
}

#mobile-nav ul .menu-has-children li a {
  text-transform: none;
}

#mobile-nav ul .menu-item-active {
  color: #18d26e;
}

#mobile-body-overly {
  width: 100%;
  height: 100%;
  z-index: 997;
  top: 0;
  left: 0;
  position: fixed;
  background: rgba(0, 0, 0, 0.7);
  display: none;
}

/* Mobile Nav body classes */
body.mobile-nav-active {
  overflow: hidden;
}

body.mobile-nav-active #mobile-nav {
  left: 0;
}

body.mobile-nav-active #mobile-nav-toggle {
  color: #fff;
}
.entry:not(:first-of-type)
{
    margin-top: 10px;
}
.container {
  margin-top: 30px;
}
span.glyphicon-remove {
  color: #AA0000;
}
div.col-sm-2:first-child span.glyphicon-remove {
  color: #eeeeee;
}
span.glyphicon-plus {
  padding-right: 3px;
}
.btn-link:hover {
  text-decoration: none;
}

    </style>

</head>

<body>

    <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto">P.O.W.E.R</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">

          <li class="menu"><a href="../index.php">Home</a></li>
          <li class="menu-has-children"><a href="../category_page.php">Explore</a>
            <ul>
              <li><a href="../category_page.php?category=Education">Education</a></li>
              <li><a href="../category_page.php?category=Charity">Charity</a></li>
              <li><a href="../category_page.php?category=Animals">Animals</a></li>
              <li><a href="../category_page.php?category=Medical">Medical</a></li>
              <li><a href="../category_page.php?category=Sports">Sports</a></li>
              <li><a href="../category_page.php?category=Child">Child</a></li>
              <li><a href="../category_page.php?category=Food">Food</a></li>
              <li><a href="../category_page.php?category=Clothes">Clothes</a></li>
              <li><a href="../category_page.php?category=Sanitation">Sanitation</a></li>
              <li><a href="../category_page.php?category=Art">Art</a></li>
              <li><a href="../category_page.php?category=Entertainment">Entertainment</a></li>
            </ul>
          </li>

            <li><a href="../investor.php">Investors</a></li>
            <li><a href="../Post_project.php">Post A Project</a></li>
            <li><a href="../profile_page/profile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
    <div class="header">
        <div class="container">
            <img class="profile-image img-responsive pull-left" style="margin-top:-20px;"src="assets/images/profile.png" alt="James Lee" />
            <div class="profile-content pull-left">
                <h1 class="name"><?php echo $current_user["user_name"]; ?></h1>
                 <div class="section-inner">
                        <h2 class="heading sr-only">Basic Information</h2>
                        <div class="content">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> Location: <?php echo$location; ?></li>
                                <li><i class="fa fa-envelope-o"></i> Email: <a><?php echo$email ?></a></li>
                                <li><a class="btn btn-cta-primary" href="http://themes.3rdwavemedia.com/" target="_blank"><i class="fa fa-paper-plane"></i> Contact Me</a></li>
                            </ul>

                        </div>
                    </div>
            </div>
        </div>
        <!-- <div class="container row">HELLO</div> -->
    </div>

    <div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-md-8 col-sm-12 col-xs-12">
               
                <script>
                $('#modal-dialog1').on('show', function() {
    var link = $(this).data('link'),
        confirmBtn = $(this).find('.confirm');
})


$('#btnYes').click(function() {
  
    // handle form processing here
    
    alert('submit form');
    $('form').submit();
  
});

$('#modal-dialog2').on('show', function() {
    var link = $(this).data('link'),
        confirmBtn = $(this).find('.confirm');
})


$('#btnYes').click(function() {
  
    // handle form processing here
    
    alert('submit form');
    $('form').submit();
  
});
$('#modal-dialog3').on('show', function() {
    var link = $(this).data('link'),
        confirmBtn = $(this).find('.confirm');
})


$('#btnYes').click(function() {
  
    // handle form processing here
    
    alert('submit form');
    $('form').submit();
  
});
            
                </script>
          <section class="section">
                <div class="section-inner" style="overflow-y:auto; ">
               <div class="content-box-large">

          <div class="panel-heading">
           <?php if($viewid==$id){

            ?>
         
          <h2 class="heading">My Applicants</h2>
        </div>
          <div class="panel-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
              <tr>
                <th>My project name</th>
                <th>Applied User name</th>
                <th>Choose Hire/Dismiss</th>
              </tr>
            </thead>
            <tbody>
              <?php
            
             //  "SELECT user_name from user where user_id in (SELECT user_id from applicant where project_id in(select project_id from project as p where user_id='".$id."'))";
              $query ="SELECT * FROM applicant a, project p,user u WHERE u.user_id=a.user_id AND p.project_id=a.project_id and p.user_id='".$id."'";
              //SELECT * FROM user as u join applicant as a on p.project_id=a.project_id join user as u ON p.user_id=u.user_id AND p.user_id='".$id."'
              $records = mysqli_query($conn,$query);
              while($result = mysqli_fetch_assoc($records)){
                    // $_SESSION["pid"]=$result['project_id'];
                    // $_SESSION["uid"]=$result['user_id'];
 
                   if($result['status']==0){
                     echo "<td>".$result['project_title']."</td>";
                     echo "<td>".$result['user_name']."</td>";        
                     ?>

                     <form action="hire.php" method="post">
                     <td><input type="submit" value = "Hire" style="float:left"  class="btn btn-default btn-success">
                       <input type="text" name="user_id" value="<?php echo $result['user_id']; ?>" hidden>
                       <input type="text" name="project_id" value="<?php echo $result['project_id']; ?>" hidden>
                     </form>

                     <form action="dontHire.php" method="post">
                     <input type="submit" value = "Dismiss" style="float:right"  class="btn btn-default btn-danger">
                       <input type="text" name="user_id" value="<?php echo $result['user_id']; ?>" hidden>
                       <input type="text" name="project_id" value="<?php echo $result['project_id']; ?>" hidden></td>
                     </form>
                    <?php
                     echo "</tr>";
             }
            }
          }
               ?>
            </tbody>
          </table>
          </div>
        </div>
        </div>
        </section>
               <section class="latest section">
                    <div class="section-inner">
                    <?php if($id==$viewid) {?>
                        <h2 class="heading">My Projects</h2><?php } else {?>
             <h2 class="heading">Projects</h2><?php } ?>
                        <div class="content">
                            <hr class="divider" />
                            
                            <?php
                        
                            $query1="SELECT * FROM project WHERE user_id='".$id."'";
                            $records=mysqli_query($conn,$query1);
        
                            while($result = mysqli_fetch_assoc($records)){?>
                              <div class="item row">
                            <a class="col-md-4 col-sm-4 col-xs-12" href="project_details.php" target="_blank"> 
                            <?php
                             echo "<img class="."img-responsive"." "."src="."../UploadsImages/".$result['project_image'];?>

                               <!--uploads/images/project_image -->
                                </a>
                                <div class="desc col-md-8 col-sm-8 col-xs-12">
                                    <h3 class="title"><a href="project_details.php" target="_blank"><?php echo $result['project_title'];?></a></h3>
                                    <p><?php echo $result['project_description'];?></p>
                                    <p style="float: left"><a class="more-link" href="project_details.php" target="_blank"><i class="fa fa-external-link"></i> Find out more</a></p>
                                    <p style="float: right"><a class="more-link" href="edit_my_project.php" target="_blank"><i class="fa fa-edit"></i> Edit this project</a></p>
                                </div><!--//desc-->
                            </div><!--//item-->
                            <hr>
                            <?php }?>

                        </div><!--//content-->
                    </div><!--//section-inner-->
                </section><!--//section-->
                 <section class="latest section">
                    <div class="section-inner">
                        <h2 class="heading">Projects Funded</h2>
                        <div class="content">  
                          <hr class="divider" />
                            <?php
                          
                            $query2="SELECT * FROM donor AS d JOIN project AS p ON d.project_id = p.project_id WHERE d.user_id = '".$id."'";
                            $records=mysqli_query($conn,$query2);
                            while($result = mysqli_fetch_assoc($records)){?>
                              <div class="item row">
                            <a class="col-md-4 col-sm-4 col-xs-12" href="project_details.php" target="_blank"> 
                            <?php
                             echo "<img class="."img-responsive"." "."src="."../UploadsImages/".$result['project_image'];?>

                               <!--uploads/images/project_image -->
                                </a>
                                <div class="desc col-md-8 col-sm-8 col-xs-12">
                                    <h3 class="title"><a href="project_details.php" target="_blank"><?php echo $result['project_title'];?></a></h3>
                                    <p><?php echo $result['project_short_description'];?></p>
                                    <h4 style="color: #69ca8d">
                                    <?php
                                    echo "Amount Donated: ".$result['donation_amount']."<br>";
                                    if($result['donation_type']==1)
                                      echo "<h5>Donated as: Anonymous</h5>";
                                    ?>
                                </h4>
                                    <p style="float: left"><a class="more-link" href="project_details.php" target="_blank"><i class="fa fa-external-link"></i> Find out more</a></p>
                                </div><!--//desc-->
                            </div><!--//item-->
                            <hr>
                            <?php }?>
          

                        </div><!--//content-->
                    </div><!--//section-inner-->
                </section><!--//section-->
                <script>
                  $(document).ready(function() {
    $('#example1').DataTable();
} );
                </script>

                <?php 
                $query4="SELECT * FROM user as u JOIN individual as i ON u.user_id=i.user_id AND u.user_id='".$id."'";
                $records=mysqli_query($conn,$query4);
                while ($row=mysqli_fetch_assoc($records)) {
                 
                  if($row['type']==1||$row['gender']=="F"){
                ?>
   <section class="section">
                <div class="section-inner" style="overflow-y:auto; ">
               <div class="content-box-large">
               <?php if($id==$viewid){?>
          <div class="panel-heading">
          <h2 class="heading">My Applications' Status</h2>
        </div>
      
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1" >
            <thead>
              <tr>
                <th>Project Applied For</th>
                <th>Owner Name</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query3="SELECT * FROM applicant AS a LEFT OUTER JOIN project AS p ON a.project_id = p.project_id LEFT OUTER JOIN user AS u ON p.user_id=u.user_id WHERE a.user_id = '".$id."'";
              $records=mysqli_query($conn,$query3);
              while($result = mysqli_fetch_assoc($records)){

                        echo "<td>".$result['project_title']."</td>";
                        echo "<td>".$result['user_name']."</td>";
                        if($result['status']==2)
                          echo "<td class="."bg-danger>Rejected</td>";
                        elseif($result['status']==0)
                          echo "<td class="."bg-warning>Pending</td>";
                        else
                          echo "<td class="."bg-success>Approved</td>"
                     ?>
                    
                    <?php
                      echo "</tr>";
               }
               ?>
            </tbody>
          </table>
        </div>
        <?php } ?>
        </div>
        </section>
        <?php
          }
                }
              

                ?>
            </div><!--//primary-->
            <div class="secondary col-md-4 col-sm-12 col-xs-12">
                 
                   <!--//section-inner-->

                <aside class="skills aside section">
                    <div class="section-inner">
                        <h2 class="heading">Skills</h2>
                        
                        <div class="content">

                            <div class="skillset">

                                <div class="item">
                                    <?php
                                    $i=0;
                                    $query2="SELECT * FROM edit WHERE user_id='".$id."'";
                                    $result = mysqli_query($conn,$query2); 
                                    $num_results = mysqli_num_rows($result);
                                   while($row=mysqli_fetch_assoc($result)){
                                      // foreach($row as $value){
                                      ?>
                                      <div class="item">
                                      <?php 
                                      if($row["skills"]=="NA"||$row["level"]=="NA")
                                        echo "";
                                      else
                                        {?><h3 class="level-title">
                                      <?php
                                          
                                         echo $row["skills"];
                                         if($row["level"]=="expert"){
                                         ?>
                                        
                                          <span class="level-label" data-toggle="tooltip" data-placement="left" data-animation="true">Expert</span>
                                    <div class="level-bar">
                                     <div class="level-bar-inner" data-level="100%">
                                     </div>
                                    </div>
                                    </div>
                                    <?php
                                    }
                                    elseif($row["level"]=="inter"){
                                    ?>
                                    <span class="level-label" data-toggle="tooltip" data-placement="left" data-animation="true">Intermidiate</span>
                                    <div class="level-bar">
                                     <div class="level-bar-inner" data-level="50%">
                                     </div>
                                    </div>
                                    </div>
                                    <?php
                                    }
                                    elseif($row["level"]=="beg"){
                                      ?>
                                        <span class="level-label" data-toggle="tooltip" data-placement="left" data-animation="true">Beginner</span>
                                    
                                   </h3>
                                    <div class="level-bar">
                                     <div class="level-bar-inner" data-level="25%">
                                     </div>
                                    </div>             
                                      </div>
                                      <?php 
                                      }
                                    }
                                    $i++;
                                   }
                                    ?>
                            </div>
                        </div><!--//content-->
                        <div class="container">

    <a href="#modal-dialog1" class="modal-toggle" data-toggle="modal" data-href="http://localhost.testing/modal-processing.php" data-modal-type="confirm" data-modal-title="Delete Property" data-modal-text="Are you sure you want to delete {$property.address_string}?" data-modal-confirm-url="{$base_url}residential-lettings/properties/do-delete/property/{$property.id}"><i class="icon-trash"></i> <?php if($viewid==$id){?>Add Skills</a><?php }?>
</div>
<div id="modal-dialog1" class="modal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
             <h3>Add Skills</h3>
        </div>
        <div class="modal-body">

        <div class="panel panel-default">

  <div class="panel-heading">Skills</div>
  <div class="panel-body">
  
  <div id="skill_fields">
          
        </div>

       <div class="col-sm-6 nopadding">
  <div class="form-group">
  <form action="add_skills.php" method="POST">
    <input type="text" class="form-control" id="Schoolname" name="fields[]" value="" placeholder="skill">
  </div>
</div>
<div class="col-sm-4 nopadding">
  <div class="form-group">
    <div class="input-group">
      <select class="form-control" id="educationDate" name="level[]">
      
        <option value="">level</option>
        <option value="expert">Expert</option>
        <option value="inter">Intermidiate</option>
        <option value="beg">Beginner</option>

      </select>
      <div class="input-group-btn">
        <button class="btn btn-success" type="button"  onclick="skill_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
  
  </div>
  <div class="panel-footer"><small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small>, <small>Press <span class="glyphicon glyphicon-minus gs"></span> to remove form field :)</small></div>
        </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Save Changes" id="submit" class="btn secondary">
           </form>
          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>

        </div>
      </div>
    </div>
</div> 
</div><!--//section-inner-->

                </aside><!--//section-->
             
                <script>
                       var room = 1;
function skill_fields() {
 
    room++;
    var objTo = document.getElementById('skill_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-6 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="fields[]" value="" placeholder="skill"></div></div><div class="col-sm-4 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="level[]"><option value="">level</option><option value="expert">Expert</option><option value="inter">Intermidiate</option><option value="beg">Beginner</option></select><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }
     

                </script>
                <aside class="education aside section">
                    <div class="section-inner">
                        <h2 class="heading">Education</h2>
                        <div class="content">

                           <?php
                                   
                                    $i=0;
                                    $query1="SELECT * FROM edit WHERE user_id='".$id."'";
                                    $result = mysqli_query($conn,$query1); 
                                    $num_results = mysqli_num_rows($result);
                                   while($row=mysqli_fetch_assoc($result)){
                                      // foreach($row as $value){
                                      ?>
                                      <div class="item">
                                      <h3 class="title">
                                      <?php 
                                      if($row["school"]=="NA"||$row["degree"]=="NA"||$row["major"]=="NA"||$row["year"]==0)
                                        echo "";
                                      else
                                        {?><i class="fa fa-graduation-cap"></i>
                                      <?php
                                          
                                         echo $row["degree"] ;echo" ";echo$row["major"];?></h3>
                                         <h4 class="university">
                                         <?php 
                                         echo $row["school"];echo " ";
                                         echo "(".$row["year"].")";
                                          }?></h4>
                                          
                                      </div>
                                      <?php 
                                    // }
                                    $i++;
                                   }
                                    ?>
                        </div><!--//content-->
                        <div class="container">

    <a href="#modal-dialog2" class="modal-toggle" data-toggle="modal" data-href="http://localhost.testing/modal-processing.php" data-modal-type="confirm" data-modal-title="Delete Property" data-modal-text="Are you sure you want to delete {$property.address_string}?" data-modal-confirm-url="{$base_url}residential-lettings/properties/do-delete/property/{$property.id}"><?php if($viewid==$id){?>Add Education</a><?php }?>
</div>
<div id="modal-dialog2" class="modal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
             <h3>Add Education</h3>
        </div>
        <div class="modal-body">

           <div class="panel panel-default">

  <div class="panel-heading">Education Experience</div>
  <div class="panel-body">
  
  <div id="education_fields">
          
        </div>

       <div class="col-sm-3 nopadding">
  <div class="form-group">
  <form action="add_edu.php" method="POST">
    <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name">
  </div>
</div>
<div class="col-sm-3 nopadding">
  <div class="form-group">
    <input type="text" class="form-control" id="Major" name="Major[]" value="" placeholder="Major">
  </div>
</div>
<div class="col-sm-3 nopadding">
  <div class="form-group">
    <input type="text" class="form-control" id="Degree" name="Degree[]" value="" placeholder="Degree">
  </div>
</div>

<div class="col-sm-3 nopadding">
  <div class="form-group">
    <div class="input-group">
      <select class="form-control" id="educationDate" name="educationDate[]">
      
        <option value="">Date</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
      </select>
      <div class="input-group-btn">
        <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
  
  </div>
  <div class="panel-footer"><small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small>, <small>Press <span class="glyphicon glyphicon-minus gs"></span> to remove form field :)</small></div>
        </div>
        <div class="modal-footer">
           <input type="submit" name="submit" value="Save Changes" id="submit" class="btn secondary">
          </form>
          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>
        </div>
      </div>
    </div>
</div> 
                    </div><!--//section-inner-->
                </aside><!--//section-->
     <script>
     var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Major" name="Major[]" value="" placeholder="Major"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Degree" name="Degree[]" value="" placeholder="Degree"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="educationDate[]"><option value="">Date</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option> </select><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }
                </script>             


                <aside class="languages aside section">
                    <div class="section-inner">
                        <h2 class="heading">Languages</h2>
                        <div class="content">
                        <?php
                                
                                    $i=0;
                                    $query1="SELECT languages FROM edit WHERE user_id='".$id."'";
                                    $result = mysqli_query($conn,$query1); 
                                    $num_results = mysqli_num_rows($result);
                                   while($row=mysqli_fetch_assoc($result)){
                                      // foreach($row as $value){
                                      ?>
                                      <ul class="list-unstyled">
                                      <li class="item">
                                      <span class="title">
                                      <!-- <h3 class="title"> -->
                                      <?php 
                                      if($row["languages"]=="NA")
                                        echo "";
                                      else
                                    {?>
                                  <strong>
                                  <?php
                                         echo $row["languages"] ;?></strong></span></li></ul>
                                         <?php 
                                          }
                                    // }
                                    $i++;
                                   }
                                   ?>
                                   </div>
    <div class="container">

    <a href="#modal-dialog3" class="modal-toggle" data-toggle="modal" data-href="http://localhost.testing/modal-processing.php" data-modal-type="confirm" data-modal-title="Delete Property" data-modal-text="Are you sure you want to delete {$property.address_string}?" data-modal-confirm-url="{$base_url}residential-lettings/properties/do-delete/property/{$property.id}"><i class="icon-trash"></i><?php if($viewid==$id){?>Add Languages</a><?php }?>
</div>
<div id="modal-dialog3" class="modal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
             <h3>Add Languages</h3>
        </div>
        <div class="modal-body">
         <div class="panel panel-default">

  <div class="panel-heading">Skills</div>
  <div class="panel-body">
  
  <div id="lang_fields">
          
        </div>

       <div class="col-sm-6 nopadding">
  <div class="form-group">
  <form action="add_lang.php" method="POST">
    <input type="text" class="form-control" id="Schoolname" name="lang[]" value="" placeholder="language">
  </div>
</div>
<div class="col-sm-6 nopadding">
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-btn">
        <button class="btn btn-success" type="button"  onclick="lang_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
  
  </div>
  <div class="panel-footer"><small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small>, <small>Press <span class="glyphicon glyphicon-minus gs"></span> to remove form field :)</small></div>
        </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Save Changes" id="submit" class="btn secondary">
           </form>
          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>

        </div>
      </div>
    </div>
</div> 
</div><!--//section-inner-->
                </aside><!--//section-->
<script>
  var room = 1;
function lang_fields() {
 
    room++;
    var objTo = document.getElementById('lang_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-6 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="lang[]" value="" placeholder="Language"></div></div><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }
</script>

            </div><!--//secondary-->
        </div><!--//row-->
    </div><!--//masonry-->

    <!-- ******FOOTER****** -->
    <footer class="footer">
        <div class="container text-center">
                <small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
        </div><!--//container-->
    </footer><!--//footer-->

    <!-- Javascript -->
    <script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-rss/dist/jquery.rss.min.js"></script>
    <!-- github calendar plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/3.0.2/es6-promise.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fetch/0.10.1/fetch.min.js"></script>
    <script type="text/javascript" src="assets/plugins/github-calendar/dist/github-calendar.min.js"></script>
    <!-- github activity plugin -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>
    <script type="text/javascript" src="assets/plugins/github-activity/src/github-activity.js"></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/main.js"></script>
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
    <script src="js/bootstrap.min.js"></script>

    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>
    <script src="js/tables.js"></script>
 <script src="js/main.js"></script>

</body>
</html>
