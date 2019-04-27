<?php include '../includes/functions.php'; ?>
<?php include '../includes/layouts/header.php';?>

<?php
$query1="select * from project where project_id=1";
$query2="select u.user_name from user u,project p where p.user_id=u.user_id and p.project_id=1";
$query3="select * from donor where project_id=1";
$query4="select * from updates where project_id=1";
$query7="select * from comment where project_id=1";

if ($result1=mysqli_query($conn,$query1))
{
	$row1=mysqli_fetch_array($result1);
}
if($result2=mysqli_query($conn,$query2)){
	$row2=mysqli_fetch_array($result2);
}
$result3=mysqli_query($conn,$query3);
$count=0;$amount=0;
while($row3 = mysqli_fetch_assoc($result3)){
	$count++;
	foreach($row3 as $key => $val){
		if($key=='donation_amount'){
			$amount=$amount+$val;
		}
	}
}
$percent=$amount*100/$row1['project_people'];
$result4=mysqli_query($conn,$query4);
$result6=mysqli_query($conn,$query3);
$result7=mysqli_query($conn,$query7);
?>
<head>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Template CSS -->
	<link href="css/project-details_style.css" rel="stylesheet">
	<style>
		.share_like_report {
			color: #FFF;
			font-size: 17px;
			font-weight: 600;
			padding: 10px 60px;
		}
		#favourite{
			position:absolute;
			top:30px;
			right:30px;
		}
		.star-rating .fa-star{color: yellow;}
		.star-rating_given .fa-star{color: yellow;}
		.star-rating_user .fa-star{color: yellow;}
	</style>

