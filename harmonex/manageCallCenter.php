<?php include './includes/header.php'; ?>
<?php include './includes/config.php'; ?>

<?php ob_start(); ?>


<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Call Center </h4>
                    </div>
                    <div class="card-block" >
                        <div class="mrg-top-10">
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

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="branch_name"> Invoice Number</label>
                                                        <input type="text" class="form-control"  name="invoiceNumber"  autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="branch_name"> Phone Number</label>
                                                        <input type="text" class="form-control"  name="phoneNumber"  autocomplete="off">
                                                    </div>
                                                </div>
                                            
                                          
                                                <div class="col-md-2">
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
                            <h4 class="card-title">Information About Customer</h4>
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
                                                    <th style="font-size: 10px;">Color</th>
                                                    <th style="font-size: 10px;">Problem</th>
                                                    <th style="font-size: 10px;">Notes</th>
                                                    <th style="font-size: 10px;">Risk</th>
                                                    <th style="font-size: 10px;">Access</th>
                                                    <th style="font-size: 10px;">Price</th>
                                                    <th style="font-size: 10px;">Invoice Created</th>
                                                    <th style="font-size: 10px;">Finisn Main Date</th>
                                                    <th style="font-size: 10px;">Finsih Maintence Time</th>
                                                    <th style="font-size: 10px;">Branch</th>
                                                    <th style="font-size: 10px;">Status</th>
                                                    <th style="font-size: 10px;">Edit</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if (isset($_POST['search'])) {
                                                if (isset($_POST['invoiceNumber']) && empty($_POST['phoneNumber'])) {

                                                    $numb = $_POST['invoiceNumber'];
                                                    //$queryInvoice = "SELECT * FROM `invoice` WHERE `invoice_number` = '$numb'";
                                                    $queryInvoice = "SELECT * FROM `invoice` INNER JOIN `customer` ON invoice.invoice_number = '$numb' AND invoice.cus_id = customer.cus_id";
                                                    $resultInvoice = mysqli_query($con, $queryInvoice);

                                                    // $queryCustomer = "SELECT * FROM `customer` WHERE `cus_id`={$rowInvoice['cus_id']} ";
                                                    //$resultCustomer = mysqli_query($con, $queryCustomer);
                                                    //$rowCustomer = mysqli_fetch_assoc($resultCustomer);

                                                    while ($rowInvoice = mysqli_fetch_assoc($resultInvoice))
                                                        if (!empty($rowInvoice)) {
                                                            echo '<tr>';
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['invoice_number']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['cus_name']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['cus_phone']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_type']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_color']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_problem']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_note']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_question']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_accessories']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['device_price']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['entry_date']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['finish_main_date']}</td>";
                                                            echo "<td style='font-size: 11px;'>{$rowInvoice['finish_main_time']}</td>";
                                                            $queryBranch = "SELECT * FROM `branch` WHERE `branch_id` = {$rowInvoice['branch_id']}";
                                                            $resultBranch = mysqli_query($con, $queryBranch);
                                                            $rowBranch = mysqli_fetch_assoc($resultBranch);
                                                            echo "<td style='font-size: 12px;'>{$rowBranch['branch_name']}</td>";
                                                            echo "<td style='font-size: 12px;'>{$rowInvoice['device_status']}</td>";
                                                            echo "<td><a href='editCallCenter.php?inv={$rowInvoice['invoice_number']}'>Edit</a></td>";
                                                            // echo "<td style='font-size: 12px;'><a href='editCallCenter.php?invoiceNumber={$rowInvoice['invoice_number']}'>Edit</a></td>";
                                                            echo '</tr>';
                                                        }
                                                }
                                                if (isset($_POST['phoneNumber']) && empty($_POST['invoiceNumber'])) {
                                                    $numb = $_POST['phoneNumber'];
                                                    // This Query is working .....
                                                    //  $queryAll = "SELECT * FROM `invoice` INNER JOIN `customer` ON customer.cus_phone ='{$_POST['phoneNumber']}' AND invoice.cus_id = customer.cus_id ORDER BY invoice.entry_date DESC";
                                                    $queryAll = "SELECT * FROM `invoice` INNER JOIN `customer` "
                                                            . "ON customer.cus_phone ='{$_POST['phoneNumber']}'"
                                                            . " AND invoice.cus_id = customer.cus_id "
                                                            . "  ORDER BY invoice.entry_date  DESC ";
                                                    /* $queryAll = "SELECT invoice.invoice_number,invoice.finish_main_date, invoice.finish_main_time ,invoice.device_price, invoice.cus_id , invoice.device_type , invoice.device_color ,invoice.device_problem, customer.cus_id , customer.cus_name , customer.cus_phone , customer.cus_create_date , customer.branch_id  FROM `invoice`,`customer`  WHERE customer.cus_phone ='0796945841' AND invoice.cus_id = customer.cus_id"; */
                                                    $resultAll = mysqli_query($con, $queryAll);



                                                    while ($rowAll = mysqli_fetch_assoc($resultAll)) {
                                                        echo '<tr>';
                                                        echo "<td style='font-size: 12px;'>{$rowAll['invoice_number']}</td>";
                                                        $queryName = "SELECT * FROM `customer` WHERE cus_id = '{$rowAll['cus_id']}'";
                                                        $resName = mysqli_query($con, $queryName);
                                                        $rowName = mysqli_fetch_assoc($resName);
                                                        echo "<td style='font-size: 12px;'>{$rowName['cus_name']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowName['cus_phone']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['device_type']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['device_color']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['device_problem']}</td>";
                                                        if ($rowAll['device_note'] == '') {
                                                            echo "<td style='font-size: 12px;'>noun</td>";
                                                        } else {
                                                            echo "<td style='font-size: 12px;'>{$rowAll['device_note']}</td>";
                                                        }

                                                        switch ($rowAll['device_question'] == "Yes") {
                                                            case "Yes":
                                                                echo "<td style='font-size: 12px;'>yes</td>";

                                                                break;
                                                            case "no":
                                                                echo "<td style='font-size: 12px;'>no</td>";

                                                                break;

                                                            default:
                                                                echo "<td style='font-size: 12px;'>noun</td>";
                                                        }
//                                                       
                                                        echo "<td style='font-size: 11px;'>{$rowAll['device_accessories']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['device_price']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['entry_date']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['finish_main_date']}</td>";
                                                        echo "<td style='font-size: 12px;'>{$rowAll['finish_main_time']}</td>";
                                                        $queryBranch2 = "SELECT * From `branch` WHERE `branch_id` = {$rowAll['branch_id']}";
                                                        $resBranch2 = mysqli_query($con, $queryBranch2);
                                                        $rowBran = mysqli_fetch_assoc($resBranch2);
                                                        echo "<td style='font-size: 12px;'>{$rowBran['branch_name']}</td>";
                                                        //echo "<td style='font-size: 12px;'><a href=''>Edit</a></td>";

                                                        echo "<td style='font-size: 12px;'>{$rowAll['device_status']}<td>";
                                                        if ($rowAll['device_status'] == 'Done') {
                                                            echo "<td>Close</td>";
                                                        } else {
                                                            echo "<td><a href='editCallCenter.php?inv={$rowAll['invoice_number']}'>Edit</a></td>";
                                                        }
                                                        echo '</tr>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <tbody>
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