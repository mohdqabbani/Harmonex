<?php include './includes/config.php';?>
<?php
ob_start();

$queryRetAllPart   = "SELECT * FROM `changing_parts` INNER JOIN `sub_model`"
        . " WHERE sub_model.sub_id= changing_parts.Sub_id AND changing_parts.Sub_id = '{$_GET['modelN']}'";
$resRetAlPart = mysqli_query($con, $queryRetAllPart);
while($rowRetAllPart = mysqli_fetch_assoc($resRetAlPart))
{
    echo "<tr style='outline: thin solid;' >";
    echo "<td style='outline: thin solid;'>{$rowRetAllPart['part_name_en']}</td>";
     echo "<td style='outline: thin solid;'>{$rowRetAllPart['part_name_ar']}</td>";
    echo "<td style='color:red;'>{$rowRetAllPart['part_price']}</td>";
    echo "</tr>";
}


?>