<?php include './includes/config.php'; ?>
<?php include './includes/header.php'; ?>
<?php
ob_start();

if (isset($_POST['save'])) {

    $cusName = $_POST['cusName'];
    $cusPhone = $_POST['cusNumber'];
    $cusCreateDate = date("Y/m/d");
    $cusCreateTime = date("h:i:sa");
    // This Validation for Customer Naem
    if (str_word_count($_POST['cusName']) >= 2) {
        // This Insert into Customer Table 
        $queryInserCustmer = "INSERT INTO `customer`( `cus_name`, `cus_phone`, `cus_create_date`, `cus_create_time`, `branch_id`)"
                . " VALUES ('$cusName','$cusPhone','$cusCreateDate','$cusCreateTime','{$_SESSION['branch_id']}')";
        $resultIsertCustomer = mysqli_query($con, $queryInserCustmer);
        // This Validation To Make Sure New Customer Add To DataBase 
        if ($resultIsertCustomer) {
            $message = "Customer Added Sucessfully";
            //---------------------------------------------------------------------------------------------------------------
            //This Insert into invoice table
            $queryRetunrCusId = "SELECT * FROM `customer` WHERE `cus_name` = '$cusName' AND `cus_phone`='$cusPhone' ";
            $resultReturnCusId = mysqli_query($con, $queryRetunrCusId);
            $rowReturnCusId = mysqli_fetch_assoc($resultReturnCusId);
            // This To Insert Data To Invoice Table .
            //--------------------------------------------------------------------------------------------      
            $num_rows = '5';
            $collection = array();
            for ($i = 1; $i <= $num_rows; $i++) {
                $ukey = strtoupper(substr(sha1(microtime() . $i), rand(0, 10), 5));
                if (!in_array($ukey, $collection)) { // you can check this in database as well.
                    $collection[] = implode("-", str_split($ukey, 5));
                }
            }

            $cusId = $rowReturnCusId['cus_id'];
            $deviceType = $_POST['deviceType'];
            $deviceColor = $_POST['deviceColor'];
            $deviceQuestion = isset($_POST['radio1']) ? $_POST['radio1'] : " ";
            $deviceStatus = 'Pending';
            $deviceProblem = $_POST['deviceProblem'];
            $deviceNote = $_POST['cusNote'];
            $deviceImei = $_POST['deviceImei'];
            $deviceAccess = '';
            if (isset($_POST['ch1'])) {
                $numberCheckBox = count($_POST['ch1']);
                for ($i = 0; $i < $numberCheckBox; $i++) {
                    $deviceAccess = $deviceAccess . ' ' . $_POST['ch1'][$i];
                }
            }
            $devicePrice = $_POST['price'];


            $queryInsertInvoice = "INSERT INTO `invoice`(`invoice_number`,`cus_id`, `admin_id`, `device_type`, `device_color`, `device_question`, `device_status`, `device_problem`,  `device_imei`, `device_note`, `device_accessories`, `device_price`, `entry_date`, `entry_time`,`hidden_price`) 
         VALUES ('$ukey','$cusId','{$_SESSION['admin_id']}','$deviceType','$deviceColor','$deviceQuestion','$deviceStatus'
         ,'$deviceProblem','$deviceImei' ,'$deviceNote','$deviceAccess','$devicePrice','$cusCreateDate','$cusCreateTime','$devicePrice')";
            $resultInsertCustomer = mysqli_query($con, $queryInsertInvoice);

            // print code is here
            $qq = "select * from invoice WHERE cus_id = $cusId ORDER BY invoice_id DESC LIMIT 1";
            $res3 = mysqli_query($con, $qq);
            $lastInvoiceId = mysqli_fetch_assoc($res3);
            // echo '<pre>';
            // print_r($resultIsertCustomer);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 1) {
                    $message = "<div class='print'><h1 class='printmessage'>PASSWORD(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</h1>";
                    $message .= "<br><br><br>";
                    $message .= "<h1 class='printmessage'>PASSWORD(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</h1><br><br><br><br><br><br><br><br>";
                    continue;
                }
                if ($i == 2 || $i == 3 || $i == 4) {
                    if ($i == 4) {
                        $message .= "<p class='printsubmessage'>{$rowReturnCusId['cus_name']}  ";
                        $message .= "{$rowReturnCusId['cus_phone']}</p>";
                        $message .= "<p class='printsubmessage'>{$lastInvoiceId['device_type']} /";
                        $message .= "{$lastInvoiceId['device_problem']}</p>";
                        $message .= "<p class='printsubmessage'>{$lastInvoiceId['entry_date']} /";
                        $message .= "{$lastInvoiceId['device_price']}</p>";
                        $message .= "<p class='printsubmessage'>{$lastInvoiceId['invoice_number']} /";
                        $message .= "{$_SESSION['branch_name']}</p><br><br><br>";
                        continue;
                    } else {
                        $message .= "<br><br><br><br>";
                        $message .= "<p class='printsubmessage'>{$rowReturnCusId['cus_name']}  ";
                        $message .= "{$rowReturnCusId['cus_phone']}</p>";
                        $message .= "<p class='printsubmessage'>{$lastInvoiceId['device_type']} /";
                        $message .= "{$lastInvoiceId['device_problem']}</p>";
                        $message .= "<p class='printsubmessage'>{$lastInvoiceId['entry_date']} /";
                        $message .= "{$lastInvoiceId['device_price']}</p>";
                        $message .= "<p class='printsubmessage'>{$lastInvoiceId['invoice_number']} /";
                        $message .= "{$_SESSION['branch_name']}</p><br><br><br>";
                        continue;
                    }
                }
                if ($i == 5) {
                    $message .= "<p class='printmessage'>POLICY   </p><hr></div> ";
                }
            }
            /* $newmessage = "<h1 class='a' style='margin-left:120px;color:#000;font-size:45px;font-weight:bolder'>PASSWORD(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</h1>"; */

            print '
            <script type="text/javascript">
                var carnr;        
                carnr = "' . $message . '";
                window.onload = function(){
                    var divprint = document.getElementById("printarea");
                    divprint.innerHTML = carnr;
                   if( window.print());
                    }
                    setTimeout(function(){
            window.location.href = "manageCustomer.php";
         }, 3000);
                  
                //console.log(carnr);
                
            </script>';
        } else {
            $message = "Error Happends for adding customer";
        }
    } else {
        $message = "Customer Name Must Be 2 Part`s";
    }



    //header("Location: manageCustomer.php");
    //exit();
}
?>
<style type="text/css">
    @import "assets/css/editStyleNewCustomer.css ";
