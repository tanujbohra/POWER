<?php

//$errors = array();

$errors = array();

function fieldname_as_text($fieldname) {
    $fieldname = str_replace("_"," ",$fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;

}

//check if the value is entered or blank
function has_presence($value) {
    return isset($value) && $value !== "";
}

function validate_presence($required_fields,$error_type) {
    global $errors;

    foreach ($required_fields as $field) {
        $value = trim($_POST[$field]);
        if (!has_presence($value)) {
            $errors[$error_type][] = fieldname_as_text($field) . " can't be blank";
        }
    }
}

function has_max_length($value,$max) {
    return strlen($value) <= $max;
}

function validate_max_lengths($fields_with_max_lengths,$error_type) {
    global $errors;

    //Expects an assoc array
    foreach ($fields_with_max_lengths as $field => $max) {
        $value = trim($_POST[$field]);
        if (!has_max_length($value,$max)) {
            $errors[$error_type][] = fieldname_as_text($field) . " is too long";
        }
    }
}

function has_given_length($value,$length,$error_type) {
    global $errors;

    if (strlen($value) != $length) {
        $errors[$error_type][] = fieldname_as_text($error_type) . " must be {$length} digits";
    }
}

function check_if_numeric($value,$error_type) {
    global $errors;

    if (!is_numeric($value)) {
        $errors[$error_type][] = fieldname_as_text($error_type) . " must be numeric";
    }
}

function check_pan_format($value) {
    global $errors;

    if (!preg_match("/[^A-Z0-9]/",$value)) { //valid
    } else {
        $errors["pan"][] = "Enter proper PAN alphanumeric number";
    }
}

function is_valid_aadhaar($value,$required_fields) {
    validate_presence($required_fields,"aadhaar");
    check_if_numeric($value,"aadhaar");
    has_given_length($value,12,"aadhaar");
}

function is_valid_pan($value,$required_fields) {
    validate_presence($required_fields,"pan");
    has_given_length($value,10,"pan");
    check_pan_format($value);
}



function has_inclusion_in($value,$set) {
    return in_array($value,$set);
}

function form_errors($errors = array()) {
}

?>