</head>
<body>
	<!--main content-->
	<div class="main-content">
		<div class="container">
			<div class="row">
				<div class="content col-md-8 col-sm-12 col-xs-12">
					<div class="section-block">
						<div class="funding-meta">
							<h1><?php echo $row1["project_title"];?></h1>
							<button class="btn btn-launch" id="favourite"><i class="fa fa-heart"></i></button>
							<span class="type-meta"><i class="fa fa-user"></i><?php echo $row2['user_name'];?></span>
							<span class="type-meta"><i class="fa fa-tag"></i><a href="#"><?php echo $row1['project_category'];?></a></span>
							<span class="type-meta"><i class="fa fa-globe"></i><a href="#"><?php echo $row1['project_website'];?></a></span>
							<div><img src="<?php echo 'UploadsImages/'.$row1['project_image'];?>" class="img-rounded img-responsive" alt="<?php echo $row1['project_title'];?>"></div>
							<p><?php echo $row1['project_short_description'];?></p>
							<h2>&#x20B9; <?php echo $amount;?> </h2>
							<span class="contribution">raised by <strong><?php echo $count;?></strong> magnanimous donors.</span>
							<div class="progress">
								<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent;?>%;">
								</div>
							</div>
							<span class="goal-progress"><strong><?php echo $percent;?> %</strong> of &#x20B9; <?php echo $row1['project_funds'];?> raised</span>
						</div>
						<?php
						$date=$row1['project_timestamp'];
						$date=substr($date,0,10);
						$date=date('Y-m-d', strtotime($date.'+ '.$row1["project_deadline"].' days'));
						$today=date("Y-m-d");
						$days_left= strtotime($date) - strtotime($today);
						if($days_left<=0){
							$days_left=0;
						}
						//echo $days_left;
						?>
						<span class="count-down"><strong><?php echo round($days_left/(60 * 60 * 24)); ?></strong>Days to go.</span>
						<a href="#" class="btn btn-launch">FUND THE PROJECT</a><br><br>
						<!-- <a href="#" class="btn btn-launch">APPLY FOR WORK</a> -->
					</div>
					<!--share like report-->
					<div class="section-block" align="center">
						<div class="btn-group" role="group">
							<div class="col-sm-6"><button type="button" class="btn btn-primary share_like_report" id="like_button">LIKE &nbsp;<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button></div>
							<div class="col-sm-6"><button type="button" class="btn btn-danger share_like_report" id="report_button">REPORT &nbsp;<i class="fa fa-bug" aria-hidden="true"></i></button></div>
						</div>
							<div class="col-sm-6"><p style="margin: 5px">LIKES: <strong id="like_count"><?php echo $row1['project_likes']?></strong></p></div>
							
							<div class="col-sm-6"><p style="margin: 5px"> REPORTS: <strong id="report_count"><?php echo $row1['project_reports']?></strong></p></div>
					</div>
					<!--tabs-->
					<div class="section-block">
						<div class="section-tabs">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">About</a></li>
								<li role="presentation"><a href="#updates" aria-controls="updates" role="tab" data-toggle="tab">Updates</a></li>
							</ul>
						</div>
					</div>
					<!--/tabs-->
					<!--tab panes-->
					<div class="section-block">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active">
								<div class="about-information">
									<h1 class="section-title">ABOUT PROJECT</h1>
									<p><?php echo $row1['project_description']; ?></p>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="updates">
								<div class="update-information">
								<h1 class="section-title">UPDATES</h1>
									<!--update items-->
									<?php
									while($row4 = mysqli_fetch_assoc($result4)){
										echo '<div class="update-post">';
										foreach($row4 as $key => $val){
											if($key=='update_title')
												echo '<h4 class="update-title">'.$val.'</h4>';
											if($key=='update_timestamp'){
												$days=strtotime($today)-strtotime(date('Y-m-d',strtotime(substr($val,0,10))));
												echo '<span class="update-date"> Posted '.$days.' days ago </span>';
											}
											if($key=='update_description')
												echo '<p>'.$val.'</p>';
										}
										echo '</div>';
									}
									?>
									<!--/update items-->
								</div>
							</div>
						</div>
					</div>
					<div class="section-block summary" id="block">
						<h1 class="section-title">COMMENTS SECTION</h1>
					<!--signup-->
					<?php
					$avg_rating=0;$comment_count=0;
					$star5=0;$star4=0;$star3=0;$star2=0;$star1=0;
					while($row7 = mysqli_fetch_assoc($result7)){
						$comment_count++;
						echo '<div class="section-block">';
						foreach($row7 as $key => $val){
							if($key=='rating'){
								$avg_rating=$avg_rating+$val;
								if($val==5)
									$star5++;
								elseif($val==4)
									$star4++;
								elseif($val==3)
									$star3++;
								elseif($val==2)
									$star2++;
								elseif($val==1)
									$star1++;
								echo '<br><span class="star-rating_given" style="font-size:1.75em">';
								for ($i=1; $i<=$val;$i++) { 
									echo '<span class="fa fa-star"></span>';
								}
								for($i=5-$val;$i>=1;$i--)
									echo '<span class="fa fa-star-o"></span>';
								echo '</span>';
							}
							if($key=='comment')
								echo '<input class="signup-input" type="text" style="color:black" value="'.$val.'" disabled>';
						}
						echo '</div>';
						//echo $star5." ".$star4." ".$star3." ".$star2." ".$star1;
					}
					$avg_rating=$avg_rating/$comment_count;
					?>
					</div>
					<div class="section-block signup">
						<div class="sign-up-form">
							<strong style="color: white; font-size: 1.5em">RATE PROJECT:</strong>
							<span class="star-rating" style="font-size:1.75em;color: white" id="post_rate">
								<span class="fa fa-star-o" data-rating="1"></span>
								<span class="fa fa-star-o" data-rating="2"></span>
								<span class="fa fa-star-o" data-rating="3"></span>
								<span class="fa fa-star-o" data-rating="4"></span>
								<span class="fa fa-star-o" data-rating="5"></span>
								<input type="hidden" name="stars" class="rating-value" value="0" id="comment_rating">
							</span><br>
							<strong style="color: white; font-size: 1.5em">COMMENT &nbsp;<i class="fa fa-comments-o" aria-hidden="true"></i></strong>
								
							<input class="signup-input" type="text" name="comment" placeholder="Write a comment" id="comment_data">
							<button class="btn btn-signup" type="submit" id="comment_button"><i class="fa fa-paper-plane"></i></button>
						</div>
					</div>
					<!--/signup-->
				</div>
				<!--/tabs-->
				<!--/main content-->
				<!--sidebar-->
				<div class="content col-md-4 col-sm-12 col-xs-12">
					<div class="section-block summary">
						<h1 class="section-title"><?php echo $row1['project_title'];?></h1>
						<div class="profile-contents">
							<h2 class="position"><?php echo $row1['project_short_description'];?></h2>
							<img src="<?php echo 'UploadsImages/'.$row1['project_image'];?>" class="img-rounded img-responsive" alt="<?php echo $row1['project_title'];?>">
							<!--social links-->
							<ul class="list-inline">
								<!-- <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Flocalhost%2Fpower%2Fpublic%2Fproject_details.php&layout=button_count&size=small&mobile_iframe=false&appId=213068979275307&width=69&height=20" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe> -->
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-git"></i></a></li>
							</ul>
							<!--/social links-->
							<button type="button" class="btn btn-success share_like_report">SHARE &nbsp;<i class="fa fa-share" aria-hidden="true"></i></button>
							<div><p style="margin: 5px"><strong> SHARES: </strong><?php echo $row1['project_shares']?></p></div>
						</div>
					</div>
					<div class="section-block">
						<h1 class="section-title">USER RATINGS</h1>
						<span class="star-rating_user" style="font-size:2.5em;">
							<?php
								for ($i=1; $i<=$avg_rating; $i++) { 
									echo '<span class="fa fa-star"></span>';
								}
								for($i=5-($i-1); $i>=1; $i--)
									echo '<span class="fa fa-star-o"></span>';
							?>
						</span>
						<p><?php echo $avg_rating." average based on ".$comment_count; ?> reviews.</p>
						<strong>5 Star</strong>
						<div class="progress" style="height: 18px">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $star5*100/$comment_count;?>%; background-color:#4CAF50" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							</div>
						</div>
						<strong>4 Star</strong>
						<div class="progress" style="height: 18px">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $star4*100/$comment_count;?>%; background-color:#2196F3" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							</div>
						</div>
						<strong>3 Star</strong>
						<div class="progress" style="height: 18px">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $star3*100/$comment_count;?>%; background-color:#00bcd4" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							</div>
						</div>
						<strong>2 Star</strong>
						<div class="progress" style="height: 18px">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $star2*100/$comment_count;?>%; background-color:#ff9800" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							</div>
						</div>
						<strong>1 Star</strong>
						<div class="progress" style="height: 18px">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $star1*100/$comment_count;?>%; background-color:#f44336" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							</div>
						</div>
					</div>
					<div class="section-block">
						<h1 class="section-title">DONORS FOR THE PROJECT</h1>
						<!--reward blocks-->
						<?php
						while($row6 = mysqli_fetch_assoc($result6)){
							echo '<div class="reward-block">';
							foreach($row6 as $key => $val){
								if($key=='user_id'){
									$query5="select u.user_name from user u,donor d where d.user_id=u.user_id and d.user_id=".$val;
									$result5=mysqli_query($conn,$query5);
									$row5=mysqli_fetch_array($result5);
								}
								if($key=='donation_amount')
									echo '<h3>&#x20B9; '.$val.'</h3>';
								if($key=='donation_type'){
									if($val==1)
										echo '<h2 style="color:black">Anonymous</h2>';
									else
										echo '<h2 style="color:black">'.$row5['user_name'].'</h2>';
								}
							}
							echo "</div>";
						}
						?>	
						<!--/reward blocks-->
					</div>
				</div>
				<!--/sidebar-->
			</div>
		</div>
	</div>
	<!-- Global jQuery -->
	<script type="text/javascript" src="assets/js/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

	<!-- Template JS -->
	<script type="text/javascript" src="assets/js/main.js"></script>
	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Template Main Javascript File -->
 <!--  <script src="js/main.js"></script> -->
  <script type="text/javascript">
  	var $star_rating = $('.star-rating .fa');
  	var SetRatingStar = function() {
  		return $star_rating.each(function() {
  			if(parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
  				// set value of hidden attribute name=star-rating so that you can retrieve it in a php script
  				return $(this).removeClass('fa-star-o').addClass('fa-star');
  			} 
  			else {
  				return $(this).removeClass('fa-star').addClass('fa-star-o');
  			}
  		});
  	};

  	$star_rating.on('click', function() {
  		$star_rating.siblings('input.rating-value').val($(this).data('rating'));
  		return SetRatingStar();
  	});
  	SetRatingStar();

