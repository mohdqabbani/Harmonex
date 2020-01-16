<?php include './includes/header.php'; ?>
<?php include './includes/config.php' ?>;
<?php
//header("refresh: 3;");
ob_start();

$invoiceNumber = $_GET['inv'];
$queryEdidInv = " SELECT * FROM `invoice` WHERE `invoice_number`= '$invoiceNumber'";
$resultEditInv = mysqli_query($con, $queryEdidInv);
$rowEditInv = mysqli_fetch_assoc($resultEditInv);
?>
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Edit Customer</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <?php
                                    if (isset($_POST['Save'])) {
                                        //$status = $_POST['updateStatus'];
                                        
                                        if ($_POST['updateStatus'] == 'Pending') {
                                            $cusNote = $_POST['cusNote'];
                                            $price = $_POST['price'];
                                            $feedback = $_POST['feedback'];
                                            $editCall = "UPDATE `invoice` SET `device_note`= '$cusNote' ,`device_price`= '$price' , `finish_main_date` = null, `finish_main_time` = null ,`device_status`='Pending',`hidden_price`='$price' , `feedback_callcenter`='$feedback'  WHERE `invoice_number` = '{$rowEditInv['invoice_number']}' ";
                                            $resultEditCall = mysqli_query($con, $editCall);
                                            header("Location:manageCallCenter.php");
                                            exit();
                                        }

                                        if ($_POST['updateStatus'] == 'Fix') {
                                            $finishUpdateDate = date("Y/m/d");
                                            $finishUpdateTime = date("h:i:sa");
                                            $deviceStat = $_POST['updateStatus'];
                                            $price = $_POST['price'];
                                            $queryUpdateCustomer = "UPDATE `invoice` SET `device_status`='$deviceStat',  `device_price`='$price',`finish_main_date`='$finishUpdateDate',`finish_main_time`= '$finishUpdateTime',`bill_date`=null , `bill_time`=null,`hidden_price`='$price' WHERE  `invoice_number` = '{$rowEditInv['invoice_number']}' ";
                                            mysqli_query($con, $queryUpdateCustomer);
                                            header("Location:manageCallCenter.php");
                                        }
                                        if ($_POST['updateStatus'] == 'Not Fix' || $_POST['updateStatus'] == 'Cancel') {
                                            $finishUpdateDate = date("Y/m/d");
                                            $finishUpdateTime = date("h:i:sa");
                                            $deviceStat = $_POST['updateStatus'];
                                            $price = $_POST['price'];
                                            $queryUpdateCustomer = "UPDATE `invoice` SET `device_status`='$deviceStat',  `device_price`='$price',`finish_main_date`='$finishUpdateDate',`finish_main_time`= '$finishUpdateTime',`bill_date`=null , `bill_time`=null,`hidden_price`='0' WHERE  `invoice_number` = '{$rowEditInv['invoice_number']}' ";
                                            mysqli_query($con, $queryUpdateCustomer);
                                            header("Location:manageCallCenter.php");
                                        }
                                    }
                                    ?>
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Invoice Number</label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="invoiceNumber" 
                                                           readonly autocomplete="off" value='<?php echo $rowEditInv['invoice_number']; ?>'>
                                                </div>
                                            </div>                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Customer Name</label>
                                                    <input type="text" class="form-control" 
                                                    <?php
                                                    $queryRetName = "SELECT * FROM `customer` WHERE `cus_id` = '{$rowEditInv['cus_id']}'";
                                                    $resultRetName = mysqli_query($con, $queryRetName);
                                                    $rowEd = mysqli_fetch_assoc($resultRetName);
                                                    ?>
                                                           id="branch_name" name="invoiceNumber" 
                                                           readonly autocomplete="off" value='<?php echo $rowEd['cus_name']; ?>'>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Customer Note</label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="cusNote" 
                                                           autocomplete="off" value='<?php echo $rowEditInv['device_note']; ?>'>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Status Of connection With Customer</label>
                                                    <select name="feedback" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="Answered" <?php
                                                    if ($rowEditInv['feedback_callcenter'] == 'Answered') {
                                                        echo 'selected';
                                                    } else {
                                                        
                                                    }
                                                    ?>>Answered</option>
                                                        <option value="Not Answered" <?php
                                                        if ($rowEditInv['feedback_callcenter'] == 'Not Answered') {
                                                            echo 'selected';
                                                        } else {
                                                            
                                                        }
                                                    ?>>Not Answered</option>
                                                        <option value="Phone cannot be reatched" <?php
                                                        if ($rowEditInv['feedback_callcenter'] == 'Phone cannot be reatched') {
                                                            echo 'selected';
                                                        } else {
                                                            
                                                        }
                                                    ?> >Phone cannot be reatched</option>
                                                        <option value="Number busy" <?php
                                                        if ($rowEditInv['feedback_callcenter'] == 'Number busy') {
                                                            echo 'selected';
                                                        } else {
                                                            
                                                        }
                                                    ?>>Number Busy</option>
                                                        <option value="Number declined" <?php
                                                        if ($rowEditInv['feedback_callcenter'] == 'Number declined') {
                                                            echo 'selected';
                                                        } else {
                                                            
                                                        }
                                                    ?>>Number declined</option>
                                                        <option value="Not Connected" <?php
                                                        if ($rowEditInv['feedback_callcenter'] == 'Not Connected') {
                                                            echo 'selected';
                                                        } else {
                                                            
                                                        }
                                                    ?>>Not Connected</option>
                                                    </select>
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="full_name">Price</label>
                                                        <input type="text" class="form-control" 
                                                               id="branch_name" name="price" 
                                                               autocomplete="off" value='<?php echo $rowEditInv['device_price']; ?>'>
                                                    </div>
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="radio radio-inline">
                                                                    <label >Device Status : </label>
                                                                    <input type="radio" value="Pending"  name="updateStatus" id="rad1"
                                                                    <?php
                                                                    if ($rowEditInv['device_status'] == 'Pending') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                                                                    <label for="rad1"> Pending</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" value="Fix"  name="updateStatus" id="rad2"
                                                                    <?php
                                                                    if ($rowEditInv['device_status'] == 'Fix') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?> >
                                                                    <label for="rad2"> Fix</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" value="Not Fix"  name="updateStatus" id="rad3"
                                                                    <?php
                                                                    if ($rowEditInv['device_status'] == 'Not Fix') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                                                                    <label for="rad3"> Not Fix</label>
                                                                </div>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" value="Cancel"  name="updateStatus" id="rad4" 
                                                                    <?php
                                                                    if ($rowEditInv['device_status'] == 'Cancel') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?>>
                                                                    <label for="rad4"> Cancel</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-right mrg-top-5">
                                                        <button type="submit" class="btn btn-primary" name="Save" value="Save">Save</button>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <?php include './includes/footer.php'; ?>