<?php
session_start();
if(!isset($_SESSION['valid_seesion_freelancer'])){
    header("Location: sign.php");
    exit();
}
?>

<?php

REQUIRE 'connection.php';


$sql = "SELECT * FROM `users` WHERE `user_id` = '{$_SESSION['user_id']}' ";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo "failed". mysqli_query_error();
}else{
$fetch = mysqli_fetch_assoc($result);
if(empty($fetch['other'])){
    $no_skills = 'no skills found for now';
}
}

if(isset($_POST['submit'])){
    $skills = $_POST['other'];
    $sql2 = "UPDATE users SET other = '$skills'";

    $result2 = mysqli_query($conn, $sql2);

    if(!$result2){
        echo "failed".mysqli_query_error();
    }else{
        header("Location: freelancerdashboard.php?msg= updated succefuly");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboardtrend.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/dashboardusers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/dashboardusers.js"></script>
    <title>PeoplePerTask</title>
</head>

<body>
    <div class="row">
        <div class="col-1" id="column1">
            <a href="#"><img id="logo" src="images/PeoplePerTask.png" alt="logo">
            </a>
            <div id="menu">
            <div id="home-container">
                    <a href="freelancerdashboard.php"><img src="images/material-symbols_home-rounded.svg" alt="Home">
                    </a>
                </div>
                <div class="menu-section">
                    <a href="skills.php"><img src="images/skills.png" alt="Edit">
                        <p class="menu-paragraph">Skills</p>
                    </a>
                </div>
                <div class="menu-section">
                    <a href="notifications.php"><img src="images/notification.png" alt="tredning">
                        <p class="menu-paragraph">Notifications</p>
                    </a>
                </div>
                <div class="line">
                </div>
                <div class="menu-section">
                    <a href="#"><img src="images/Vector.svg" alt="help"></a>
                </div>
                <div class="menu-section">
                    <a href="#"><img src="images/Vector2.svg" alt="settings"></a>
                </div>
            </div>
        </div>
        <div class="col-11" id="column2">
            <div id="nav-bar">
                <img id="menu-logo" style="height: 40px;" src="images/more.png" alt="menu">
                <div id="nav-bar-section2">
                    <img id="notification" src="images/carbon_notification-new.svg" alt="notification-icon">
                    <div id="profil">
                        <h1>Welcome back,<?= $_SESSION['user_name'] ?></h1>
                        <img src="images/profil.png" alt="profil-logo">
                        <?php
echo"<form class='d-flex nav_btn' role='search'>
<a href='logout.php'  class='btn btn-primary'>log out</a>
</form>";
?>
                    </div>
                </div>
            </div>
            
            <h1 class="users-header">ADD OR EDIT YOUR SKILLS:</h1>
            <div style="text-align:center;margin-top:100px;">
            <form action="" method="post" style='display:flex;flex-direction:column;align-items:center;'>
            <textarea style='width:30%;' name="other" id="other" cols="60" rows="10"><?= $fetch['other'] ?></textarea>
            <button style='width:10%;margin-top:50px;' name="submit" type="submit" class="btn btn-success">Success</button>
            </form>
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
    <script src="js/dashboardusers.js"></script>
    <script src="js/dashboardhome.js"></script>

</body>

</html>