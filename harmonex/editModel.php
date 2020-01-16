<?php include './includes/config.php'; ?>
<?php
ob_start();

$idBrand = $_GET['id'];
$queryModel = "SELECT * FROM `model` WHERE `model_id` = '$idBrand'";
$resModel = mysqli_query($con, $queryModel);
$rowModel = mysqli_fetch_assoc($resModel);
if(isset($_POST['Edit']))
{
    $nameModel = $_POST['modelName'];
    $brandName2 = $_POST['brandid'];
    $queryEditModel  = "UPDATE `model` SET `model_name`='$nameModel',`brand_id`= '$brandName2' WHERE `model_id`= '{$rowModel['model_id']}'";
    
     mysqli_query($con, $queryEditModel);
     header("Location: manageModel.php");
     exit();
    
}
?>
<?php  include './includes/header.php'; ?>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Manage Brand</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Brand Name</label>
                                                    <select name="brandid" class="form-control">
                                                        <?php
                                                        $queryBrand = "SELECT * FROM `brand`";
                                                        $resBrand = mysqli_query($con, $queryBrand);
                                                        while ($rowBrand = mysqli_fetch_assoc($resBrand)) {
                                                            if ($rowModel['brand_id'] == $rowBrand['brand_id'])
                                                                echo "<option";
                                                            echo " selected value='{$rowBrand['brand_id']}'>{$rowBrand['brand_name']}";
                                                            echo "</option>";
                                                            if ($rowModel['brand_id'] != $rowBrand['brand_id'])
                                                                echo "<option";
                                                            echo "  value='{$rowBrand['brand_id']}'>{$rowBrand['brand_name']}";
                                                            echo "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Model Name</label>
                                                    <input type="text" class="form-control"  id="branch_name" name="modelName" required autocomplete="off" value="<?php echo $rowModel['model_name']; ?>">
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