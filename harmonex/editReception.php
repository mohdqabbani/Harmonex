<?php include './includes/header.php'; ?>
<?php include './includes/config.php' ?>;


<?php
$invNumb = $_GET['inv'];
$queryEditRec = "SELECT * FROM `invoice` INNER JOIN `customer` ON `invoice_number` = '$invNumb' AND customer.cus_id = invoice.cus_id ";
$resultEditRec = mysqli_query($con, $queryEditRec);
$rowEditReception = mysqli_fetch_assoc($resultEditRec);
if (isset($_POST['Save'])) {
    $status = $_POST['updateStatus'];
    if ($status == 'Not Fix' || $status == 'Cancel') {
        // ,`hidden_price`='$devicePriceRec'
        $cusNoteRec = $_POST['cusNote'];
        $devicePriceRec = $_POST['price'];
        $billDate = date("Y/m/d");
        $billTime = date("h:i:sa");
        $queryUpdateReception = "UPDATE `invoice` SET `device_status`='$status',`device_note`='$cusNoteRec',`device_price`='$devicePriceRec',`entry_date` ='$billDate', `entry_time`='$billTime',`finish_main_date`='$billDate', `finish_main_time`='$billTime',`bill_date`='$billDate',`bill_time`='$billTime',`hidden_price`='0' WHERE `invoice_number` = '{$rowEditReception['invoice_number']}'";
        mysqli_query($con, $queryUpdateReception);
        header("Location: manageReception.php");
        exit();
    } else if ($status == 'Pending' || $status == 'Fix') {
        $cusNoteRec = $_POST['cusNote'];
        $devicePriceRec = $_POST['price'];
        $billDate = date("Y/m/d");
        $billTime = date("h:i:sa");
        $queryUpdateReception = "UPDATE `invoice` SET `device_status`='$status',`device_note`='$cusNoteRec',`device_price`='$devicePriceRec',`entry_date` ='$billDate', `entry_time`='$billTime',`finish_main_date`='$billDate', `finish_main_time`='$billTime',`bill_date`='$billDate',`bill_time`='$billTime',`hidden_price`='$devicePriceRec' WHERE `invoice_number` = '{$rowEditReception['invoice_number']}'";
        mysqli_query($con, $queryUpdateReception);
        header("Location: manageReception.php");
        exit();
    } else if ($status == 'Done' && $rowEditReception['hidden_price'] == 0) {
        $cusNoteRec = $_POST['cusNote'];
        $devicePriceRec = $_POST['price'];
        $billDate = date("Y/m/d");
        $billTime = date("h:i:sa");
        $queryUpdateReception = "UPDATE `invoice` SET `device_status`='$status',`device_note`='$cusNoteRec',`device_price`='$devicePriceRec',`entry_date` ='$billDate', `entry_time`='$billTime',`finish_main_date`='$billDate', `finish_main_time`='$billTime',`bill_date`='$billDate',`bill_time`='$billTime',`hidden_price`='0' WHERE `invoice_number` = '{$rowEditReception['invoice_number']}'";
        mysqli_query($con, $queryUpdateReception);
        header("Location: manageReception.php");
        exit();
    } else if ($status == 'Done' && $rowEditReception['hidden_price'] != 0) {
        $cusNoteRec = $_POST['cusNote'];
        $devicePriceRec = $_POST['price'];
        $billDate = date("Y/m/d");
        $billTime = date("h:i:sa");
        $queryUpdateReception = "UPDATE `invoice` SET `device_status`='$status',`device_note`='$cusNoteRec',`device_price`='$devicePriceRec',`entry_date` ='$billDate', `entry_time`='$billTime',`finish_main_date`='$billDate', `finish_main_time`='$billTime',`bill_date`='$billDate',`bill_time`='$billTime',`hidden_price`='$devicePriceRec' WHERE `invoice_number` = '{$rowEditReception['invoice_number']}'";
        mysqli_query($con, $queryUpdateReception);
        header("Location: manageReception.php");
        exit();
    }
}
?>
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Edit Customer</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">

                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Invoice Number</label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="invoiceNumber" 
                                                           readonly autocomplete="off" value='<?php echo "{$rowEditReception['invoice_number']}"; ?>'>
                                                </div>
                                            </div>                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Customer Name</label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="name" 
                                                           readonly autocomplete="off" value='<?php echo"{$rowEditReception['cus_name']}"; ?>'>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Customer Note</label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="cusNote" 
                                                           autocomplete="off" value='<?php echo"{$rowEditReception['device_note']}"; ?>'>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name"><b>Price</b></label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="price" 
                                                           autocomplete="off" value='<?php echo"{$rowEditReception['device_price']}"; ?>'>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="radio radio-inline">
                                                                <!--                                                                <label >Device Status: </label>-->
                                                                <!--                                                                <input type="radio"   name="Stat" id="rad9"
                                                                                                                                       value="//// echo $rowEditReception['device_status']; ?>" <?php
// if ($rowEditReception['device_status'] == 'Pending' || $rowEditReception['device_status'] == 'Fix' || $rowEditReception['device_status'] == 'Not Fix' || $rowEditReception['device_status'] == 'Cancel' || $rowEditReception['device_status'] == 'Done') {
// echo "checked";
// }
// >-->
// <label for="rad9" value="<?php $rowEditReception['device_status']; 
                                                                ?>"><?php //echo $rowEditReception['device_status']; ?></label><!--
                                                                                                                            </div>--> <div class="radio radio-inline">
                                                                    <label >Device Status : </label>
                                                                    <input type="radio" value="Pending"  name="updateStatus" id="rad1"
                                                                    <?php
                                                                    if ($rowEditReception['device_status'] == 'Pending') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                                                                    <label for="rad1"> Pending</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" value="Fix"  name="updateStatus" id="rad2"
                                                                    <?php
                                                                    if ($rowEditReception['device_status'] == 'Fix') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?> >
                                                                    <label for="rad2"> Fix</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" value="Not Fix"  name="updateStatus" id="rad3"
                                                                    <?php
                                                                    if ($rowEditReception['device_status'] == 'Not Fix') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                                                                    <label for="rad3"> Not Fix</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" value="Cancel"  name="updateStatus" id="rad4" 
                                                                    <?php
                                                                    if ($rowEditReception['device_status'] == 'Cancel') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                                                                    <label for="rad4"> Cancel</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <div class="radio radio-inline">
                                                                        <input type="radio" value="Done"  name="updateStatus" id="rad7" 
                                                                        <?php
                                                                        if ($rowEditReception['device_status'] == 'Done') {
                                                                            echo 'checked';
                                                                        }
                                                                        ?>>
                                                                        <label for="rad7"> Check Out</label>
                                                                    </div>
        <!--                                                                <input type="radio"  value="Done"  name="Stat" id="rad17" >
                                                                        <label for="rad17" value="Done">Done</label>-->
                                                                </div>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">-->
                                                <div class="col-md-12">
                                                    <div class="text-right mrg-top-5">
                                                        <button type="submit" class="btn btn-primary" name="Save" value="Save">Save</button>
                                                    </div>
                                                </div>
                                                <!--</div> -->
                                                </form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include './includes/footer.php'; ?>