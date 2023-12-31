<?php
session_start();
if(!isset($_SESSION['valid_seesion_freelancer']) ){
    header("Location: sign.php");
    exit();
}
?>
<?php

REQUIRE 'connection.php';

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `freelancer_requests` 
    WHERE `freelancer_id` = '$user_id' AND  `status` = 'completed'" ;

    $result = mysqli_query($conn, $sql);

    if($result){
        $users = mysqli_fetch_all($result , MYSQLI_ASSOC);
    } else {
        $users=[];
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
    <h1 style="text-align:center;margin-top:100px;">you have <span style="color:blue;"><?= mysqli_num_rows($result)?></span> accepted proposal</h1>
    <div class="row">

        <div class="col-12" id="column2">
            <?php if($_SESSION['role']=='freelancer'){ echo"
                                      <div id='table-container' style='margin:50px;'>
                                          <table id='userTable' class='table table-striped' style='width:100%'>
                                              <thead>
                                                  <tr>
                                                      <th>request_id</th>
                                                      <th>project_id</th>
                                                      <th>freelance_id</th>
                                                      <th>message</th>
                                                  </tr>
                                              </thead>
                                              <tbody>";
                                                  foreach($users as $user): 
                                                echo "
                                                  <tr>
                                                      <td>{$user['request_id']}</td>
                                                      <td>{$user['project_id']}</td>
                                                      <td>{$user['freelancer_id']}</td>
                                                      <td>{$user['message']}</td>
                                                  </tr>
                                                  ";
                                                  endforeach;
                                            echo "

                                              </tbody>
                                          </table>
                                      </div> 
                ";
            }
            ?>

            <script src="js/bootstrap.min.js"></script>
            <script src="js/dashboardhome.js"></script>
            <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</html>