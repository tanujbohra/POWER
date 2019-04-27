<?php include '../includes/functions.php'; ?>
<?php include '../includes/layouts/header.php';?>

    <main class="p-3 mb-5" id="main" style="margin-top:10px;">
        <div class="container">
            <?php //error message
            if ($errors = errors()) {
                ?>
                <ul class="list-group">
                    <?php
                    foreach ($errors as $value) {
                        foreach ($value as $val) {
                            echo "<li class=\"list-group-item list-group-item-danger\">" . $val . "</li>";
                        }
                    }
                    ?>
                </ul>
                <?php
            }
            ?>

            <?php //other messages
            if ($message = message()) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?> </div>
                <?php
            }
            ?>

        </div>



        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <h1 class="text-center">Registration</h1>
<!--                    <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p>-->
                        <div class="container">Register as an?</div>
                    <ul class="nav nav-tabs">
                        <li class="p-1 m-2 text-center" style="background-color:#76e292;width:44%;"><a class="p-2" data-toggle="tab" href="#home1" style="color:white;">Individual</a></li>
                        <li class="p-1 m-2 text-center" style="background-color:#76e292;width:44%;"><a class="p-2" data-toggle="tab" href="#menu1" style="color:white;">Organization</a></li>
                    </ul>


                    <div class="tab-content p-2">
                        <div id="home1" class="tab-pane fade in active">
<!--                            <h3>HOME</h3>-->
<!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
                            <div class="p-5" style="background-color:#ecebeb;">
                                <form action="otp_form.php" method="post">
                                    <h5 class="text-center"><b>Individual</b></h5>
                                    <div class="form-group">
                                        <label for="exampleInputUIN1">Aadhaar Card Number</label>
                                        <input type="text" name="UIN" class="form-control" id="exampleInputUIN1" aria-describedby="emailHelp" placeholder="Enter Aadhaar Number">
                                        <small id="emailHelp" class="form-text text-muted">
                                            We'll never share your Aadhaar with anyone else.<br>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNumber1">Mobile Number</label>
                                        <input type="tel" name="mobile_number" class="form-control" id="exampleInputNumber1" placeholder="Mobile number">
                                        <small id="emailHelp" class="form-text text-muted">Provide the same number used in Aadhaar</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="is_organization" class="form-check-input" id="exampleCheck1" value="0" hidden>
                                    </div>
                                    <button type="submit" name="OTP" class="btn btn-primary form-control mt-2" style="background-color:#76e292;border:1px solid #76e292;">Request OTP</button>
                                    <ul class="nav nav-tabs">
                                        <li class="mt-1">Don't have an Aadhaar? <a class="" data-toggle="tab" href="#menu5">click here.</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
<!--                            <h3>Menu 1</h3>-->
<!--                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
                            <div class="p-5" style="background-color:#ecebeb;">
                                <form action="otp_form.php" method="post">
                                    <h5 class="text-center"><b>Organization</b></h5>

                                    <div class="form-group">
                                        <label for="exampleInputUIN1">Pan Card Number</label>
                                        <input type="text" name="UIN" class="form-control" id="exampleInputUIN1" aria-describedby="emailHelp" placeholder="Enter pan Number">
                                        <small id="emailHelp" class="form-text text-muted">
                                            We'll never share your PAN with anyone else.<br>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNumber1">Mobile Number</label>
                                        <input type="tel" name="mobile_number" class="form-control" id="exampleInputNumber1" placeholder="Mobile number">
                                        <small id="emailHelp" class="form-text text-muted">Provide the same number used in PAN card</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="is_organization" class="form-check-input" id="exampleCheck1" value="1" hidden>
                                    </div>
                                    <button type="submit" name="OTP" class="btn btn-primary form-control mt-2" style="background-color:#76e292;border:1px solid #76e292;">Request OTP</button>
                                </form>
                            </div>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <!--                            <h3>Menu 1</h3>-->
                            <!--                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
                            <div class="p-5" style="background-color:#ecebeb;">
                                <form action="" method="post">
                                    <h5 class="text-center"><b>Individual PAN</b></h5>

                                    <div class="form-group">
                                        <label for="exampleInputUIN1">Pan Card Number</label>
                                        <input type="text" name="UIN" class="form-control" id="exampleInputUIN1" aria-describedby="emailHelp" placeholder="Enter pan Number">
                                        <small id="emailHelp" class="form-text text-muted">
                                            We'll never share your PAN with anyone else.<br>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputNumber1">Mobile Number</label>
                                        <input type="tel" name="mobile_number" class="form-control" id="exampleInputNumber1" placeholder="Mobile number">
                                        <small id="emailHelp" class="form-text text-muted">Provide the same number used in PAN card</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="is_organization" class="form-check-input" id="exampleCheck1" value="1" hidden>
                                    </div>
                                    <button type="submit" name="OTP" class="btn btn-primary form-control mt-2" style="background-color:#76e292;border:1px solid #76e292;">Request OTP</button>
                                    <ul class="nav nav-tabs">
                                        <li class="mt-1"><a class="" data-toggle="tab" href="#home1">back to Aadhaar</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </main>
<?php include '../includes/layouts/page_footer.php';?>