<?php include '../includes/session.php'; ?>
<?php include '../includes/connect.php'; ?>
<?php include '../includes/functions.php'; ?>
<?php include '../includes/validation_functions.php'; ?>

<?php

if (!isset($_POST["submit"])) { //unauth access
    redirect_to("login_page.php");
}

$email = mysql_prep($_POST["email"]);
$password = password_encrypt($_POST["password"]);
$type = (int)$_SESSION["type"];

//validation
$required_fields = array("email","password","confirm_password");
validate_presence($required_fields,"Login");

$fields_with_max_lengths = array("email" => 60);
validate_max_lengths($fields_with_max_lengths,"Login");

if ($_POST["password"] !== $_POST["confirm_password"]) {
    $errors["Login"][] = "Confirm password and password don't match";
}
if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["retry_otp_submit"] = 1;
    redirect_to("user_registration.php");
}


$personal_details = $_SESSION["result_list_array"];

if ($type == 1)  {
    $user_name = $personal_details["lname"];
} else {
    $user_name = $personal_details["name"];
}
//check username already exist

//check gov db to check if the user is valid

$query  = "SELECT * ";
$query .= "FROM user ";
$query .= "WHERE email like '{$email}';";

$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
    $errors["Login"][] = "Email already taken";
    $_SESSION["errors"] = $errors;
    $_SESSION["retry_otp_submit"] = 1;
    redirect_to("user_registration.php");

} else {
    $insert_query  = "INSERT INTO user (email, password, type, status, user_name) VALUES(";
    $insert_query .= "'{$email}','{$password}',{$type},0,'{$user_name}');";

    $insert_result = mysqli_query($conn,$insert_query);

    if ($insert_result) { //success
        //TODO: Enter user details into respective database type 1 : 0

        $user_query = "SELECT * FROM user WHERE email like '{$email}';";
        $user_result = mysqli_query($conn,$user_query);

        if (mysqli_num_rows($user_result) == 1) {
            $current_user = mysqli_fetch_assoc($user_result);
            if ($current_user["type"] == 1) { //organization
                //push values into org table
                $org = $_SESSION["result_list_array"];

                $org_insert_result = make_organization_entry($current_user["user_id"],$org);

                if ($org_insert_result) { //successful insert into org
                    $_SESSION["current_user"] = $current_user;
                    $_SESSION["otp"] = null;

                    redirect_to("index.php");
                }

            } else { //individual
                //push values into ind table
                $ind = $_SESSION["result_list_array"];

                $ind_insert_result = make_individual_entry($current_user["user_id"],$ind);

                if ($ind_insert_result) { //successful insert into ind
                    $_SESSION["current_user"] = $current_user;
                    $_SESSION["otp"] = null;

                    redirect_to("index.php");
                }
            }

        } else {
            echo "user db error";
        }


        echo "USER SUCCESSFULLY ADDED";

    } else {
        echo "DB INSERT FAILURE";
    }
}

?>

<?php mysqli_close($conn); ?>