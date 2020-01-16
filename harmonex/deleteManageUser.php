<?php include './includes/config.php'; ?>
<?php
ob_start();

$admin_id  = $_GET['id'];
$query     = "DELETE FROM `admin` WHERE `admin_id` = $admin_id";
$result    = mysqli_query($con, $query);
header("Location: manageUser.php");
exit();


?>