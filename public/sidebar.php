<?php include '../includes/session.php'; ?>
<?php include '../includes/connect.php'; ?>
<?php include '../includes/functions.php'; ?>

<?php

//get current user from session
$current_user = $_SESSION["current_user"];
$user_id = $current_user["user_id"];
$num_users = null;

//select all users except logged in
$query = "SELECT * FROM user WHERE user_id <> {$user_id};";
$result = mysqli_query($conn,$query);

if (!$result) { //test for any query error
    die("Database query failed.");
}

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $num_users = mysqli_num_rows($result);
} else {
    $num_users = 0;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>P.O.W.E.R</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="sidebar_style.css">
</head>
<body>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Inbox</h3>
            <p>Start chatting</p>
        </div>

        <ul class="list-unstyled components" style="max-height:500px;overflow:auto;">

            <p>All users</p>
                <?php //display all users for chat
                if ($num_users == 0) {
                    echo "<li><a href=\"#\">O users found</a></li>";
                } else {
                    while ($user_row = mysqli_fetch_assoc($result)) {
                        ?>
                        <li><a href="sidebar.php?chatWith=<?php echo $user_row["user_id"]; ?>"><?php echo $user_row["user_name"]; ?></a></li>
                <?php
                    }
                }
                ?>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content" style="width: 100%;">

        <nav class="navbar navbar-default">
            <div class="row container-fluid">

                <div class="col-sm-6 navbar-header mr-5" style="float:left;">
                    <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                        <i class="glyphicon glyphicon-align-left"></i>
                    </button>
                </div>

                <div class="col-sm-6 text-right" id="bs-example-navbar-collapse-1" style="width: 200px;float:right;">
                    <h3>Inbox</h3>
                </div>
            </div>
        </nav>

        <?php //handle when clicked on a user in sidebar
        $chatWith = null;
        if (isset($_GET["chatWith"])) {
            $chatWith = mysql_prep($_GET["chatWith"]);
        }

        if (isset($chatWith)) {
            $other_query = "SELECT * FROM user WHERE user_id = {$chatWith};";
            $other_result = mysqli_query($conn,$other_query);

            if (!$other_result) { //test for any query error
                die("Database query failed.");
            }
            if (mysqli_num_rows($other_result) == 1) { //user exist
                $other_user = mysqli_fetch_assoc($other_result);

                //echo "<script>alert(\"" . print_r($other_user) . "\")</script>";

                $other_id = $chatWith;
                $other_name = $other_user["user_name"];
                $other_email = $other_user["email"];
                $other_photoUrl = "https://talkjs.com/docs/img/george.jpg";
                $other_welcomeMessage = "Start a chat";
            } else {
                $chatWith = null;
            }
        }

        if (!isset($chatWith)) { //by default admin
            $other_id = "0";
            $other_name = "admin";
            $other_email = "admin@power.com";
            $other_photoUrl = "https://talkjs.com/docs/img/george.jpg";
            $other_welcomeMessage = "Chat with our admin";
        }

        ?>

        <script>
            (function(t,a,l,k,j,s){
                s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.getElementsByTagName('head')[0].appendChild(s);k=t.Promise;
                t.Talk={ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l.push([f])},catch:function(){return k&&new k()},c:l}};
            })(window,document,[]);
        </script>
        <div id="talkjs-container" style="width: calc(100% - 60px); margin: 30px; min-height: 150px"></div>
        <script>
            Talk.ready.then(function() {
                /*var me = new Talk.User({
                    id: "12345",
                    name: "George Looney",
                    email: "george@looney.net",
                    photoUrl: "https://talkjs.com/docs/img/george.jpg",
                    welcomeMessage: "Hey there! How are you? :-)"
                });
*/
                //after integrating session
                var me = new Talk.User({
                   id: "<?php echo $current_user["user_id"]; ?>",
                   name: "<?php echo $current_user["user_name"]; ?>",
                   email: "<?php echo $current_user["email"]; ?>",
                   photoUrl: "https://talkjs.com/docs/img/ronald.jpg",
                   welcomeMessage: "Start a chat"
                });
                window.talkSession = new Talk.Session({
                    appId: "tAR0FyZ0",
                    me: me
                });
                // var other = new Talk.User({
                //     id: "54321",
                //     name: "Ronald Raygun",
                //     email: "ronald@teflon.com",
                //     photoUrl: "https://talkjs.com/docs/img/ronald.jpg",
                //     welcomeMessage: "Hey, how can I help?"
                // });
                var other = new Talk.User({
                    id: "<?php echo $other_id; ?>",
                    name: "<?php echo $other_name; ?>",
                    email: "<?php echo $other_email; ?>",
                    photoUrl: "<?php echo $other_photoUrl; ?>",
                    welcomeMessage: "<?php echo $other_welcomeMessage; ?>"
                });

                var conversation = talkSession.getOrCreateConversation(Talk.oneOnOneId(me, other));
                conversation.setParticipant(me);
                conversation.setParticipant(other);
                var inbox = talkSession.createInbox({selected: conversation});
                inbox.mount(document.getElementById("talkjs-container"));
            });
        </script>

    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>
</html>