</script>
<script type="text/javascript">
var clicked=true;
$("#favourite").click(function(){
	if(clicked){
   		$(this).css('background-color','red');
    	    $.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data: {
        		favourite:"selected"
        	}        
    	}).done(function(data){
        	    //alert("success");
    	});
    	clicked  = false;
    }
    else {
        $(this).css('background-color', '#76e292');
        $.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data: {
        		favourite: "notselected"
        	}        
    	}).done(function(data){
        	    //alert("favourite deleted");
    	});
    	clicked  = true;
    }   
});

var liked=true;
var like_cnt=<?php echo $row1['project_likes']?>;
$("#like_button").click(function(){
	if(liked){
   		$(this).css('background-color','darkblue');
   		$("#like_count").text(like_cnt+1);
    	    $.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data:{like_check:"selected",cnt: like_cnt}        
    	}).done(function(data){
        	    //alert(data);
    	});
    	liked  = false;
    }
    else {
        $(this).css('background-color', '#337ab7');
        $("#like_count").text(like_cnt);
        $.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data: {
        		like_check: "notselected",
        		cnt:like_cnt,
        	},
    	}).done(function(data){
        	    //alert("like deleted");
    	});
    	liked  = true;
    }   
});
var reported=true;
var report_cnt=<?php echo $row1['project_reports']?>;
$("#report_button").click(function(){
	if(reported){
   		$(this).css('background-color','red');
   		$("#report_count").text(report_cnt+1);
    	    $.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data:{
        		report_check:"selected",
        		rcnt: report_cnt
        	}        
    	}).done(function(data){
        	    //alert(data);
    	});
    	reported  = false;
    }
    else {
        $(this).css('background-color', '#d9534f');
        $("#report_count").text(report_cnt);
        $.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data: {
        		report_check: "notselected",
        		rcnt:like_cnt
        	}
    	}).done(function(data){
        	    //alert("like deleted");
    	});
    	reported  = true;
    }   
});


$(document).ready(function(){
	$("#comment_button").click(function(){
		var text=$("#comment_data").val();
		var rate=$("#comment_rating").val();
		$.ajax({
        	url: 'modify.php',
        	type: 'POST',
        	data: {
        		comment_check: "selected",
        		text:text,
        		rate:rate,
        	}
    	}).done(function(data){
    		alert(data);
    		$("#comment_data").val('');
            $("#block").append(data);
    	});
	});
});
</script>
<?php include '../includes/layouts/page_footer.php';?>