<?php include './includes/config.php'; ?>
<?php
ob_start();
$queryReturnAllModel  = " SELECT * FROM `model` WHERE `brand_id` = '{$_GET['brand_id']}'";
$resultReturnAllModel = mysqli_query($con, $queryReturnAllModel);
echo "<option></option>";
while ($rowReturnAllModel    = mysqli_fetch_assoc($resultReturnAllModel))
{  
echo "<option value='{$rowReturnAllModel['model_id']}'>{$rowReturnAllModel['model_name']}</option>";
}
?>