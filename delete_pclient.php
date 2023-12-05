<?php
session_start();
if(!isset($_SESSION['valid_seesion_client'])){
    header("Location: sign.php?acces denied!!!!");
    exit();
}
?>

<?php
REQUIRE 'connection.php';


if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM projects WHERE project_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: clientdashboard.php?msg=PROJECT DELETED SUCCESSFULLY");
    } else {
        echo "Failed to delete PROJECT: " . mysqli_query_error();
    }
} 
?>
