<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Widget Corp</h3>
        <h4>Admin</h4>
    </div>

    <!--list start-->
    <ul class="list-unstyled components">
<!--        <p>Site Content</p>-->

        <ul class="list-unstyled components">
            <li><a href="admin.php">&larr; Main menu</a></li>
        </ul>

        <?php //get all the subjects
        $result = find_all_subjects();

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($subject_list = mysqli_fetch_assoc($result)) {
                ?>
                <?php //li tag with active function
                $statement  = "<li  ";
                if ($selected_subject_id == $subject_list["id"]) {
                    $statement .= "class=\"active\"";
                }
                $statement .= ">";
                echo $statement;
                ?>
                <a href="<?php echo "#" . "{$subject_list["id"]}";?>" data-toggle="collapse" aria-expanded="false">
                    <?php echo $subject_list["menu_name"]; ?>
                </a>
                <ul class="collapse list-unstyled" id="<?php echo "{$subject_list["id"]}";?>">
                    <li>
                        <a href="manage_content.php?subject=<?php echo urlencode($subject_list["id"]);?>">
                            About</a>
                    </li>
                    <?php //get all the pages
                    $result_pages = find_pages_for_subject($subject_list["id"]);

                    if (mysqli_num_rows($result_pages) > 0) {
                        // output data of each row
                        while ($page_list = mysqli_fetch_assoc($result_pages)) {
                            ?>
                            <li>
                                <a href="manage_content.php?page=<?php echo urlencode($page_list["id"])."&subject=".urlencode($subject_list["id"]);?>">
                                    <?php echo $page_list["menu_name"]; ?>
                                </a>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
                <?php mysqli_free_result($result_pages); //release the reults ?>
                </li>
            <?php }
        }
        ?>
    </ul>
    <?php mysqli_free_result($result); //release the reults ?>

    <!--            <ul class="list-unstyled components">-->
    <!--                <p>Dummy Heading</p>-->
    <!--                <li>-->
    <!--                    <a href="#mySubj" data-toggle="collapse" aria-expanded="false">About Widget Corp</a>-->
    <!--                    <ul class="collapse list-unstyled" id="mySubj">-->
    <!--                        <li><a href="#">Our Mission</a></li>-->
    <!--                        <li><a href="#">Our History</a></li>-->
    <!--                    </ul>-->
    <!--                </li>-->
    <!--                <li class="active">-->
    <!--                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>-->
    <!--                    <ul class="collapse list-unstyled" id="homeSubmenu">-->
    <!--                        <li><a href="#">Home 1</a></li>-->
    <!--                        <li><a href="#">Home 2</a></li>-->
    <!--                        <li><a href="#">Home 3</a></li>-->
    <!--                    </ul>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <a href="#">About</a>-->
    <!--                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>-->
    <!--                    <ul class="collapse list-unstyled" id="pageSubmenu">-->
    <!--                        <li><a href="#">Page 1</a></li>-->
    <!--                        <li><a href="#">Page 2</a></li>-->
    <!--                        <li><a href="#">Page 3</a></li>-->
    <!--                    </ul>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <a href="#">Portfolio</a>-->
    <!--                </li>-->
    <!--                <li>-->
    <!--                    <a href="#">Contact</a>-->
    <!--                </li>-->
    <!--            </ul>-->

    <?php //add option to add a new subject
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array); //current page
    
    if ($page === "manage_content.php") {
        ?>
    <ul class="list-unstyled components">
        <li><a href="new_subject.php">+ Add a subject</a></li>
    </ul>
    <?php
    }
    ?>

    <ul class="list-unstyled CTAs">
        <li><a href="index.php" class="download">Public Page</a></li>
    </ul>

</nav>