<?php include './includes/config.php'; ?>
<?php
ob_start();
$querySub = "SELECT * FROM `sub_model` WHERE `sub_id` = '{$_GET['sub_id']}'";
$resSub = mysqli_query($con, $querySub);
$rowSub = mysqli_fetch_assoc($resSub);
if(isset($_POST['edit'])){
    $nameSub  = $_POST['subModel'];
    $model_ID = $_POST['modelName'];
    $querySubEdit  = " UPDATE `sub_model` SET `sub_name`= '$nameSub',`model_id`='$model_ID' WHERE `sub_id` ='{$_GET['sub_id']}'";
    mysqli_query($con, $querySubEdit);
    header("Location: manageSubModel.php");
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
                        <h4 class="card-title">Manage Sub Model</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Model</label>
                                                    <select name="modelName" class="form-control">
                                                        <?php
                                                        $queryS = "SELECT * FROM `model` ";
                                                        $resS = mysqli_query($con, $queryS);
                                                        while ($rowM = mysqli_fetch_assoc($resS)) {
                                                            echo "<tr>";
                                                            echo "<option";
                                                            if ($rowM['model_id'] == $rowSub['model_id'])
                                                                echo " selected value='{$rowSub['model_id']}'>{$rowM['model_name']}";
                                                            echo "</option>";
                                                            if ($rowM['model_id'] != $rowSub['model_id'])
                                                                echo "<option";
                                                            echo "  value='{$rowM['model_id']}'>{$rowM['model_name']}";
                                                            echo "</option>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Sub Model</label>
                                                    <input type="text" class="form-control"  id="branch_name" name="subModel" required autocomplete="off" value="<?php echo $rowSub['sub_name'] ;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button type="submit" class="btn btn-primary" name="edit" value="edit">Edit</button>
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
    <?php include './includes/footer.php'; ?>