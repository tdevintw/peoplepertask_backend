<?php
session_start();
if(!isset($_SESSION['valid_seesion'])){
    header("Location: loginadmin.php");
    exit();
}
?>

<?php
REQUIRE 'connection.php';

if(isset($_POST['submit'])){
    $fname = $_POST['name'];
    $upassword = $_POST['password'];
    $uemail= $_POST['email'];
    $role = $_POST['role'];
    $other = $_POST['other'];

    $fname2 = htmlspecialchars($fname);
    $upassword2 = htmlspecialchars($upassword);
    $uemail2 = htmlspecialchars($uemail);
    $other2 = htmlspecialchars($other);

    $hash_password = password_hash($upassword2, PASSWORD_BCRYPT);

    $sql = "INSERT INTO `users`(`user_id`,`user_name`,`password`,`email`,`other`,`role`)
    VALUES (NULL,'$fname2','$hash_password','$uemail2','$other2','$role')";

    $result = mysqli_query($conn , $sql);
    if($result){
        header("Location: crud.php?msg=NEW RECORD CREATED SUCCESFULY");
    }
    else{
        echo "Failed" . mysqli_connect_error();
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
    <link rel="stylesheet" href="css/crud.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Users</title>
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
            <div class="crud_inner">
                <h2>Add User</h2>
                <div class="crud_form">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" placeholder="user name" id="name" name="name">
                        </div>
                        <div>
                            <label for="password">password:</label>
                            <input type="password" placeholder="password" id="password" name="password">
                        </div>
                        <div>
                            <label for="email">email</label>
                            <input type="email" placeholder="email" id="email" name="email">
                        </div>
                        <div>
                            <label for="other"">other</label>
                        <input type=" text" placeholder="other informations" id="other" name="other">
                        </div>
                        <div style="width:20%;">
                            <select name="role" id="role" class="form-select" aria-label="Default select example">
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                                <option value="freelancer">freelancer</option>  
                            </select>
                        </div>
                        <div class="form_submit">
                            <button type="submit" name="submit" id="submit">Submit</button>
                            <button onclick="cancelSubmit">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>