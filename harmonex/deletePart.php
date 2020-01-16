<?php include './includes/config.php'; ?>
<?php
ob_start();
$partid3 = $_GET['id'];


$queryDeletePart     = "DELETE FROM `changing_parts` WHERE `part_id` = '$partid3'";

mysqli_query($con, $queryDeletePart);

header("Location: manageMaintenance.php");

exit();


?>