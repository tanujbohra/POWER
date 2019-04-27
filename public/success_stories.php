<html>
<style>
.card {
  box-shadow: 0 4% 8% 0 rgba(0, 0, 0, 0.2);
  text-align: center;
  font-family: arial;

}

.title1 {
  color: grey;
  font-size: 18px;
}

.card img{
	width: 100%;
	height: 100%;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>


<?php include '../includes/layouts/header.php';?>

<?php
$i=0;
$j=0;
$query1="SELECT sum(donation_amount) as high,user_id FROM donor GROUP BY user_id ORDER BY high DESC ";
$result1=mysqli_query($conn,$query1);
//echo mysqli_num_rows($result);
while($row1=mysqli_fetch_assoc($result1)){

	$query2="SELECT * FROM user where user_id='".$row1['user_id']."'";
	$result2=mysqli_query($conn,$query2);
	while($row2=mysqli_fetch_assoc($result2)){
		if($row2['type']==0)
	{	
		$query3="SELECT image,individual_name FROM individual where user_id='".$row2['user_id']."' LIMIT 3";
		$result3=mysqli_query($conn,$query3);
		$row3=mysqli_fetch_assoc($result3);
		$indi_img[$i]=$row3['image'];
		$indi_name[$i]=$row3['individual_name'];
		$indi_email[$i]=$row2['email'];
		$indi_contri[$i]=$row1['high'];
		$i++;
	}
	else if($row2['type']==1)
	{	
		$query3="SELECT image,org_name FROM organization where user_id='".$row2['user_id']."' LIMIT 3";
		$result3=mysqli_query($conn,$query3);
		$row3=mysqli_fetch_assoc($result3);
		$org_img[$j]=$row3['image'];
		$org_name[$j]=$row3['org_name'];
		$org_email[$j]=$row2['email'];
		$org_contri[$j]=$row1['high'];
		$j++;

	}
}
}
?>



    <div class="container">
        <div class="mt-5 text-truncate">
           <center> <h1 class="title text-truncate" style="color:#2bd172"><b>SUCCESS STORIES</b></h1></center>
        </div>
        <HR>
        <h3>TOP INDIVIDUAL CONTRIBUTORS</h3>
        <hr>
        <div class=row>
        <?php 
        for($k=0;$k<$i&&$k<3;$k++){
        	?>
        <div class="col-md-4" style="height:250px;">
                        <div class="about-col border rounded">
                            <div class="card">
					  <img src="UploadsImages/Individuals/<?php echo $indi_img[$k]?>" alt="John" style="width:100%">
					  <h1><?php echo $indi_name[$k]?></h1>
					  <h5 style="color:#2bd172"><b>TOTAL DONATION: ₹<?php echo $indi_contri[$k]?></b></h5>
					  <p class="title1">E-mail: <?php echo $indi_email[$k]?></p>
					 <p><button>Contact</button></p>
					</div>
					   </div>
         </div>
         <?php
         }
         ?>
 
         <div style="margin-top:250px">
         <HR>
         <h3>TOP ORGANIZATION CONTRIBUTORS</h3>
         <hr>

        <?php 
        for($k=0;$k<$j&&$k<3;$k++){
        	?>
        <div class="col-md-4" style="height:250px;">
                        <div class="about-col border rounded">
                            <div class="card">
					  <img src="UploadsImages/Organization/<?php echo $org_img[$k]?>" alt="John" style="width:100%">
					  <h1><?php echo $org_name[$k]?></h1>
					  <h5 style="color:#2bd172"><b>TOTAL DONATION: ₹<?php echo $org_contri[$k]?></b></h5>
					  <p>E-mail: <?php echo $org_email[$k]?></p>
					 <p><button>Contact</button></p>
					</div>
					   </div>
         </div>
         <?php
         }
         ?>

         </div>
         </div>
         </div>
</html>
