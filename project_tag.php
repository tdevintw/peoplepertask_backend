<?php
session_start();
if(!isset($_SESSION['valid_seesion_client'])){
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

        
        $sql2 = "SELECT *  FROM `projects` WHERE `user_id`={$_SESSION['user_id']}";

        $result2 = mysqli_query($conn, $sql2);

        if($result2){
            $projects = mysqli_fetch_all($result2 , MYSQLI_ASSOC);
        } else {
            $projects=[];
        }


        
    if(isset($_POST['submit'])){

        $tag_id = $_POST['tag_id'];
        $project_id = $_POST['project_id'];

        $sql3 = "INSERT INTO projects_tags (`project_id`, `tag_id`)
        VALUES ('$project_id', '$tag_id')";

        $result3= mysqli_query($conn, $sql3);

        if(!$result3){
            echo "failed".mysqli_query_error();
        }
        header("Location: project_tag.php");
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

                <?php if($_SESSION['role']=='user'){ echo"
                                <div id='home-container'>
                                <a href='dashboard.php'><img src='images/material-symbols_home-rounded.svg' alt='Home'>
                                </a>
                            </div>
                            <div class='menu-section'>
                                <a href='project_tag.php'><img src='images/tags.png' alt='tags'>
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
            <form action="" method="post"
                style="margin-top:100px;margin-bottom:100px;display:flex;justify-content:center;gap:20px;align-items:center;">
                <select name="project_id" style="width:20%; " class="form-select" aria-label="Default select example">
                    <option selected>choose project</option>
                    <?php foreach( $projects as $project): ?>
                    <option value="<?= $project['project_id'] ?>"><?= $project['project_tittle'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="tag_id" style="width:20%; " class="form-select" aria-label="Default select example">
                    <option selected>choose tag</option>
                    <?php foreach( $tags as $tag): ?>
                    <option value="<?= $tag['tag_id'] ?>"><?= $tag['tag_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button style="padding-left:25px;padding-right:25px;" name="submit" type="submit"
                    class="btn btn-success">Add</button>
            </form>
            <div style="display:flex;justify-content:center;">
                <div class='cards_container' style="display:flex;flex-wrap:wrap;height:auto; justify-content:center;">
                    <?php foreach( $projects as $project): ?>
                    <div class="card" style="width: 400px;height:auto;row-gap:0;">
                        <img class="card-img-top" src="images/devweb.png" alt="Card image cap">
                        <div class="card-body" style="background-color:#F9F6EE">
                            <h5 class="card-title"><?= $project['project_tittle'] ?></h5>
                            <p class="card-text"><?= $project['descreption'] ?></p>
                            <a href="#" class="btn btn-primary">details</a>
                            <?php
                                    $sql3 = "SELECT *  FROM `projects_tags`
                                    INNER JOIN `tags` ON projects_tags.tag_id = tags.tag_id
                                    WHERE `project_id` = {$project['project_id']};
                                    ";
                            
                                    $result8 = mysqli_query($conn, $sql3);
                            
                                    if($result8){
                                        $tags_buttons = mysqli_fetch_all($result8 , MYSQLI_ASSOC);
                                    } else {
                                        $tags_buttons=[];
                                    }
                            
                            
                            ?> 
                            <div class="tags">
                                <?php foreach( $tags_buttons as $tags_button): ?>
                                <button style='width:100px;height:fit-content;margin-top:10px;font-size:10px;border-radius:15px;' type="button"
                                    class="btn btn-primary"><?= '#'.$tags_button['tag_name'] ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dashboardhome.js"></script>
        <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</html>