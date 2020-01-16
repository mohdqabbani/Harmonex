<?php
include './includes/config.php';

$querySubM = "SELECT * FROM `sub_model` WHERE `model_id` = '{$_GET['subModel']}'";
$resSubM   = mysqli_query($con, $querySubM);
echo '<option></option>';
while($rowSubM = mysqli_fetch_assoc($resSubM))
{
    echo "<option value='{$rowSubM['sub_id']}'>{$rowSubM['sub_name']}</option>";
}
?>