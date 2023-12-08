<?php 
require 'connection.php';
session_start();
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if($result){
    $fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!$fetch){
        echo "we cant fetch for now !!!!?";
    }
}else{
    echo "failed" . mysqli_query_error();
}

$sql2 = "SELECT * FROM projects WHERE `user_id` = '{$_SESSION['user_id']}' ";
$result2 = mysqli_query($conn, $sql2);
if($result2){
    $fetch2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    if(!$fetch2){
        echo "we cant fetch for now !!!!?";
    }
}else{
    echo "failed" . mysqli_query_error();
}

if(isset($_POST['submit'])){

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .form-group {
        margin-bottom: 20px;
        font-size: 25px;
    }

    ;
    </style>
</head>

<body>
    <div id="container" style="display:flex;flex-direction:column;align-items:center;margin-top:130px;">
        <form method="post"
            style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;padding:70px;text-align:center;border-radius:10px">
            <select name="user_id" class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <?php foreach($fetch as $freelancer): ?>
                <option value="<?= $freelancer['user_id'] ?>"><?= $freelancer['user_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="project_id" class="form-select" aria-label="Default select example" style='margin-top:30px;margin-bottom:30px;'>
                <option selected>Open this select menu</option>
                <?php foreach($fetch2 as $project): ?>
                <option value="<?= $project['project_id'] ?>"><?= $project['project_tittle'] ?></option>
                <?php endforeach; ?>
            </select>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>