<?php include './includes/config.php'; ?>
<?php

$queryMo  = "SELECT * FROM `model` WHERE `brand_id` = '{$_GET['brand_id']}'";
$resMo    = mysqli_query($con,$queryMo);
while($row   = mysqli_fetch_assoc($resMo))
{
	echo "<option value='{$row['model_id']}'>{$row['model_name']}</option>";
}


?>