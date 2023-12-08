<?php
session_start();
if(!isset($_SESSION['valid_seesion']) & !isset($_SESSION['valid_seesion_client']) & !isset($_SESSION['valid_seesion_freelancer'])){
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
?>
<?php
    $user_id = $_SESSION['user_id'];
    $sql2 = "SELECT * , category_name , subcate_name , user_name FROM `projects` 
    INNER JOIN categories ON categories.category_id = projects.category_id 
    INNER JOIN subcategories ON subcategories.subcate_id = projects.subcate_id
    INNER JOIN users ON users.user_id = projects.user_id
    WHERE projects.user_id = '$user_id' ";

    $result2 = mysqli_query($conn, $sql2);

    if($result2){
        $users = mysqli_fetch_all($result2 , MYSQLI_ASSOC);
    } else {
        $users=[];
    }
?>
<?php
if(isset($_GET['msg'])){
    if($_GET['msg']=='PROJECT DELETED SUCCESSFULLY'){
    echo "<script>alert('project deleted succefuly')</script>";
    }else if($_GET['msg']=='UPDATED SUCCEFULY'){
        echo "<script>alert('project updated succefuly')</script>";

    }
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
                    <a href='dashboardtrend.php'><img src='images/fire3 1.png' alt='tredning'>
                        <p class='menu-paragraph'>Treding Offers</p>
                    </a>
                </div>
                <div class='menu-section'>
                    <a href='crud.php'><img src='images/admin.png' alt='Edit'>
                        <p class='menu-paragraph'>Edit</p>
                    </a>
                </div>
                <div class='menu-section'>
                    <a href='dashboardusers.php'><img src='images/group2 1.png' alt='Users'>
                        <p class='menu-paragraph'>Users</p>
                    </a>
                </div>
                <div class='menu-section'>
                    <a href='stats.php'><img src='images/graph2 1.png' alt='Stats'>
                        <p class='menu-paragraph'>Stats</p>
                    </a>
                </div>
                <div class='menu-section'>
                    <a href='projects.php'><img src='images/project.png' alt='project'>
                        <p class='menu-paragraph'>projects</p>
                    </a>
                </div>
                <div class='menu-section'>
                                <a href='tags.php'><img src='images/tags.png' alt='tags'>
                                    <p class='menu-paragraph'>Tags</p>
                                </a>
                            </div>
                ";}
            ?>



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


                <?php if($_SESSION['role']=='freelancer'){ echo"
                                                <div id='home-container'>
                                                <a href='dashboard.php'><img src='images/material-symbols_home-rounded.svg' alt='Home'>
                                                </a>
                                            </div>
                                            <div class='menu-section'>
                                                <a href='skills.php'><img src='images/skills.png' alt='Edit'>
                                                    <p class='menu-paragraph'>Skills</p>
                                                </a>
                                            </div>
                                            <div class='menu-section'>
                                                <a href='notifications.php'><img src='images/notification.png' alt='tredning'>
                                                    <p class='menu-paragraph'>Notifications</p>
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
                        <?php
echo"<form class='d-flex nav_btn' role='search'>
<a href='logout.php'  class='btn btn-primary'>log out</a>
</form>";
?>
                    </div>
                </div>
            </div>
            <?php if($_SESSION['role']=='admin'){ echo"
            <div id='content'>
                <div class='cards'>
                    <!-- <div class='time'>
<h2>Last 7 Days</h2>
<img src='images/Polygon 4.svg' alt='down-arrow'>
</div> -->
                    <div class='cards-content'>
                        <div class='card'>
                            <h3>total clients</h3>
                            <div class='card-bottom'>
                                <h5>480</h5>
                                <img src='images/ic1.png' alt='icon1'>
                            </div>
                        </div>
                        <div class='card'>
                            <h3>Successfuly delivered</h3>
                            <div class='card-bottom'>
                                <h5>300</h5>
                                <img src='images/ic3.svg' alt='icone2'>
                            </div>
                        </div>
                        <div class='card'>
                            <h3>Pending</h3>
                            <div class='card-bottom'>
                                <h5>102</h5>
                                <img src='images/ic4.svg' alt='ic3'>
                            </div>
                        </div>
                        <div class='card'>
                            <h3>Failed</h3>
                            <div class='card-bottom'>
                                <h5>10</h5>
                                <img src='images/ic5.svg' alt='ic4'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row' id='mid-content'>
                    <div class='col-6' id='clients-stats'>
                        <div id='header'>
                            <h3>Clients stats</h3>
                            <div
                                style='background-color: white;padding-left: 10px;padding-right: 10px;padding-top: 3px;padding-bottom: 5px;border-radius: 10px;'>
                                <!-- <div class='time'>
<h2>Last 7 Days</h2>
<img src='images/Polygon 4.svg' alt='down-arrow'>
</div> -->
                            </div>
                        </div>
                        <div id='chart'></div>

                    </div>
                    <div class='col-6' id='trend-projects'>
                        <div id='header2'>
                            <h3>Trending projects</h3>
                        </div>
                        <div id='trend-header'>
                            <h3>category</h3>
                            <h3>succes rate %</h3>
                        </div>
                        <div id='trend-content'>
                            <div class='trend-stats'>
                                <h3>AI artists</h3>
                                <h3>99%</h3>
                            </div>
                            <div class='trend-line'></div>
                            <div class='trend-stats'>
                                <h3>Logo Design</h3>
                                <h3>95%</h3>
                            </div>
                            <div class='trend-line'></div>
                            <div class='trend-stats'>
                                <h3>WordPress</h3>
                                <h3>94%</h3>
                            </div>
                            <div class='trend-line'></div>
                            <div class='trend-stats'>
                                <h3>Voice Over</h3>
                                <h3>92%</h3>
                            </div>
                            <div class='trend-line'></div>
                            <div class='trend-stats'>
                                <h3>SEO</h3>
                                <h3>90%</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='bottom-content'>
                    <h3>Top Freelancers</h3>
                    <div id='table'>
                        <div>
                            <h2>freelancer</h2>
                            <h3>omar</h3>
                            <h3>nour</h3>
                            <h3>fahed</h3>
                        </div>
                        <div>
                            <h2>join date</h2>
                            <h3>05/03/2023</h3>
                            <h3>22/02/2023</h3>
                            <h3>02/05/2023</h3>
                        </div>
                        <div id='catego'>
                            <h2>Category</h2>
                            <h3>front-end</h3>
                            <h3>back-end</h3>
                            <h3>mobile games</h3>
                        </div>
                        <div id='total'>
                            <h2>total clients</h2>
                            <h3>102</h3>
                            <h3>105</h3>
                            <h3>90</h3>
                        </div>
                        <div id='earn'>
                            <h2>total earning</h2>
                            <h3>3000$</h3>
                            <h3>3100$</h3>
                            <h3>2900$</h3>
                        </div>
                        <div id='sati'>
                            <h2>satisfaction rate</h2>
                            <h3>98%</h3>
                            <h3>95%</h3>
                            <h3>94%</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ";}?>

            <?php if($_SESSION['role']=='freelancer'){
                                            //     <h1 class='users-header' style='text-align:center;margin-top:100px;'>YOUR SKILLS:</h1>";
                                            //         if(isset($no_skills)){
                                            //         echo "<h2 style='color:red;text-align:center;margin-top:100px;'>$no_skills</h2>"; 
                                            //         echo "<div style='text-align:center;margin-top:50px;'><a href='skills.php'><button type='button' class='btn btn-primary'>add you first skills now</button></a></div>";
                                            //         exit();
                                            //                         };
               
                                            //      echo "<h2 style='text-align:center;font-size:1.5rem;margin-top:100px'>{$fetch['other']}</h2>
                                            // ";
                                               }
                                             ?>


            <?php if($_SESSION['role']=='user'){ echo"
                                      <h1 class='users-header' style='text-align:center'>My Projects:</h1>
                                      <h2 style='text-align:center;margin-top:100px'>You have <span
                                              style='color:blue'>". mysqli_num_rows($result). "</span> Projects</h2>
                                      
                                        <div style='display:flex;justify-content:end;width:%;gap:20px;'>
                                        
                                    
                                      <a href='add_pclient.php?user_id={$user_id}'>
                                          <div>
                                              <button type='button' class='btn btn-primary'>ADD A project</button>
                                          </div>
                                      </a> 
                                      </div>
                                      <div id='table-container' style='margin:50px;'>
                                          <table id='userTable' class='table table-striped' style='width:100%'>
                                              <thead>
                                                  <tr>
                                                      <th>project id</th>
                                                      <th>tittle</th>
                                                      <th>descreption</th>
                                                      <th>category</th>
                                                      <th>subcate_name</th>
                                                      <th>user_name</th>
                                                      <th>price</th>
                                                      <th>freelancer_id</th>
                                                      <th>edit</th>
                                                      <th>hire freelancer</th>
                                                  </tr>
                                              </thead>
                                              <tbody>";
                                                  foreach($users as $user): 
                                                echo "
                                                  <tr>
                                                      <td>{$user['project_id']}</td>
                                                      <td>{$user['project_tittle']}</td>
                                                      <td>{$user['descreption']}</td>
                                                      <td>{$user['category_name']}</td>
                                                      <td>{$user['subcate_name']}</td>
                                                      <td>{$user['user_name']}</td>
                                                      <td>{$user['price']}</td>
                                                      <td>{$user['freelancer_id']}</td>
                                                      <td>
                                                          <a href='delete_pclient.php?deleteid={$user['project_id']}'><button type='button'
                                                                  class='btn btn-danger'
                                                                  onclick='return confirm('Are you sure you want to delete this user?')'>delete</button></a>
                                                          <a
                                                              href='update_pclient.php?project_id={$user['project_id']}'><button
                                                                  type='button' class='btn btn-info'>edit</button></a>
                                                      </td>
                                                      <td><a href='hire.php?project_id={$user['project_id']}'><button type='button' class='btn btn-success'>see proposals</button></td>
                                                  </tr>
                                                  ";
                                                  endforeach;
                                            echo "

                                              </tbody>
                                          </table>
                                      </div> 
                ";
            }
            if(isset($_GET['msg']) && isset($_GET['request_id'])){
            if($_GET['msg']='accepted'){
            $sql5 = "UPDATE `freelancer_requests` 
                     SET `status` = 'completed'
                     WHERE `request_id` = {$_GET['request_id']}";
            $result5 = mysqli_query($conn, $sql5);
            if(!$result5){
                echo "failed" .mysqli_query_error();
            }
            $sql6 = "UPDATE `projects` 
            SET `freelancer_id` = {$_GET['freelancer_id']}
            WHERE `project_id` = {$_GET['project_id']}";
                $result6 = mysqli_query($conn, $sql6);
                if(!$result6){
                    echo "failed" .mysqli_query_error();
                }
            }
            }
            ?>

            <script src="js/bootstrap.min.js"></script>
            <script src="js/dashboardhome.js"></script>
            <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</html>