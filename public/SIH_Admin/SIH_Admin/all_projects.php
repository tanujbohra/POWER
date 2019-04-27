<?php
$servername = "localhost";
$username = "root";
$password = "";
error_reporting(0);
// Create connection
$conn = mysqli_connect($servername, $username, $password,"power");

// $db = mysql_select_db("SIH",$conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

$query = "SELECT * FROM project";
$project = mysqli_query($conn,$query);
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>All projects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="css/tables.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- lightbox -->
    <link href="dist/css/lightbox.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("example").deleteRow(i);
  }
  // <?php
  // $variable = $_GET['i'];
  // $query3 = "UPDATE user set status=2 WHERE uid = '".$variable."'";
  // $temp = mysqli_query($conn,$query3);
  // ?>
    </script>
    <script type="text/javascript">
      $('#modal-dialog1').on('show', function() {
      var link = $(this).data('link'),
          confirmBtn = $(this).find('.confirm');
  })
  </script>
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">P.O.W.E.R</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="profile.html">Profile</a></li>
	                          <li><a href="login.html">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
        <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="users.php"><i class="glyphicon glyphicon-user"></i> New Users</a></li>
                    <li><a href="all_users.php"><i class="glyphicon glyphicon-user"></i> All Users</a></li>
                    <li><a href="projects.php"><i class="glyphicon glyphicon-book"></i> New Projects</a></li>
                    <li class="current"><a href="all_projects.php"><i class="glyphicon glyphicon-book"></i> All Projects</a></li>
                    <li><a href="reported_projects.php"><i class="glyphicon glyphicon-ban-circle"></i>Reported Projects</a></li>
                    <li><a href="transactions.php"><i class="glyphicon glyphicon-credit-card"></i>New Transactions</a></li>
                    <li><a href="transactions.php"><i class="glyphicon glyphicon-credit-card"></i>All Transactions</a></li>
                    <li><a href="calendar.php"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
                    <li><a href="stats.php"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">

  			<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">All Projects</div>
				</div>
  				<div class="panel-body" style="overflow-y:auto;">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
						<thead>
							<tr>
								<th>ML Score</th>
								<!-- <th>Photo</th> -->
								<th>Title</th>
								<th>Description</th>
								<th>Amount</th>
                <th>Decision</th>
							</tr>
						</thead>
						<tbody>
              <?php
              while($result = mysqli_fetch_assoc($project)){
                      echo "<tr class="."odd gradeX".">";
                      echo "<td>".$result['project_score']."</td>";
                      ?>
                      <?php
//                       echo '<td><a href="'.$result['project_photo'].'" data-lightbox="image-1" data-title="'.$result['project_title'].'"><img src="'.$result['project_photo'].'
// " width="100" height="50" /></a>&nbsp;';
                      //echo "<td>".$result['project_photo']."</td>";
                      echo "<td>".$result['project_title']."</td>";
                      echo "<td>".$result['project_short_description']."</td>";
                      echo "<td>".$result['project_funds']."</td>";
                     ?>
                     <?php
                     if($result['project_status']!=2){
                       ?>
                     <td><form action="all_project_block.php" method="post">
                    <center> <input type="submit" value = "Block" class="btn btn-default btn-danger">
                       <input type="text" name="user_id" value="<?php echo $result['user_id']; ?>" hidden></td></center>
                     </form>
                   <?php }else{?>
                     <td>
                    <center> <input value = "Blocked" class="btn btn-default btn-danger" style="height:40px;width:75px" disabled></td></center>
                     </form>

                     <!-- echo "<td class=".'center'."><a  class=".'btn btn-default'."><span class=".'glyphicon glyphicon-ok'."></span></a>
                     <a  class=".'btn btn-default'." onclick=".'deleteRow(this)'."><span class=".'glyphicon glyphicon-remove'."></span></a></td>"; -->
                    <?php
                     echo "</tr>";
                   }
              }
               ?>
						</tbody>
					</table>
  				</div>
  			</div>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">

            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>

         </div>
      </footer>

      <!--LIGHTBOX-->
      <script src="dist/js/lightbox.js"></script>
      <script    src="https://code.jquery.com/jquery-3.2.1.min.js"
              integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
              crossorigin="anonymous"></script>

      <script src="dist/js/lightbox.min.js"></script>

      <link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/table1.js"></script>
    <!-- jQuery UI -->
    <script src="js/table2.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="js/custom.js"></script>
    <script src="js/tables.js"></script>
  </body>
</html>
