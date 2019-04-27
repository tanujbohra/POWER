<?php include '../includes/layouts/header.php';?>

<?php
if (isset($_GET["project_id"])) { //project's id from project detail page
$project_id = $_GET["project_id"];

} else { //unauth access

  header("Location: index.php");
  exit;
  $project_id = 1;
}
?>

<head>
  <link rel="stylesheet" type="text/css" href="css/payment.css">
</head>
<body>
<div class="row" style="margin-top:50px;margin-bottom:60px">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form id="msform" method="post" action="charge.php">
            <fieldset>
                <h2 class="fs-title">Payment Details</h2>
                <h3 class="fs-subtitle">Donate as: </h3>
            <div class="form-check radio-pink-gap ">
            <input name="d_type" value="0" type="radio" class="with-gap" id="radio109">
            <label for="radio109">My User Name
            </label>
        </div>
        <div class="form-check radio-pink-gap">
            <input name="d_type" value="1" type="radio" class="with-gap" id="anon">
            <label for="radio110">Anonymous</label>
        </div>
                <input type="number" name="amount" placeholder="Amount" id="amount"/>
                     <script>
                     function myfun(){
                      if ((document.getElementById("amount").value>50000)&&(document.getElementById("anon").checked==true))
                                           {
                                          var urli= window.location.href;
                                          alert("Amount exceeds 50,000 therefore name cannot be anonymous");
                                          location.replace(urli); }
                      else if(document.getElementById("amount").value=="" || document.getElementById("amount").value==0)
                        {alert("Enter a valid amount");}
                      else
                      {
                          $(document).ready(function(){
                          $('.razorpay-payment-button').click();
                      });
                      }
                      }
                </script>
                <input type="text" name="project_id" value="<?php echo $project_id; ?>" hidden>
                 <input type="button" name="next" class="next action-button" value="Next" onclick="myfun()" />
            </fieldset>
            <fieldset>
              <h2>You Cancelled this Transaction</h2>
              <a href="payment.php"><h5>click here to go back</h5></a>
            </fieldset>
          <script
              src="https://checkout.razorpay.com/v1/checkout.js"
              data-key="rzp_test_bFaWlZJvZIqxI1"
              data-amount="5000";
              data-buttontext="Pay with Razorpay"
              data-name="P.O.W.E.R pay"
              data-description="Test donation"
              data-image="https://your-awesome-site.com/your_logo.jpg"
              data-prefill.name="Harshil Mathur"
              data-prefill.email="support@razorpay.com"
              data-theme.color="#F37254"></script>
          <input type="hidden" value="Hidden Element" name="hidden">
          </form>

    </div>
    <div class="col-md-3"></div>

</div>
<!-- /.MultiStep Form -->
<?php include '../includes/layouts/page_footer.php';
?>
