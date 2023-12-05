<?php
session_start();
if(!isset($_SESSION['valid_seesion'])){
    header("Location: loginadmin.php");
    exit();
}
?>

<?php
REQUIRE 'connection.php';
    $sql = "SELECT * , category_name , subcate_name , user_name FROM `projects` 
    INNER JOIN categories ON categories.category_id = projects.category_id 
    INNER JOIN subcategories ON subcategories.subcate_id = projects.subcate_id
    INNER JOIN users ON users.user_id = projects.user_id";

    $result = mysqli_query($conn, $sql);

    if($result){
        $users = mysqli_fetch_all($result , MYSQLI_ASSOC);
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
    <style>
        #userTable th:nth-child(3),
        #userTable td:nth-child(3) {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
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
                    <a href="dashboardtrend.php"><img src="images/fire3 1.png" alt="tredning">
                        <p class="menu-paragraph">Treding Offers</p>
                    </a>
                </div>
                <div class="menu-section">
                    <a href="crud.php"><img src="images/admin.png" alt="Edit">
                        <p class="menu-paragraph">Edit</p>
                    </a>
                </div>
                <div class="menu-section">
                    <a href="dashboardusers.php"><img src="images/group2 1.png" alt="Users">
                        <p class="menu-paragraph">Users</p>
                    </a>
                </div>
               <div class="menu-section">
                    <a href="stats.php"><img src="images/graph2 1.png" alt="Stats">
                        <p class="menu-paragraph">Stats</p>
                    </a>
                </div>
                <div class="menu-section">
                    <a href="projects.php"><img src="images/project.png" alt="project">
                        <p class="menu-paragraph">projects</p>
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
            <h1 class="users-header">All Projects:</h1>
            <a href="addproject.php">
                <div style="text-align:end;width:93%;margin-top:100px">
                    <button type="button" class="btn btn-primary">ADD A project</button>
                </div>
            </a>

            <div id="table-container" style="margin:50px;">
                <table id="userTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>project id</th>
                            <th>tittle</th>
                            <th>descreption</th>
                            <th>category</th>
                            <th>subcate_name</th>
                            <th>user_name</th>
                            <th>price</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['project_id']; ?></td>
                            <td><?= $user['project_tittle']; ?></td>
                            <td><?= $user['descreption']; ?></td>
                            <td><?= $user['category_name']; ?></td>
                            <td><?= $user['subcate_name']; ?></td>
                            <td><?= $user['user_name']; ?></td>
                            <td><?= $user['price']; ?></td>
                            <td>
                                <a href="deleteproject.php?deleteid=<?=$user['project_id']?>"><button type="button"
                                        class="btn btn-danger"
                                         >delete</button></a>
                                        <a
                                        href="updateproject.php?project_id=<?=$user['project_id']?>&project_tittle=<?=$user['project_tittle']?>&descreption=<?=$user['descreption']?>&price=<?=$user['price']?>"
                                         ><button
                                        type="button" class="btn btn-info">edit</button></a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
    <script src="js/dashboardusers.js"></script>
    <script src="js/dashboardhome.js"></script>

</body>

</html>