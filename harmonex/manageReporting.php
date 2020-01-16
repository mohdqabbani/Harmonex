<?php include './includes/header.php'; ?>
<?php include './includes/config.php'; ?>
<?php
ob_start();
//if (isset($_POST['search'])) {
// $nameBr = $_POST['brName'];
//$strDate = $_POST['stDate'];
//$endDate = $_POST['enDate'];
// $devStatus = $_POST['deStatus'];
// header("Location: GenerateReporting.php?brName=$nameBr&stDate=$strDate&enDate=$endDate&deStatus=$devStatus");
//exit(); 
//}
?>
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Manage Reporting</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="branch_name"><b>Branch Name</b></label>
                                                    <select class="form-control" name="brName" id="brName">
                                                        <?php
                                                        $queryBr = "SELECT * FROM `branch` ";
                                                        $resBr = mysqli_query($con, $queryBr);
                                                        echo '<option></option>';
                                                        while ($rowBr = mysqli_fetch_assoc($resBr)) {
                                                            echo " <option value='{$rowBr['branch_id']}'>{$rowBr['branch_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
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
                        <h4 class="card-title">Reporting By Branch And Status</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="table-overflow">
                                    <table class="table">
                                        <thead>
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
                                                <th style="font-size: 10px;">Status</th>
                                                <th style="font-size: 10px;">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ajaxtable">
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#brName').change(function () {
            //get selected parent option 
           // var deStatus = $('#brName').val();

            var brName = $("#brName").val();
            $.ajax(
                    {
                        type: "GET",
                       // url: "ajaxReporting.php?"+"brName="+brName+"&deStatus="+deStatus,
                         url: "ajaxReporting.php?"+"brName="+brName,
                        cache: false,
                        success: function (data)
                        {
                            $("#ajaxtable").html("");
                            $("#ajaxtable").append(data);
                        }
                    });
        });

    });
</script>




<?php include './includes/footer.php'; ?>