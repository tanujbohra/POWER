<?php
error_reporting(0);
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function confirm_query($result_query) {
    if (!$result_query) { //test for any query error
        die("Database query failed - functions.");
    }
}

function generate_salt($length) {
    //MD5 returns 32 chars
    $unique_random_string = md5(uniqid(mt_rand(),true));

    //valid chars for salt are [a-zA-Z0-9./]
    $base64_string = base64_encode($unique_random_string);

    $modified_base64_string = str_replace('+','.',$base64_string);

    $salt = substr($modified_base64_string,0,$length);

    return $salt;
}

function password_encrypt($password) {
    $hash_format = "$2y$10$"; //tells php to use blowfish with a cost of 10
    $salt_length = 22; //blowfish salt should be 22 chars or more

    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash = crypt($password,$format_and_salt);

    return $hash;

}

function password_check($password,$hash_password) {
    $hash = crypt($password,$hash_password);
    if ($hash === $hash_password) {
        return true;
    }
    return false;
}

function mysql_prep($string) {
    global $conn;
    $escaped_string = mysqli_real_escape_string($conn,$string);
    return $escaped_string;
}

function is_visible($id,$subject=true) {
    global $conn;

    $table = $subject ? "subjects" : "pages";

    $query  = "SELECT * FROM {$table} WHERE id = {$id};";

    //echo $query;

    $result = mysqli_query($conn,$query);
    // echo "is_visible";
    confirm_query($result);

    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row["visible"]) {
                return true;
            } else {
                return false;
            }
        }
    }

    return false;
}

function generate_where_clause($category,$pref,$location) {
    $query  = "WHERE";
    $status = false;

    if (isset($category)) { //category exist
        $query .= " project_category like '{$category}'";
        $status = true;
    }
    if (isset($pref)) { //job|hire|all
        if ($status) {
            $query .= " AND";
        }
        if ($pref == "all") {
            $query .= " (project_people IS NOT NULL OR project_funds IS NOT NULL)";
        } else if ($pref == "job") {
            $query .= " project_people IS NOT NULL";
        } else if ($pref == "fund") {
            $query .= " project_funds IS NOT NULL";
        }
        $status = true;

    } if (isset($location)) { //location pref
        if ($status) {
            $query .= " AND";
        }
        $query .= " project_location like '{$location}'";
    }

    return $query;
}

function find_all_projects($category = null, $pref = null, $location = null) {
    global $conn;

    $query  = "SELECT * FROM project";
    if (isset($category) || isset($pref) || isset($location)) {
        $where_query = generate_where_clause($category,$pref,$location);
        $query .= " " . $where_query;
    }
    $query .= ";";

    $result = mysqli_query($conn,$query);
    // echo "find_all_projects";
    confirm_query($result);

    return $result;
}

//function find_project_by_category($category) {
//    global $conn;
//
//    $safe_category = mysql_prep($category);
//
//    $query  = "SELECT * ";
//    $query .= "FROM project ";
//    $query .= "WHERE project_category like '{$safe_category}';";
//
//    $result = mysqli_query($conn,$query);
//    confirm_query($result);
//
//    return $result;
//}

function find_featured_project($category = null, $pref = null, $location = null) {
    global $conn;

    $query  = "SELECT * FROM project";
    if (isset($category) || isset($pref) || isset($location)) {
        $where_query = generate_where_clause($category,$pref,$location);
        $query .= " " . $where_query;
    }
    $query .= ";";

    $result = mysqli_query($conn,$query);
    // echo "find_featured_project";
    confirm_query($result);

    $featured_project = null;
    $max = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($project_row = mysqli_fetch_assoc($result)) {
            if (isset($project_row["project_funds"])) { //project is fund type / both (priority to fund)
                $temp = (int) $project_row["project_funds_received"] / $project_row["project_funds"];
                if ($temp > $max) {
                    $max = $temp;
                    $featured_project = $project_row;
                }

            } else if (isset($project_row["project_people"])) { //project is hire type
                $temp = (int) $project_row["project_people_hired"] / $project_row["project_people"];
                if ($temp > $max) {
                    $max = $temp;
                    $featured_project = $project_row;
                }
            }
        }
    }
    return $featured_project; //row of featured project

}

function find_all_trending_projects($category = null, $pref = null, $location = null) {
    global $conn;

    $query  = "SELECT * FROM project";
    if (isset($category) || isset($pref) || isset($location)) {
        $where_query = generate_where_clause($category,$pref,$location);
        $query .= " " . $where_query;
    }
    $query .= " ORDER BY project_likes DESC";
    $query .= " LIMIT 5;";

    $result = mysqli_query($conn,$query);
    // echo "find_all_trending_projects";
    confirm_query($result);

    return $result;
}

function find_home_trending_projects($category = null, $pref = null, $location = null) {
    global $conn;

    // $query  = "SELECT * FROM project where project_status=1";
    // $query .= " ORDER BY project_likes DESC";
    // $query .= " LIMIT 3;";

    $query = "SELECT * FROM project";

    $result = mysqli_query($conn,$query);
    // echo "find_home_trending_projects";
    confirm_query($result);

    return $result;
}

function find_nearby_projects($user_location = null) {
    global $conn;

    $query  = "SELECT * FROM project";
    $query .= " WHERE project_location like '{$user_location}' and project_status=1";
    $query .= " LIMIT 3;";

    $result = mysqli_query($conn,$query);
    // echo "find_nearby_projects";
    confirm_query($result);

    return $result;
}

