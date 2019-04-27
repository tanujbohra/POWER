<?php include '../includes/functions.php'; ?>
<?php include '../includes/layouts/header.php';?>

<?php

if (isset($_POST["login"])) { //login
    $email = mysql_prep($_POST["email"]);
    $password = $_POST["password"];

    $query  = "SELECT * ";
    $query .= "FROM user ";
    $query .= "WHERE email like '{$email}';";

    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) == 1) {
        $user_list = mysqli_fetch_assoc($result);
        $hash_password = $user_list["password"];

        if (password_check($password,$hash_password)) { //valid user
            //TODO: get user details from respective table
            $_SESSION["message"] = "Welcome, " . $user_list["email"];
            $_SESSION["current_user"] = $user_list;
            redirect_to("index.php");
        } else { //invalid password
            $errors["login_user"][] = "Email or password is incorrect";
            $_SESSION["errors"] = $errors;
            redirect_to("login_page.php");

        }
    } else { //invalid email
        $errors["login_user"][] = "Email or password is incorrect";
        $_SESSION["errors"] = $errors;
        redirect_to("login_page.php");
    }

}

?>

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
        <!-- Forms starts here -->
        <div class="row mb-3 mt-4">
            <div class="col-lg-4"></div>
            <!-- Login area -->
            <div class="col-lg-4">
                <!-- login form goes here -->
                    <div class="p-5" style="background-color:#ecebeb;">
                        <form action="login_page.php" method="post">
                            <h3 class="text-center"><b>Login</b></h3>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary form-control mt-2" style="background-color:#76e292;border:1px solid #76e292;">LOGIN</button>
                        </form>
                        <label class="mt-2" for="emapleRegister">Not a user yet? <a href="register.php">register here</a></label>
                    </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </main>
<?php include '../includes/layouts/page_footer.php';?>