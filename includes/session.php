<?php session_start();?>
<?php
function message() {
    if (isset($_SESSION["message"])) {
        $mssg = htmlentities($_SESSION["message"]);

        //clear message after use
        $_SESSION["message"] = null;
        return $mssg;
    } else {
        return null;
    }
}

function errors() {
    if (isset($_SESSION["errors"])) {
        $errors = $_SESSION["errors"];

        //clear message after use
        $_SESSION["errors"] = null;
        return $errors;
    } else {
        return null;
    }
}


?>
