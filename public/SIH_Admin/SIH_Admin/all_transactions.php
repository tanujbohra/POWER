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

$query = "SELECT * FROM transaction";
$user1 = mysqli_query($conn,$query);
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Transactions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="css/tables.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">


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
                  <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                  <li><a href="users.php"><i class="glyphicon glyphicon-user"></i> New Users</a></li>
                  <li><a href="all_users.php"><i class="glyphicon glyphicon-user"></i> All Users</a></li>
                  <li><a href="projects.php"><i class="glyphicon glyphicon-book"></i> New Projects</a></li>
                  <li><a href="all_projects.php"><i class="glyphicon glyphicon-book"></i> All Projects</a></li>
                  <li><a href="reported_projects.php"><i class="glyphicon glyphicon-ban-circle"></i>Reported Projects</a></li>
                  <li><a href="transactions.php"><i class="glyphicon glyphicon-credit-card"></i>New Transactions</a></li>
                  <li class="current"><a href="all_transactions.php"><i class="glyphicon glyphicon-credit-card"></i>All Transactions</a></li>
                  <li><a href="calendar.php"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
                  <li><a href="stats.php"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
                    <!-- <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li> -->
                    <!-- <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li> -->
                    <!-- <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li> -->
                    <!-- <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>
                         <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li> -->
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">

  			<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">All Transactions</div>
				</div>
  				<div class="panel-body" style="overflow-y:auto;">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Transaction ID</th>
								<th>User ID</th>
								<th>Project ID</th>
								<th>Transaction amount</th>
                <th>Decision</th>
							</tr>
						</thead>
						<tbody>
              <?php
              while($result = mysqli_fetch_assoc($user1)){
                  echo "<tr class="."odd gradeX".">";
                  echo "<td>".$result['transaction_id']."</td>";
                  echo "<td>".$result['user_id']."</td>";
                  echo "<td>".$result['project_id']."</td>";
                  echo "<td>".$result['transaction_amount']."</td>";
                     ?>
                     <?php
                     if($result['transaction_status']!=2){
                       ?>
                     <td><form action="all_transactions_block.php" method="post">
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