</style>
<div id="printarea" style="width: 500px;height: 50px;"  ></div>

<!-- Content Wrapper START -->
<div class="hidden-print">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading border bottom">
                            <h4 class="card-title">New Csutomer </h4>
                        </div>
                        <div class="card-block">
                            <div class="mrg-top-40">
                                <div class="row">
                                    <div class="col-md-8 ml-auto mr-auto">
                                        <?php
                                        if (isset($message)) {
                                            echo '<div class="alert alert-success" id="alertSuccess">';
                                            echo "<strong>$message</strong></div>";
                                        }
                                        ?>
                                        <form action="" method="post" role="form" id="form-validation">
                                            <?php
                                            echo '  <div class="row">';
                                            if (isset($_POST['cusNumber'])) {

                                                echo ' <div class="col-md-6" id="phone">';
                                                echo ' <div class="form-group" style="margin-left: 10px;">';
                                                echo '<label for="full_name">Phone Number</label>';
                                                echo "<input type='number' value='{$_POST['cusNumber']}'  class='form-control'  name='cusNumber' required autocomplete='off'>";
                                                if (strlen($_POST['cusNumber']) < 10 || strlen($_POST['cusNumber']) > 14) {
                                                    $validateNumber = false;
                                                } else {
                                                    $validateNumber = true;
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                                //echo '</div>';
                                            } else {
                                                //echo '  <div class="row">';
                                                echo ' <div class="col-md-6">';
                                                echo ' <div class="form-group" >';
                                                echo '<label for="full_name">Phone Number</label>';
                                                echo "<input type='number'   class='form-control'  name='cusNumber' required autocomplete='off'>";
                                                echo '</div>';
                                                echo '</div>';
                                                //echo '</div>';
                                            }
//echo '  <div class="row">';
                                            if (isset($_POST['cusNumber']) && $validateNumber == true) {
                                                $phone = $_POST['cusNumber'];
                                                $querytReunrNameCustomer = "SELECT * FROM `customer` WHERE `cus_phone` ='$phone' ";
                                                $resultCusName = mysqli_query($con, $querytReunrNameCustomer);
                                                $rowReturnCusName = mysqli_fetch_assoc($resultCusName);
                                                echo ' <div class="col-md-6" id="CusName" style="margin-left: -10px;">';
                                                echo ' <div class="form-group">';
                                                echo '<label for="full_name">Customer Name</label>';
                                                // echo '<input type="text" class="form-control"  name="cusName" required autocomplete="off" placeholder="Phone Name">';
                                                echo "<input type=' if({$rowReturnCusName['cus_name']}){text}else{reset}' class='form-control' value='{$rowReturnCusName['cus_name']}'  name='cusName' placeholder='Enter Name Two Part' required autocomplete='off' >";

                                                echo '  </div>';
                                                echo '  </div>';
                                                //echo '  </div>';
                                                //echo '  <div class="row">';
                                                echo ' <div class="col-md-6">';
                                                echo ' <div class="form-group">';
                                                echo '<label for="full_name">Device Type</label>';
                                                echo '<input type="text" class="form-control"  name="deviceType" required autocomplete="off" placeholder="Device Type">';
                                                echo ' <p class="note-w" style="color: blue;font-size: 10px">exp: 6,6s,7,7 plus,edge,mate 10 ,note 3 .....</p>';
                                                echo '  </div>';
                                                echo '  </div>';

                                                //echo '  <div class="row">';
                                                echo ' <div class="col-md-6">';
                                                echo ' <div class="form-group">';
                                                echo '<label for="full_name">Device Problem</label>';
                                                echo ' <input type = "text"   class="form-control" name = "deviceProblem" id = "favorite_team" list = "team_list">';
                                                echo '<datalist id = "team_list">';
                                                echo '<option value="Screen">Screen</option>';
                                                echo '<option value="Touch">Touch</option>';
                                                echo '<option value="Battery">Battery</option>';
                                                echo '<option value="Icloud">Icloud</option>';
                                                echo '<option value="Factory unlock">Factory unlock</option>';
                                                echo '<option value="Turbo sim">Turbo sim</option>';
                                                echo ' <option value="Code unlock">Code unlock</option>';
                                                echo '<option value="Charge ic">Charge ic</option>';
                                                echo '<option value="Voice ic">Voice ic</option>';
                                                echo '<option value="Power ic">Power ic</option>';
                                                echo '<option value="Light ic">Light ic</option>';
                                                echo '<option value="Hard disk">Hard disk</option>';
                                                echo ' <option value="CPU">CPU</option>';
                                                echo '<option value="Battery connector">Battery connector</option>';
                                                echo '<option value="Charger connector">Charger connector</option>';
                                                echo ' <option value="Application microphone">Application microphone</option>';
                                                echo '<option value="Internal Microphone">Internal Microphone</option>';
                                                echo '  <option value="External microphone">External microphone</option>';
                                                echo '<option value="Speaker">Speaker</option>';
                                                echo ' <option value="Headset">Headset</option>';
                                                echo ' <option value="Aux plug">Aux plug</option>';
                                                echo ' <option value="Full housing">Full housing</option>';
                                                echo '<option value="Frame">Frame </option>';
                                                echo '   <option value="Sensor ">Sensor </option>';
                                                echo '   <option value="Front camera">Front camera</option>';
                                                echo '<option value="Back camera ">Back camera </option>';
                                                echo '  <option value="Flash">Flash</option>';
                                                echo ' <option value="Power button">Power button</option>';
                                                echo ' <option value="Home button">Home button</option>';
                                                echo '<option value="Face ID">Face ID</option>';
                                                echo '<option value="Volume button’s">Volume button’s</option>';
                                                echo '<option value="Fingerprint">Fingerprint</option>';
                                                echo ' <option value="WiFi wire">WiFi wire</option>';
                                                echo '  <option value="WiFi.ic"> WiFi.ic</option>';
                                                echo '<option value="Water Damage">Water Damage</option>';
                                                echo '    <option value="Back cover">Back cover</option>';
                                                echo ' <option value="Screen.org">Screen.org</option>';
                                                echo '<option value="Screen.H.c">Screen.H.c</option>';
                                                echo '<option value="Screen.Co">Screen.Co</option>';
                                                echo '</datalist>';

                                                //  echo '<select name="deviceProblem" class="form-control">';
                                                //echo '</select>';
                                                echo '  </div>';
                                                echo '  </div>';
                                                // echo '  </div>';
                                                // echo '  </div>';
                                                //echo '  <div class="row">';
                                                echo ' <div class="col-md-6">';
                                                echo ' <div class="form-group">';
                                                echo '<label for="full_name">Device Color</label>';
                                                echo '<select name="deviceColor" class="form-control">';
                                                echo '<option value = "Black">Black</option>';
                                                echo '<option value = "White">White</option>';
                                                echo '<option value = "Purple">Purple</option>';
                                                echo '<option value = "Green">Green</option>';
                                                echo '<option value = "Silver">Silver</option>';
                                                echo '<option value = "Brown">Brown</option>';
                                                echo '<option value = "Blue">Blue</option>';
                                                echo '<option value = "Yellow">Yellow</option>';
                                                echo '<option value = "Orange">Orange</option>';
                                                echo ' <option value = "Red">Red</option>';
                                                echo '<option value = "Baby Blue">Baby Blue</option>';
                                                echo '<option value="Other">Other</option>';
                                                echo '</select>';
                                                echo '  </div>';
                                                echo '  </div>';
                                                //echo '  </div>';

                                                echo ' <div class="col-md-6">';
                                                echo ' <div class="form-group">';
                                                echo '<label for="full_name">IMEI</label>';
                                                echo '<input type="text" class="form-control"  name="deviceImei" required autocomplete="off" placeholder="Device Type">';

                                                echo '  </div>';
                                                echo '  </div>';

                                                //echo '  <div class="row">';
                                                echo ' <div class="col-md-12">';
                                                echo ' <div class="form-group">';
                                                echo '<label for="full_name">Customer Note</label>';
                                                echo '<input type="text" class="form-control" name="cusNote"> ';
                                                echo '  </div>';
                                                echo '  </div>';
                                                // echo '  </div>';
                                                //echo ' <div class="row">';
                                                // echo '</div>';
                                                //echo '  <div class="row">';
                                                echo ' <div class="col-md-12">';
                                                echo ' <div class="form-group">';
                                                echo '<div class="radio radio-inline">';
                                                echo '<label >With Risk ?</label>';
                                                echo ' <input type="radio" value="Yes"  name="radio1" id="rad1">';
                                                echo '<label for="rad1">Yes</label>';
                                                echo '</div>';
                                                echo '<div class="radio radio-inline">';
                                                echo '<input type="radio" value="No"  name="radio1" id="rad2">';
                                                echo '<label for="rad2">No</label>';
                                                echo '</div>';
                                                echo '  </div>';
                                                echo '  </div>';
                                                //  echo '  </div>';
                                                //echo '  <div class="row">';
                                                echo '<div class="col-md-12">';
                                                echo '<div class="form-group">';
                                                echo '<label> Accessiores : </label>';
                                                echo '<div class="checkbox checkbox-inline checkbox-primary">';
                                                echo '<input id="form-4-1" name="ch1[]" value="Battery" type="checkbox" >';
                                                echo '<label value="Battery" for="form-4-1">Battery</label>';
                                                echo '</div>';
                                                echo '<div class="checkbox checkbox-inline checkbox-primary">';
                                                echo '<input id="form-4-2" name="ch1[]" value="Sim Card" type="checkbox" >';
                                                echo '<label value="Sim Card" for="form-4-2">Sim Card</label>';
                                                echo '</div>';
                                                echo '<div class="checkbox checkbox-inline checkbox-primary">';
                                                echo '<input id="form-4-3" name="ch1[]" value="MMC" type="checkbox" >';
                                                echo '<label value="MMC" for="form-4-3">MMC</label>';
                                                echo '</div>';
                                                echo '<div class="checkbox checkbox-inline checkbox-primary">';
                                                echo '<input id="form-4-4" name="ch1[]" value="Charge" type="checkbox" >';
                                                echo '<label value="Charger" for="form-4-4">Charger</label>';
                                                echo '<div class="checkbox checkbox-inline checkbox-primary">';
                                                echo '<input id="form-4-5" name="ch1[]" value="Cover" type="checkbox" >';
                                                echo '<label value="Cover" for="form-4-5">Cover</label>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';

                                                //echo ' <div class="col-md-3"></div>';
                                                echo ' <div class="col-md-6">';
                                                echo '<div class="form-group">';
                                                echo '<label for="password"><b>Price</b></label>';
                                                echo '<input type="number" class="form-control" id="password" name="price" min="0" required autocomplete="off" >';
                                                echo '</div>';
                                                echo '</div>';

                                                // echo '  </div>';
                                                //echo '<div class="row">';
                                                echo '<div class="col-md-3"></div>';
                                                echo '<div class="col-md-7">';
                                                echo '<div class="text-right mrg-top-5">';
                                                echo ' <button type="submit" class="btn btn-primary" name="save" value="save">Save & Print</button>';
                                                echo ' <button type="reset" class="btn btn-danger" name="clear" value="clear">Clear</button>';
                                                echo '</div>';
                                                echo '</div>';
                                                //echo '<div class="col-md-3"></div>';
                                                // echo '</div>';
                                            }
                                            ?>

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

</div>

<!-- Content Wrapper END -->

<?php include './includes/footer.php'; ?>
<script type="text/javascript">
    $('body').on('keydown', 'input, select, textarea', function (e) {
        var self = $(this)
                , form = self.parents('form:eq(0)')
                , focusable
                , next
                ;
        if (e.keyCode == 13) {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });</script>
</div>