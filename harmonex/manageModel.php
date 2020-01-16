<?php include './includes/config.php'; ?>
<?php
ob_start();

if(isset($_POST['add']))
{
    $brandSelectId    = $_POST['brandID'];
    $modelName        = $_POST['modelName'];
    $queryInsertModel = "INSERT INTO `model`(`model_name`, `brand_id`) VALUES ('$modelName','$brandSelectId')";
    mysqli_query($con, $queryInsertModel);
    
}
?>
<?php include './includes/header.php';?>
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Manage Model</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <?php
                                        $queryAllBrand  = "SELECT * FROM `brand` ";
                                        $resultAllBrand = mysqli_query($con, $queryAllBrand);
                                        
                                        ?>
                                        <div class="row">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Brand Name</label>
                                                    <select name="brandID" class="form-control">
                                                        <?php
                                                        while($rowAllBrand = mysqli_fetch_assoc($resultAllBrand))
                                                        {
                                                            echo "<option value='{$rowAllBrand['brand_id']}'>{$rowAllBrand['brand_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Model Name</label>
                                                    <input type="text" class="form-control"  id="branch_name" name="modelName" required autocomplete="off" placeholder="Model Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button type="submit" class="btn btn-primary" name="add" value="Add">Add</button>
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
                        <h4 class="card-title">All Model`s</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="table-overflow">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Band Name</th>
                                                <th>Model Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          $queryReturnModel  = "SELECT * FROM `model`  INNER JOIN `brand` ON brand.brand_id = model.brand_id";
                                          $resultReturnModel = mysqli_query($con, $queryReturnModel);
                                            while ($rowReturnModel = mysqli_fetch_assoc($resultReturnModel)) {
                                                echo '<tr>';
                                                echo "<td>{$rowReturnModel['model_id']}</td>";
                                                echo "<td>{$rowReturnModel['model_name']}</td>";
                                                echo "<td>{$rowReturnModel['brand_name']}</td>";
                                                echo "<td><a href='editModel.php?id={$rowReturnModel['model_id']}'>Edit</a></td>";
                                                echo "<td><a href='deleteModel.php?id={$rowReturnModel['model_id']}'>Delete</a></td>";
                                                echo '</tr>';
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