<?php
session_start();
if(!isset($_SESSION['valid_seesion_freelancer'])){
    header("Location: sign.php");
    exit();
}
?>

<?php

REQUIRE 'connection.php';
$project_id = $_GET['project_id'];
$sql2 = "SELECT * FROM `freelancer_requests` WHERE `freelancer_id`={$_SESSION['user_id']} AND `project_id`='$project_id'";
$result2 = mysqli_query($conn, $sql2);

if($result2){
    if(mysqli_num_rows($result2)!=0){
        header("Location:  index.php?msg=you have already make a proposal to this project");
    }
}else{
    echo "failed" .mysqli_query_error();
}

if(isset($_POST['submit'])){
    
    $message = $_POST['message'];
    $freelancer_id = $_SESSION['user_id'];

    $sql = "INSERT INTO freelancer_requests (`project_id`,`freelancer_id`,`message`)
    VALUES ('$project_id','$freelancer_id','$message')
    ";
        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo "failed".mysqli_query_error();
        }else{
            header("Location: index.php?msg=message had been sent");
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
</head>

<body>
    <div class="row">
        <div class="col-12" id="column2">
            <h1 class="users-header">send a message to the client:</h1>
            <div style="text-align:center;margin-top:50px;">
                <form action="" method="post" style='display:flex;flex-direction:column;align-items:center;'>
                    <textarea style='width:30%;' name="message" id="other" cols="60" rows="10"></textarea>
                    <button style='width:10%;margin-top:50px;' name="submit" type="submit"
                        class="btn btn-success">Send</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/e80051e55f.js" crossorigin="anonymous"></script>
    <script src="js/dashboardusers.js"></script>
    <script src="js/dashboardhome.js"></script>

</body>

</html>