<?php
session_start();
if(!isset($_SESSION['valid_seesion'])){
    header("Location: loginadmin.php");
    exit();
}
?>

<?php
REQUIRE 'connection.php';

if(isset($_GET['project_id'])){
   $get_id =  $_GET['project_id'];
   $get_tittle = $_GET['project_tittle'];
   $get_descreption = $_GET['descreption'];
   $get_price = $_GET['price'];
}
if(isset($_POST['submit'])){
    $tittle = $_POST['project_tittle'];
    $descreption = $_POST['descreption'];
    $price = $_POST['price'];
    $subcate_id = $_POST['subcate_id'];
    $category_id = $_POST['cate_id'];

    $tittle2 = htmlspecialchars($tittle);
    $descreption2 = htmlspecialchars($descreption);
    $price2 = htmlspecialchars($price);
    $subcate_id2 = htmlspecialchars($subcate_id);
    $category_id2 = htmlspecialchars($category_id);

    $sql = "UPDATE projects SET `project_tittle`='$tittle2' , `descreption`='$descreption2', `price`='$price2', `subcate_id`= '$subcate_id2' , `category_id`= '$category_id2' WHERE `project_id`='$get_id' ";
    $result = mysqli_query($conn , $sql);
    if($result){
        header("Location: projects.php?msg=UPDATED SUCCEFULY");
    }
    else {
        echo "FAILED". mysqli_connect_error();   
     }
}

$sql2 = "SELECT `category_id`, `category_name` FROM `categories`";
$result2 = mysqli_query($conn, $sql2);

if($result2){
    $categories = mysqli_fetch_all($result2, MYSQLI_ASSOC);
} else {
    $categories=[];
}
$sql3 = "SELECT `subcate_id` , `subcate_name` FROM `subcategories`";
$result3 = mysqli_query($conn, $sql3);
if(!$result3){
    $subcates=[];
}
else{
    $subcates = mysqli_fetch_all($result3, MYSQLI_ASSOC);
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
                <h2>Update project</h2>
                <div class="crud_form">
                    <form action="" method="post">
                        <div>
                            <label for="project_tittle">tittle:</label>
                            <input type="text" value="<?= $get_tittle?>" id="project_tittle" name="project_tittle">
                        </div>
                        <div>
                            <label for="descreption">descreption</label>
                            <input type="text" value="<?= $get_descreption?>" id="descreption" name="descreption">
                        </div>
                        <div>
                            <label for="price">price</label>
                            <input type="text" value="<?= $get_price?>" id="price" name="price">
                        </div>
                        <div>
                            <label for="cate_id">category</label>
                            <select name="cate_id" id="cate_id" class="form-select" aria-label="Default select example">
                                <?php foreach($categories as $category): ?>
                                <option value="<?=$category['category_id']?>"><?= $category['category_name']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div>
                        <label for="subcate_id">subcategory</label>
                            <select name="subcate_id" id="subcate_id" class="form-select" aria-label="Default select example">
                                <?php foreach($subcates as $subcate):?>
                                <option value="<?=$subcate['subcate_id']?>"><?=$subcate['subcate_name'];?></option>
                                <?php endforeach;?>
                            </select>

                        </div>
                        <div class="form_submit">
                            <button type="submit" name="submit" id="submit">Submit</button>
                            <button>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>