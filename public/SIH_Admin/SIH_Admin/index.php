<!DOCTYPE html>
<html>
  <head>
    <title>Admin | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/stats.css" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
                  <li class="current" ><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                  <li><a href="users.php"><i class="glyphicon glyphicon-user"></i> New Users</a></li>
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
		  	<div class="row">
          <div class="col-md-6">
  					<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">Bar Chart</div>

							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
		  					<div id="catchart" style="width:100%;height:300px"></div>
		  				</div>
		  			</div>
  				</div>

          <div class="col-md-6">
            <div class="content-box-large">
              <div class="panel-heading">
                    <div class="panel-title">Send an Email</div>

                    <div class="panel-options">
                      <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                      <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                    </div>
                </div>
              <div class="panel-body">
                <form action="">
                <fieldset>
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="Enter Email" type="email">
                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" placeholder="Subject" type="text">
                  </div>
                  <div class="form-group">
                    <label>Textarea</label>
                    <textarea class="form-control" placeholder="Textarea" rows="5"></textarea>
                  </div>
                  <!-- <div class="form-group">
                    <label>Readonly</label>
                    <span class="form-control">Read only text</span>
                  </div> -->
                </fieldset>
                <div>
                  <div class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Submit
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="vendors/morris/morris.css">


    <script src="vendors/jquery.knob.js"></script>
    <script src="vendors/raphael-min.js"></script>
    <script src="vendors/morris/morris.min.js"></script>

    <script src="vendors/flot/jquery.flot.js"></script>
    <script src="vendors/flot/jquery.flot.categories.js"></script>
    <script src="vendors/flot/jquery.flot.pie.js"></script>
    <script src="vendors/flot/jquery.flot.time.js"></script>
    <script src="vendors/flot/jquery.flot.stack.js"></script>
    <script src="vendors/flot/jquery.flot.resize.js"></script>

    <script src="js/custom.js"></script>
    <script src="js/stats.js"></script>
  </body>
</html>
