<?php include './includes/config.php'; ?>
<?php
ob_start();

$brandID            = $_GET['id'];
$quertDeleteBrand   = "DELETE FROM `brand` WHERE `brand_id` = '$brandID'";
mysqli_query($con, $quertDeleteBrand);
header("Location: manageBrand.php");
exit();

?>