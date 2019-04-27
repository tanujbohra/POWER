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

$query3 = "SELECT u.status,u.user_id,u.email,u.type,i.individual_name,i.aadhaar_number,i.mobile_number from user u , individual i where u.user_id=i.user_id";
$ui = mysqli_query($conn,$query3);

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Users</title>
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
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li class="current" ><a href="users.php"><i class="glyphicon glyphicon-user"></i> New Users</a></li>
                    <li><a href="all_users.php"><i class="glyphicon glyphicon-user"></i> All Users</a></li>
                    <li><a href="projects.php"><i class="glyphicon glyphicon-book"></i> New Projects</a></li>
                    <li><a href="all_projects.php"><i class="glyphicon glyphicon-book"></i> All Projects</a></li>
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
					<div class="panel-title">New Users</div>
				</div>
  				<div class="panel-body" style="overflow-y:auto;">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Type</th>
								<th>Aadhar/PAN number</th>
								<th>Name</th>
								<th>email</th>
								<th>phone</th>
                <th>Decision</th>
							</tr>
						</thead>
						<tbody>
              <?php
              while($result= mysqli_fetch_assoc($ui)){
                          echo "<tr class="."odd gradeX".">";
                          echo "<td>"."Individual"."</td>";
                          echo "<td>".$result['aadhaar_number']."</td>";
                          echo "<td>".$result['individual_name']."</td>";
                          echo "<td>".$result['email']."</td>";
                          echo "<td>".$result['mobile_number']."</td>";
                     ?>
                     <td>
                     <form action="accept.php" method="post">
                     <input type="submit" value = "Accept" style="float:left"  class="btn btn-default btn-success">
                       <input type="text" name="user_id" value="<?php echo $result['user_id']; ?>" hidden>
                     </form>

                     <form action="reject.php" method="post">
                     <input type="submit" value = "Reject" style="float:right"  class="btn btn-default btn-danger">
                       <input type="text" name="user_id" value="<?php echo $result['user_id']; ?>" hidden>
                     </form>
                     </td>


                     <!-- echo "<td class=".'center'."><a  class=".'btn btn-default'."><span class=".'glyphicon glyphicon-ok'."></span></a>
                     <a  class=".'btn btn-default'." onclick=".'deleteRow(this)'."><span class=".'glyphicon glyphicon-remove'."></span></a></td>"; -->
                    <?php
                     echo "</tr>";
                   }
               ?>
							<!-- <tr class="odd gradeX">
								<td>Trident</td>
								<td>Internet
									 Explorer 4.0</td>
								<td>Win 95+</td>
								<td class="center"> 4</td>
								<td class="center"><a  class="btn btn-default"  ><span class="glyphicon glyphicon-ok"></span></a>
                <a  class="btn btn-default" onclick="deleteRow(this)" ><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr> -->
							<!-- <tr class="even gradeC">
								<td>Trident</td>
								<td>Internet
									 Explorer 5.0</td>
								<td>Win 95+</td>
								<td class="center">5</td>
								<td class="center">C</td>
							</tr>
							<tr class="odd gradeA">
								<td>Trident</td>
								<td>Internet
									 Explorer 5.5</td>
								<td>Win 95+</td>
								<td class="center">5.5</td>
								<td class="center">A</td>
							</tr> -->






							<!-- <tr class="gradeC">
								<td>Misc</td>
								<td>IE Mobile</td>
								<td>Windows Mobile 6</td>
								<td class="center">-</td>
								<td class="center">C</td>
							</tr>
							<tr class="gradeC">
								<td>Misc</td>
								<td>PSP browser</td>
								<td>PSP</td>
								<td class="center">-</td>
								<td class="center">C</td>
							</tr>
							<tr class="gradeU">
								<td>Other browsers</td>
								<td>All others</td>
								<td>-</td>
								<td class="center">-</td>
								<td class="center">U</td>
							</tr> -->
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
