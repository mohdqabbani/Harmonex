<?php  ob_start();
include './includes/config.php'; ?>

<?php
ob_start();

$idBr   = $_GET['id'];
$queryDeleteModel  = " DELETE FROM `model` WHERE `model_id` = '$idBr'";
mysqli_query($con, $queryDeleteModel);
header("Location: manageModel.php");
exit();
?>