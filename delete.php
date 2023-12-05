<?php
session_start();
if(!isset($_SESSION['valid_seesion'])){
    header("Location: loginadmin.php");
    exit();
}
?>

<?php
REQUIRE 'connection.php';


if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM users WHERE user_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: dashboardusers.php?msg=USER DELETED SUCCESSFULLY");
    } else {
        echo "Failed to delete user: " . mysqli_query_error();
    }
} 
?>
