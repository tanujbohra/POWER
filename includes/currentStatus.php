<?php //check if clicked on navigation

if (isset($_GET["subject"]) && isset($_GET["page"])) {
    $selected_subject_id = $_GET["subject"];
    $selected_page_id = $_GET["page"];
    $current_page = find_page_by_id($selected_page_id);
    $current_subject = find_subject_by_id($selected_subject_id);
}
else if (isset($_GET["subject"])) {
    $selected_subject_id = $_GET["subject"];
    $selected_page_id = null;
    $current_subject = find_subject_by_id($selected_subject_id);
    $current_page = null;
} else if (isset($_GET["page"])) {
    $selected_page_id = $_GET["page"];
    $selected_subject_id = null;
    $current_page = find_page_by_id($selected_page_id);
    $current_subject = null;
} else {
    $selected_page_id = null;
    $selected_subject_id = null;
    $current_page = null;
    $current_subject = null;
}

?>