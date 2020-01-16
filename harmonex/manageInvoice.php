<?php include './includes/header.php'; ?>
<?php include './includes/config.php'; ?>
<?php ob_start(); ?>
<?php ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="mrg-top-40">
                        <div class="row" <?php
                        if ($_SESSION['admin_prev'] == 'reception' || $_SESSION['admin_prev'] == 'callcenter') {
                            echo 'hidden';
                        }
                        ?>>
                            <div class="col-md-8 ml-auto mr-auto">
                                <form action="" method="post" role="form" id="form-validation">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="branch_name">Branches</label>
                                                <select name="branchName" class="form-control">
                                                    <?php
                                                    $queryManage = "SELECT * FROM `branch`";
                                                    $resManage = mysqli_query($con, $queryManage);
                                                    
                                                        while ($rowManage = mysqli_fetch_assoc($resManage)) {
                                                            echo "<option";
                                                           if ($_SESSION['branch_id'] == $rowManage['branch_id'])
                                                                echo " selected value='{$rowManage['branch_id']}'>{$rowManage['branch_name']}";
                                                            echo "</option>";
                                                            if ($_SESSION['branch_id'] != $rowManage['branch_id'])
                                                                echo "<option";
                                                            echo "  value='{$rowManage['branch_id']}'>{$rowManage['branch_name']}";
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                </select>

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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading border bottom">
                            <h4 class="card-title">Manage Invoice </h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-12 ml-auto mr-auto">
                                    <div class="table-overflow">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Invoice Number</th>
                                                    <th>Device Type</th>
                                                    <th>Color</th>
                                                    <th>Problem</th>
                                                    <th>Notes</th>
                                                    <th>Risk</th>
                                                    <th>Access</th>
                                                    <th>Entry Date</th>
                                                    <th>Entry Time</th>
                                                    <th>Device Status</th>
                                                    <th>Price</th>
                                                    <!--<th>Action</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if(isset($_POST['search']))
                                                {
                                                    $branchIdd = $_POST['branchName'];
                                                $queryMangeInvoice2 = "SELECT * FROM ((`invoice` INNER JOIN `admin` ON admin.branch_id = $branchIdd "
                                                        . "AND invoice.device_status = 'Pending') INNER JOIN `branch` "
                                                        . "ON admin.branch_id = branch.branch_id AND invoice.admin_id = admin.admin_id ) "
                                                        . "ORDER BY invoice.entry_date DESC";
                                                $resultManageInvoice2 = mysqli_query($con, $queryMangeInvoice2);
                                                
                                                  while (!empty($rowMangeInvoice2 = mysqli_fetch_assoc($resultManageInvoice2))) {
                                                    echo '<tr>';
                                                    echo "<td>{$rowMangeInvoice2['invoice_number']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_type']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_color']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_problem']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_note']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_question']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_accessories']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['entry_date']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['entry_time']}</td>";
                                                    echo "<td>{$rowMangeInvoice2['device_status']}</td>";
                                                    if ($rowMangeInvoice2['device_status'] == 'Done') {
                                                        echo '<td>Device is Out of system </td>';
                                                    } else {
                                                        //echo "<td><button type='button' class='btn btn-success'>Print</button></td>";
                                                    }
                                                    echo "<td>{$rowMangeInvoice2['device_price']}</td>";
                                                    echo '</tr>';
                                                }
                                                }else{

                                                $queryMangeInvoice = "SELECT * FROM `invoice` WHERE `device_status` ='Pending' AND admin_id = {$_SESSION['admin_id']} ORDER BY `entry_date` DESC ";
                                                $resultManageInvoice = mysqli_query($con, $queryMangeInvoice);

                                                while (!empty($rowMangeInvoice = mysqli_fetch_assoc($resultManageInvoice))) {
                                                    echo '<tr>';
                                                    echo "<td>{$rowMangeInvoice['invoice_number']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_type']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_color']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_problem']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_note']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_question']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_accessories']}</td>";
                                                    echo "<td>{$rowMangeInvoice['entry_date']}</td>";
                                                    echo "<td>{$rowMangeInvoice['entry_time']}</td>";
                                                    echo "<td>{$rowMangeInvoice['device_status']}</td>";
                                                    if ($rowMangeInvoice['device_status'] == 'Done') {
                                                        echo '<td>Device is Out of system </td>';
                                                    } else {
                                                        //echo "<td><button type='button' class='btn btn-success'>Print</button></td>";
                                                    }
                                                    echo "<td>{$rowMangeInvoice['device_price']}</td>";
                                                    echo '</tr>';
                                                }
                                                }
//header("refresh: 30");
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