function make_organization_entry($id,$pan) {
    global  $conn;

    $pan_number = mysql_prep($pan["pan_number"]);
    $name = mysql_prep($pan["lname"]);
    $dob = mysql_prep($pan["dob"]);
    $address = mysql_prep($pan["flat_building"] . "," . $pan["road_street"] . "," . $pan["area_locality"]);
    $district = mysql_prep($pan["district"]);
    $pin_code = $pan["pincode"];
    $state = mysql_prep($pan["state"]);
    $image = mysql_prep($pan["image"]);
    $mobile_number=$pan["mobile_number"];


    $query  = "INSERT INTO organization (user_id, pan_number, org_name, date_of_formation, org_address, district, pincode, state, authenticity, image, mobile_number) VALUES(";
    $query .= "{$id},'{$pan_number}','{$name}','{$dob}','{$address}','{$district}',$pin_code,'{$state}','Y','{$image}','$mobile_number');";

    //testing
    //echo $query;

    $result = mysqli_query($conn,$query);
    // echo "make_organization_entry";
    confirm_query($result);

    return $result;
}

function make_individual_entry($id,$aadhaar) {
    global  $conn;
    $aadhaar_number = mysql_prep($aadhaar["aadhaar_number"]);
    $name = mysql_prep($aadhaar["name"]);
    $dob = mysql_prep($aadhaar["dob"]);
    $gender = mysql_prep($aadhaar["gender"]);
    $co = mysql_prep($aadhaar["co"]);
    $address = mysql_prep($aadhaar["house"] . "," . $aadhaar["street"] . "," . $aadhaar["landmark"] . ","
        . $aadhaar["lc"] . "," . $aadhaar["vtc"]);
    $sub_district = $aadhaar["subdist"];
    $district = mysql_prep($aadhaar["dist"]);
    $state = mysql_prep($aadhaar["state"]);
    $pin_code = $aadhaar["pc"];
    $image = mysql_prep($aadhaar["image"]);
    $mobile_number=$aadhaar["mobile_number"];

    echo $aadhaar_number;

    $query  = "INSERT INTO individual (user_id, aadhaar_number, individual_name, date_of_birth, gender, co, residential_address, sub_district, district, state, pincode, image, residential_authenticity, mobile_number) VALUES(";
    $query .= "{$id},'{$aadhaar_number}','{$name}','{$dob}','{$gender}','{$co}','{$address}','{$sub_district}','{$district}','{$state}',$pin_code,'{$image}','Y','$mobile_number');";

    //testing
    //echo $query;

    $result = mysqli_query($conn,$query);
    // echo "make_individual_entry";
    confirm_query($result);

    return $result;
}

function find_total_backers() {
    global $conn;

    $query  = "SELECT DISTINCT user_id FROM donor;";

    $result = mysqli_query($conn,$query);
    // echo "find_total_backers";
    confirm_query($result);

    $count = mysqli_num_rows($result);

    return $count;
}

function find_funded_project() {
    global $conn;

    $query  = "SELECT DISTINCT project_id FROM donor;";

    $result = mysqli_query($conn,$query);
    // echo "find_funded_project";
    confirm_query($result);

    $count = mysqli_num_rows($result);

    return $count;
}

function find_user_location($id,$type = 0) {
    global $conn;

    $query = "SELECT district ";
    if ($type == 1) { //org
        $query .= "FROM organization ";
    } else {
        $query .= "FROM individual ";
    }
    $query .= "WHERE user_id = {$id};";

    $result = mysqli_query($conn,$query);
    // echo "find_user_location";
    confirm_query($result);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row["district"];
    }
    return null;
}

function find_project_progress($project) {

    $progress = array();
    if (isset($project["project_funds"])) {
        $temp = ((int)$project["project_funds_received"] / $project["project_funds"] ) * 100;
        $progress[] = $temp;
    }
    if (isset($project["project_people"])) {
        $temp = ((int)$project["project_people_hired"] / $project["project_people"] ) * 100;
        $progress[] = $temp;
    }

    return $progress;
}

function find_project_by_id($id) {
    global $conn;

    $query="select * from project where project_id={$id}";
    if ($result=mysqli_query($conn,$query))
    {
        $row=mysqli_fetch_array($result);
    }
    return $row;
}

function get_project_type($project) {

    if ($project["project_funds"]==0)
    {
        return "people";
    }
    elseif ($project["project_people"]==0) {
        return "funds";
    }
    else
        return "both";
}

function get_donors($id){
    global $conn;

    $query="select * from donor where project_id={$id}";
    $result=mysqli_query($conn,$query);
}


function find_recommended_projects($id){
    global $conn;
    //$id=5;
    $category = array();

    $query="select * from favourite where user_id={$id}";
    $result=mysqli_query($conn,$query);

    while ($row=mysqli_fetch_assoc($result)) {
        $query1="select project_category from project where project_id={$row['project_id']}";
        $result1=mysqli_query($conn,$query1);

        $row1=mysqli_fetch_array($result1);
        $category[]=$row1['project_category'];
    }

    $category=array_unique($category);
    $recommended= array();
    for($i=0;$i<sizeof($category);$i++){
        $query="select * from project where project_category like '".$category[$i]."'";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_assoc($result)) {
            $recommended[]=$row;
        }
    }
    return $recommended;
}

function get_applicants_count($id){
    global $conn;
    $query="select * from applicant";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
}

function apply_for_work($user,$id){
    global $conn;
    $query="insert into applicants (user_id,project_id) values ({$user},{$id})";
    $result=mysqli_query($conn,$query);
    $data=1;
    return $data;
    /*redirect_to("../project_details.php?project={$id}")*/
}
?>
