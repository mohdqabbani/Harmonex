<?php ob_start();?>
<?php include './includes/config.php'; ?>
<?php

$dateRep = date("Y/m/d");
$output = '';
$nameid = $_GET['brName'];

$strDate = $_GET['stDate'];
$endDate = $_GET['enDate'];
$devStatus = $_GET['deStatus'];

$queryReport = "SELECT * FROM `invoice`  INNER JOIN customer ON (invoice.entry_date BETWEEN '$strDate' AND '$endDate') AND customer.branch_id ='$nameid' AND invoice.device_status = '$devStatus' AND invoice.cus_id = customer.cus_id ";
$resReporting = mysqli_query($con, $queryReport);
if (mysqli_num_rows($resReporting)>0 ) {
    $output.='<table border="1">
                <tr>
                <th style="font-size: 10px;">Invoice Number</th>
                <th style="font-size: 10px;">Customer Name</th>
                <th style="font-size: 10px;">Device Type</th>
                <th style="font-size: 10px;">Device Problem</th>
                <th style="font-size: 10px;">Device Note</th>
               <th style="font-size: 10px;">Entry Date</th>
               <th style="font-size: 10px;">Entry Time</th>
               <th style="font-size: 10px;">Finish Date</th>
               <th style="font-size: 10px;">Finish Date</th>
               <th style="font-size: 10px;">Bill Date</th>
               <th style="font-size: 10px;">Bill Date</th>
               <th style="font-size: 10px;">Price</th>
                </tr>';
    while ($rowReporting = mysqli_fetch_assoc($resReporting)) {
        $output .='<tr>
                    <td>' . $rowReporting["invoice_number"] . '</td>
                    <td>' . $rowReporting["cus_name"] . '</td>
                    <td>' . $rowReporting["device_type"] . '</td>
                    <td>' . $rowReporting["device_problem"] . '</td>
                    <td>' . $rowReporting["device_note"] . '</td>
                    <td>' . $rowReporting["entry_date"] . '</td
                    <td>' . $rowReporting["entry_time"] . '</td>
                    <td>' . $rowReporting["finish_main_date"] . '</td>
                    <td>' . $rowReporting["finish_main_time"] . '</td>
                    <td>' . $rowReporting["bill_date"] . '</td>
                    <td>' . $rowReporting["bill_time"] . '</td>
                    <td>' . $rowReporting["device_price"] . '</td>
                    </tr>';
    }
    $output.='</table>';
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=report-$dateRep.com.xls");
    echo $output;
}
else if(mysqli_num_rows($resReporting) == 0)
{
    echo '<script type="text/javascript">alert("No Data");</script>';
    header("Location: manageReporting.php");
}
else{
    header("Location: manageReporting.php");
}
?>


