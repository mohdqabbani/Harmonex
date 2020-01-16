<?php include './includes/header.php'; ?>
<?php include './includes/config.php'; ?>


<?php
ob_start();

?>
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Reception Check</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <div class="col-md-8 ml-auto mr-auto">
                                         <?php
                                        //if (isset($message)) {
                                        if (isset($_POST['invoiceNumber']) && isset($_POST['phoneNumber']) && !empty($_POST['invoiceNumber']) && !empty($_POST['phoneNumber'])) {
                                            $message = "Enter One Filed Only";
                                            echo '<div class="alert alert-success" id="alertSuccess">';
                                            echo "<strong>$message</strong></div>";
                                        }
                                        ?>
                                        <form action="" method="post" role="form" id="form-validation">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="branch_name"> Invoice Number</label>
                                                        <input type="text" class="form-control"  name="invoiceNumber"  autocomplete="off" placeholder="Enter Invoice Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="branch_name"> Phone Number</label>
                                                        <input type="text" class="form-control"  name="phoneNumber"  autocomplete="off" placeholder="Enter Phone Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-right mrg-top-5">
                                                        <button type="submit" class="btn btn-primary" name="search" value="search">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading border bottom">
                            <h4 class="card-title">Customer Information</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12 ml-auto mr-auto">
                                    <div class="table-overflow">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="font-size: 10px;">Invoice Number</th>
                                                    <th style="font-size: 10px;">Name</th>
                                                    <th style="font-size: 10px;">Phone</th>
                                                    <th style="font-size: 10px;">Device</th>
                                                    <th style="font-size: 10px;">Problem</th>
                                                    <th style="font-size: 10px;">Note</th>
                                                    <th style="font-size: 10px;">Phone Entry Date</th>
                                                    <th style="font-size: 10px;">Phone Entry Time</th>
                                                    <th style="font-size: 10px;">Price</th>
                                                    <th style="font-size: 10px;">Status</th>
                                                    <th style="font-size: 10px;">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_POST['search'])) {
                                                    if ($_POST['invoiceNumber'] && empty($_POST['phoneNumber'])) {
                                                        $queryInvoiceRec = "SELECT * FROM `invoice` INNER JOIN `customer` ON `invoice_number` = '{$_POST['invoiceNumber']}' AND customer.cus_id = invoice.invoice_id AND device_status IN ('Pending','Cancel','fix','not fix','Done') ";
                                                        $resultInvoicrRec = mysqli_query($con, $queryInvoiceRec);
                                                        while ($rowInvoiceRec = mysqli_fetch_assoc($resultInvoicrRec)) {
                                                            echo "<tr>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['invoice_number']}</td>";
                                                            echo "<td style='font-size: 12px;'>{$rowInvoiceRec['cus_name']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['cus_phone']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['device_type']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['device_problem']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['device_note']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['entry_date']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['entry_time']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['device_price']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowInvoiceRec['device_status']}</td>";
                                                            if($rowInvoiceRec['device_status'] == 'Fix' ||$rowInvoiceRec['device_status'] =='Not Fix'|| $rowInvoiceRec['device_status']=='Pending' || $rowInvoiceRec['device_status']=='Cancel')
                                                            {
                                                            echo "<td style='font-size: 12px;'><a href='editReception.php?inv={$rowInvoiceRec['invoice_number']}'>Edit</a></td>";
                                                            }
                                                          /*  else if($rowInvoiceRec['device_status'] == 'Pending')
                                                            {
                                                                echo "<td style='font-size: 12px;'>Device Under Maintenence</td>";
                                                            }*/
                                                            else{
                                                                echo "<td style='font-size: 12px;'>Close</td>";
                                                            }
                                                            echo "</tr>";
                                                        }
                                                    }
                                                    if($_POST['phoneNumber'] && empty($_POST['invoiceNumber']))
                                                    {
                                                        $phoneNumber       = $_POST['phoneNumber'];
                                                        $queryReturnPhone  = "SELECT * FROM `invoice` INNER JOIN `customer` ON customer.cus_phone = '$phoneNumber' AND invoice.cus_id = customer.cus_id ORDER BY invoice.entry_date DESC";
                                                        $resultRec         = mysqli_query($con, $queryReturnPhone);
                                                        while($rowRec = mysqli_fetch_assoc($resultRec))
                                                        {
                                                            echo "<tr>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['invoice_number']}</td>";
                                                            echo "<td style='font-size: 12px;'>{$rowRec['cus_name']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['cus_phone']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['device_type']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['device_problem']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['device_note']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['entry_date']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['entry_time']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['device_price']}</td>";
                                                            echo "<td style='font-size: 12px;'> {$rowRec['device_status']}</td>";
                                                            
                                                            if($rowRec['device_status'] =='Fix' || $rowRec['device_status'] =='Not Fix' || $rowRec['device_status'] == 'Pending' || $rowRec['device_status'] == 'Cancel')
                                                            {
                                                           echo "<td style='font-size: 12px;'><a href='editReception.php?inv={$rowRec['invoice_number']}'>Edit</a></td>";
                                                            }
                                                           //else  if($rowRec['device_status'] == 'Pending')
                                                            //{
                                                               // echo "<td style='font-size: 12px;'>Device Under Maintenence</td>";
                                                           // }
                                                            else{
                                                                
                                                                echo "<td style='font-size: 12px;'>Close</td>";
                                                            }
                                                            echo "</tr>";
                                                        }                                                        
                                                    }
                                                   
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->

    <?php include './includes/footer.php'; ?>