<?php
session_start();
if(!isset($_SESSION['valid_seesion'])){
    header("Location: sign.php");
    exit();
}
?>
<?php

REQUIRE 'connection.php';

        $sql = "SELECT *  FROM `tags` ";

        $result = mysqli_query($conn, $sql);

        if($result){
            $tags = mysqli_fetch_all($result , MYSQLI_ASSOC);
        } else {
            $tags=[];
        }

        
    if(isset($_POST['submit'])){

        $add_tag = $_POST['add_tag'];

        $sql = "INSERT INTO tags (`tag_name`)
        VALUES ('$add_tag')";

        $result= mysqli_query($conn, $sql);

        if(!$result){
            echo "failed".mysqli_query_error();
        }
        header("Location: tags.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>PeoplePerTask</title>
</head>

<body>
    <div class="row">
        <div class="col-1" id="column1">
            <a href="#"><img id="logo" src="images/PeoplePerTask.png" alt="logo">
            </a>
            <div id="menu">

                <?php if($_SESSION['role']=='admin'){ echo"
                                <div id='home-container'>
                                <a href='dashboard.php'><img src='images/material-symbols_home-rounded.svg' alt='Home'>
                                </a>
                            </div>
                            <div class='menu-section'>
                                <a href='tags.php'><img src='images/tags.png' alt='tags'>
                                    <p class='menu-paragraph'>Tags</p>
                                </a>
                            </div>
                ";
            }
            ?>
            

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
                        <?php echo"<form class='d-flex nav_btn' role='search'>
<a href='logout.php'  class='btn btn-primary'>log out</a>
</form>"; ?>
                    </div>
                </div>
                
            </div>
            <div style="display:flex;justify-content:center;">
            <?php echo "
            <table id='userTable' class='table table-striped' style='width:40%;text-align:center;'>
                                                                <thead>
                                                                    <tr>
                                                                        <th>tag id</th>
                                                                        <th>tag name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>";
                                                                    foreach($tags as $tag): 
                                                                    echo "
                                                                    <tr>
                                                                        <td>{$tag['tag_id']}</td>
                                                                        <td>{$tag['tag_name']}</td>
                                                                    </tr>
                                                                    ";
                                                                    endforeach;
                                                                echo "

                                                                </tbody>
                                                            </table>";

                        ?>
                        </div>
                        <div
                style="display:flex;align-items:center;justify-content:center;margin-top:50px;margin-bottom:50px;gap:20px;align-items:center;">
                <h3 style="font-size:20px;">add a tag to the list:</h3>
                <form action="" method="post" style="display:flex;gap:10px">
                    <input name="add_tag" type="text">
                    <button name="submit" type="submit" class="btn btn-success">add tag</button>
                </form>
            </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dashboardhome.js"></script>
        <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</html>

