<?php include './includes/config.php'; ?>
<?php
ob_start();

$queryDelSub  = "DELETE FROM `sub_model` WHERE `sub_id` = '{$_GET['sub_id']}'";
mysqli_query($con, $queryDelSub);
header("Location: manageSubModel.php");
exit();

?>