<?php
session_start();
if(!isset($_SESSION['valid_seesion_freelancer'])){
    header("Location: sign.php");
    exit();
}
?>

<?php

        REQUIRE 'connection.php';

        $sql = " SELECT * FROM   skills";

        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo "failed".mysqli_query_error();
        }else{
        $fetch_skills = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

          //fecth skills 
           $sql3 = "SELECT  `skill_name`  FROM freelancers_skills INNER JOIN skills ON skills.skill_id = freelancers_skills.skill_id WHERE freelancer_id = {$_SESSION['user_id']}";
          $result3 = mysqli_query($conn, $sql3);
          if(mysqli_num_rows($result3)==0){
            $no_record = 'no skills added yet';
          }
          if(!$result3){
              echo "failed".mysqli_query_error();
          }else{
                    $freelancer_skills = mysqli_fetch_all($result3, MYSQLI_ASSOC);
          }
            

        //add skill to profile
        if(isset($_POST['submit'])){

            $skill_id = $_POST['skill_id'];
            $freelancer_id = $_SESSION['user_id'];
            $sql_error = "SELECT * FROM freelancers_skills WHERE freelancer_id= '$freelancer_id ' AND skill_id = '$skill_id'";
            $sql_error_result = mysqli_query($conn , $sql_error);
            if(!$sql_error_result){
                echo "failed". mysqli_query_error();
            }else{
                $sql_error_fetch = mysqli_fetch_assoc($sql_error_result);
            }
            if(mysqli_num_rows($sql_error_result)!=0){
                $error = 'skill already add to your profile';
            }
            else{
            $sql2 = "INSERT INTO freelancers_skills (`freelancer_id`,`skill_id`)
            VALUES ('$freelancer_id','$skill_id')";

            $result2 = mysqli_query($conn, $sql2);

            if(!$result2){
                echo "failed".mysqli_query_error();
            }
            header("Location: skills.php");
        }
    }


    if(isset($_POST['submit2'])){

        $add_skill = $_POST['add_skill'];

        $sql7 = "INSERT INTO skills (`skill_name`)
        VALUES ('$add_skill')";

        $result7 = mysqli_query($conn, $sql7);

        if(!$result7){
            echo "failed".mysqli_query_error();
        }
        header("Location: skills.php");
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
                    <a href="dashboard.php"><img src="images/material-symbols_home-rounded.svg" alt="Home">
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

            <form action="" method="post"
                style="margin-top:100px;margin-bottom:100px;display:flex;justify-content:flex-end;gap:20px;align-items:center;">
                <?php
                if(isset($error)){
                    echo "<h2 style='color:red;font-size:15px;'>".$error."</h2>";
                }
                ?>

                <select name="skill_id" style="width:20%; " class="form-select" aria-label="Default select example">
                    <option selected>ADD SKILL</option>
                    <?php foreach( $fetch_skills as $fetch_skill): ?>
                    <option value="<?= $fetch_skill['skill_id'] ?>"><?= $fetch_skill['skill_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button style="padding-left:25px;padding-right:25px;" name="submit" type="submit"
                    class="btn btn-success">Add</button>
            </form>
            <h1 style="text-align:center;color:blue;margin-bottom:50px;">YOU SKILLS:</h1>
            <div style="display:flex;justify-content:center;">
                <div
                    style="height:auto;width:60%;background-color:#F9F6EE;display:flex;flex-wrap:wrap;gap:10px;padding:30px;border-radius:10px">
                    <?php 
                            if(isset($no_record)){
                                echo "<h2 style='color:blue;text-align:center;width:100%'>". $no_record . "</h2>";
                            }
                            ?>
                    <div>
                        <?php foreach( $freelancer_skills as $fetch_skill): ?>
                        <button style='width:250px;height:fit-content;margin-top:10px;' type="button"
                            class="btn btn-primary"><?= $fetch_skill['skill_name'] ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
            <div
                style="display:flex;align-items:center;justify-content:center;margin-top:50px;margin-bottom:50px;gap:20px;align-items:center;">
                <h3 style="font-size:20px;">can't find you skills?! add it now to the list:</h3>
                <form action="" method="post" style="display:flex;gap:10px">
                    <input name="add_skill" type="text">
                    <button name="submit2" type="submit" class="btn btn-success">add skill</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
    <script src="js/dashboardusers.js"></script>
    <script src="js/dashboardhome.js"></script>

</body>

</html>