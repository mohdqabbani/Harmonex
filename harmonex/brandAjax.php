<?php include './includes/config.php'; ?>
<?php
ob_start();
$queryNameBrand = "SELECT * FROM `brand`";
$resNameBrand = mysqli_query($con, $queryNameBrand);

while ($rowNameBrand = mysqli_fetch_assoc($resNameBrand)) {
    echo "<option value='{$rowNameBrand['brand_id']}'>{$rowNameBrand['brand_name']}</option>";
    
}


?>
