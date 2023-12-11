<?php
require 'connection.php';

 if(isset($_GET['project_id'])){

    $project_id = $_GET['project_id'];
    
    $sql = "SELECT
    projects.project_id,
    projects.project_tittle,
    owners.user_name AS project_owner,
    projects.price,
    projects.descreption,
    subcategories.subcate_name,
    categories.category_name,
    IFNULL(freelancers.user_name, 'Not Assigned') AS freelancer_name,
    projects.creation_date
    FROM projects
    INNER JOIN categories ON categories.category_id = projects.category_id
    INNER JOIN subcategories ON subcategories.subcate_id = projects.subcate_id
    INNER JOIN users AS owners ON projects.user_id = owners.user_id
    LEFT JOIN users AS freelancers ON projects.freelancer_id = freelancers.user_id
    WHERE projects.project_id = '$project_id'

    
     ";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
    if(!$fetch || mysqli_num_rows($result)==0){
        echo "<h1 style='text-align:center;color:red;'>PROJECT DOESNT EXIST</h1>";
        exit();
    }

    $sql3 = "SELECT *  FROM `projects_tags`
    INNER JOIN `tags` ON projects_tags.tag_id = tags.tag_id
    WHERE `project_id` = '$project_id';
    ";
    $result8 = mysqli_query($conn, $sql3);                        
    if($result8){
         $tags_buttons = mysqli_fetch_all($result8 , MYSQLI_ASSOC);
    } else {
        $tags_buttons=[];
    }
      
    $sql2 = "SELECT
    user_name
    FROM freelancer_requests
    INNER JOIN users ON users.user_id = freelancer_requests.freelancer_id
    WHERE project_id = '$project_id';
     ";

    $result2 = mysqli_query($conn, $sql2);                        
    if($result2){
        $freelancers_buttons = mysqli_fetch_all($result2 , MYSQLI_ASSOC);
    } else {
        $tags_buttons=[];
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
    <div class="row" style="margin-top:20px;margin-bottom:20px;">
        <div class="col-3" id="column2" style="display:flex;flex-direction:column;align-items:flex-end;">
           
                <div
                    style="height:500px;background-color:#F9F6EE;width:85%;margin-right:30px;text-align:center;padding-top:20px;border-radius:10px">
                    <h3>freelancers_requests:</h3>
                    <?php
                    if(mysqli_num_rows($result2)==0){
                        echo "<h2 style='color:red;text-align:center;margin-top:30px;width:100%'>No Records</h2>" . "<h2 style='color:red;text-align:center;margin-top:10px;width:100%'>T_T</h2>";
                    }
                    ?>
                    <div class="freelnacers">
                        <?php foreach( $freelancers_buttons as $freelancer_button): ?>
                        <button
                            style='width:100px;height:fit-content;margin-top:10px;font-size:10px;border-radius:15px;'
                            type="button" class="btn btn-primary"><?= '#'.$freelancer_button['user_name'] ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
           
        </div>
        <div class="col-6" id="column2">
            <div style="display:flex;justify-content:center;">
                <div class='cards_container' style="display:flex;flex-wrap:wrap;height:auto; justify-content:center;">

                    <div class="card" style="width: 100%;background-color:#F9F6EE">
                        <img class="card-img-top" src="images/devweb.png" alt="Card image cap">
                        <div class="card-body"
                            style="display:flex;flex-wrap:wrap;align-items:center;gap:20px;justify-content:center;max-width:750px">
                            <h3 style="text-align:center;width:100%" class="card-title"><?= $fetch['project_tittle'] ?>
                                </h5>
                                <p style="font-size:20px;text-align:center;width:100%" class="card-text">
                                    <?= $fetch['descreption']  ?></p>
                                <h4 style="font-size:17px">owner: <?= $fetch['project_owner'] ?></h4>
                                <h4 style="font-size:17px">price: <?= '$' . $fetch['price'] ?></h4>
                                <h4 style="font-size:17px">category: <button style="width:100px"
                                        class="btn btn-primary"><?= $fetch['category_name'] ?></button></h4>
                                <h4 style="font-size:17px">subcategory: <button style="width:100px"
                                        class="btn btn-primary"><?= $fetch['subcate_name'] ?></button></h4>
                                <h4 style="font-size:17px">freelancer: <?= $fetch['freelancer_name'] ?></h4>
                                <h4 style="font-size:17px">creation_date: <?= $fetch['creation_date'] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3" id="column2">
            <div>
                <div
                    style="height:500px;background-color:#F9F6EE;width:80%;margin-left:30px;text-align:center;padding-top:20px;border-radius:10px">
                    <h3>Project tags:</h3>
                    <div class="tags" >
                        <?php foreach( $tags_buttons as $tag_button): ?>
                        <button
                            style='width:100px;height:fit-content;margin-top:10px;font-size:10px;border-radius:15px;'
                            type="button" class="btn btn-primary"><?= '#'.$tag_button['tag_name'] ?></button>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    if(mysqli_num_rows($result8)==0){
                        echo "<h2 style='color:red;text-align:center;margin-top:30px;width:100%'>No Records</h2>" . "<h2 style='color:red;text-align:center;margin-top:10px;width:100%'>T_T</h2>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dashboardhome.js"></script>
        <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</html>