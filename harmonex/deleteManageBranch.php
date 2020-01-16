<?php include './includes/config.php'; ?>
<?php
ob_start();

$branch_id = $_GET['id'];
$query     = "DELETE FROM `branch` WHERE `branch_id` = $branch_id";
$result    = mysqli_query($con, $query);
header("Location: manageBranch.php");
exit();
?>