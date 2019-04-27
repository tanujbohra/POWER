<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$this_transaction=$_SESSION['this_transaction'];
$amount=$_SESSION['amount'];
// $this_transaction="pay_9sJIN84mgisvqw";
// $amount=50;

// print_r($_SESSION);
// Create connection
$conn = mysqli_connect($servername, $username, $password,"power");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}
// $user_id=1;
$current_user = $_SESSION["current_user"];
$user_id = $current_user["user_id"];

 $query="SELECT * FROM transaction WHERE razorpay='".$this_transaction."'";
 $result=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){

require('fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'P.O.W.E.R DONATIONS',0,0);
$pdf->Cell(59 ,5,'RECEIPT',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'JVPD Scheme, Bhaktivedanta Swami Marg',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Mumbai, India, 400056',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$row['time'],0,1);//end of line

$pdf->Cell(130 ,5,'Phone +91 22 4233 5000',0,0);
$pdf->Cell(25 ,5,'Invoice #',0,0);
$pdf->Cell(34 ,5,$row['transaction_id'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line
}

$query="SELECT * FROM transaction t, user u, project p WHERE u.user_id=t.user_id AND t.project_id=p.project_id AND t.razorpay='".$this_transaction."'";
 $result=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){
     $name=$row['user_name'];
     $email=$row['email'];
     $project=$row['project_title'];
//billing address
$pdf->Cell(100 ,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$name,0,1);



// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,'[Address]',0,1);

// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,'[Phone]',0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Project Name',1,0);
//$pdf->Cell(25 ,5,'Amount',1,0);
$pdf->Cell(34 ,5,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130 ,5,$project,1,0);
//$pdf->Cell(25 ,5,$amount,1,0);
$pdf->Cell(8 ,5,'Rs.',1,0);
$pdf->Cell(26 ,5,$amount,1,1,'R');;//end of line
}
// $pdf->Cell(130 ,5,'Supaclean Diswasher',1,0);
// $pdf->Cell(25 ,5,'-',1,0);
// $pdf->Cell(34 ,5,'1,200',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'Something Else',1,0);
// $pdf->Cell(25 ,5,'-',1,0);
// $pdf->Cell(34 ,5,'1,000',1,1,'R');//end of line

// //summary
// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Subtotal',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'4,450',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Taxable',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'0',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Tax Rate',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'10%',1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Total Due',0,0);
//end of line

$pdf->Output("donation_receipt.pdf","D");

session_unset("this_transaction");
session_unset("amount");
?>