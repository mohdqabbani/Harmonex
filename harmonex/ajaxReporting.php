<?php include './includes/config.php'; ?>
<?php
//AND invoice.device_status = '$status'
$dateRep = date("Y/m/d");
//$status = $_GET['deStatus'];
$queryRe = "SELECT * FROM `invoice` INNER JOIN customer ON invoice.cus_id = customer.cus_id "
        . "AND customer.branch_id ='{$_GET['brName']}' AND entry_date = '$dateRep'  AND `device_status` = 'Done'   ORDER BY entry_date DESC ";
$resRe = mysqli_query($con, $queryRe);
if(!empty($resRe))
{
while ($rowRe = mysqli_fetch_assoc($resRe)) {
    
    echo "<tr>";
    echo "<td style='font-size: 10px;'>{$rowRe['invoice_number']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['cus_name']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['device_type']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['device_problem']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['device_note']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['entry_date']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['entry_time']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['finish_main_date']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['finish_main_time']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['bill_date']}</td>";
    echo "<td style='font-size: 10px;'>{$rowRe['bill_time']}</td>";
    if($rowRe['hidden_price'] == 0)
    {echo "<td>Cancel</td>";}else{echo "<td>{$rowRe['device_status']}</td>";}
    echo "<td>{$rowRe['hidden_price']}</td>";
    
    echo "</tr>";
   
}
$cusCreateDate = date("Y-m-d");
$queryBi = "SELECT branch.branch_name , SUM(CASE WHEN invoice.device_status = 'Done' THEN invoice.hidden_price END)Amount "
        . "FROM((`branch` INNER JOIN `customer` ON branch.branch_id=customer.branch_id) INNER JOIN `invoice` "
        . "ON invoice.bill_date='$cusCreateDate' AND invoice.cus_id=customer.cus_id) GROUP BY branch.branch_name";
$resultBi = mysqli_query($con, $queryBi);
$rowss = mysqli_fetch_assoc($resultBi);
echo "<tr >";
echo "<hr style='font: bolder'>";
echo "<td style='color:red;font: bolder;bolder;font-size: 20px;'>Total</td>";
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';

echo "<td style='border: 1px solid white;background:red;'><p style='color:white;';'>{$rowss['Amount']}</p></td>";

echo "</tr>";
}
?>
