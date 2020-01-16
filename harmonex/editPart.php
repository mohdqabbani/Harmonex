<?php include './includes/config.php'; ?>
<?php
ob_start();

$partId = $_GET['id'];
$subid = $_GET['sub_id'];

$queryPart = "SELECT * FROM `changing_parts` WHERE `part_id`= '$partId'";
$resqueryPart = mysqli_query($con, $queryPart);
$rowPart = mysqli_fetch_assoc($resqueryPart);
if(isset($_POST['Edit']))
{
    $partNameEnglish = $_POST['partNameEn'];
    $partNameArabic  = $_POST['partNameAr'];
    $partPrice       = $_POST['partPrice'];
   // $quertUpdatePart   = "UPDATE `changing_parts` SET `model_id`='$modelName2',`part_name`='$partName2',`part_price`='$partPrice2'  WHERE `part_id` = '$partId'";
   $quertUpdatePart  = " UPDATE `changing_parts` SET `Sub_id`='{$_GET['sub_id']}',`part_name_en`='$partNameEnglish',"
           . "`part_name_ar`='$partNameArabic',`part_price`='$partPrice' WHERE `part_id` = '$partId'";
    mysqli_query($con, $quertUpdatePart);
    header("Location:manageMaintenance.php");
    exit();
}
?>
<?php include './includes/header.php'; ?>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Edit Maintenance Part</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                          
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Part Name English </label>
                                                    <input type="text" class="form-control"  id="branch_name" 
                                                           name="partNameEn" required autocomplete="off" 
                                                           value="<?php echo $rowPart['part_name_en']; ?>">
                                                </div>
                                            </div>
                                               <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Part Name Arabic </label>
                                                    <input type="text" class="form-control"  id="branch_name"
                                                           name="partNameAr" required autocomplete="off" 
                                                           value="<?php echo $rowPart['part_name_ar']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Part Price </label>
                                                    <input type="text" class="form-control"  id="branch_name" 
                                                           name="partPrice" required autocomplete="off" 
                                                           value="<?php echo $rowPart['part_price']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button type="submit" class="btn btn-primary" name="Edit" value="Edit">Edit</button>
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

</div>
<!-- Content Wrapper END -->

<?php include './includes/footer.php'; ?>