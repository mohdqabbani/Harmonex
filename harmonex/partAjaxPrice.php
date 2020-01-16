<?php include './includes/config.php'; ?>

<?php


$queryRetAllPart   = " SELECT * FROM `changing_parts` WHERE `part_id` = '{$_GET['part_id']}'";
$resRetAllPart = mysqli_query($con, $queryRetAllPart);
$rowRetAllPart = mysqli_fetch_assoc($resRetAllPart) ;

echo "<option>{$rowRetAllPart['part_price']}</option>";

?>