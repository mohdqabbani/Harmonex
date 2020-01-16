<?php include './includes/config.php'; ?>
<?php
ob_start();
if (isset($_POST['add'])) {
    $model_id = $_POST['modelname'];
    $sub_name = $_POST['modelNa'];
    $queryInsSub = "INSERT INTO `sub_model`( `sub_name`, `model_id`) VALUES ('$sub_name','$model_id')";
    mysqli_query($con, $queryInsSub);
    header('Location: manageSubModel.php');
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
                                                    <label for="branch_name">Brand Name :</label>
                                                    <select name="modelname" id="brandName" class="form-control">
                                                        <?php
                                                        $sqlB = "SELECT * FROM `brand`";
                                                        $resB = mysqli_query($con, $sqlB);
                                                        echo "<option></option>";
                                                        while ($rowM = mysqli_fetch_assoc($resB)) {
                                                            echo "<tr>";
                                                            
                                                            echo "<option value='{$rowM['brand_id']}'>{$rowM['brand_name']}</option>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Model</label>
                                                    <select name="modelname" id="subModel" class="form-control">
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Model Name</label>
                                                    <input type="text" class="form-control"  name="modelNa" required autocomplete="off" placeholder="Model Name">
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
                        <h4 class="card-title">All Sub Model`s</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="table-overflow">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sub Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $quertSelSub = "SELECT * FROM `sub_model` ";
                                            $resMoSel = mysqli_query($con, $quertSelSub);
                                            while ($rowSelSub = mysqli_fetch_assoc($resMoSel)) {
                                                echo "<tr>";
                                                echo "<td>{$rowSelSub['sub_id']}</td>";
                                                echo "<td>{$rowSelSub['sub_name']}</td>";
                                                echo "<td><a href='editSubModel.php?sub_id={$rowSelSub['sub_id']}'>Edit</a></td>";
                                                echo "<td><a href='deleteSubModel.php?sub_id={$rowSelSub['sub_id']}'>Delete</a></td>";
                                                echo "</tr>";
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function ()
    {
        $('#brandName').change(function () {
            //get selected parent option 
            var brand_id = $("#brandName").val();
            $.ajax(
                    {
                        type: "GET",
                        url: "ajaxSubM.php?brand_id=" + brand_id,
                        cache: false,
                        success: function (data)
                        {
                            $("#subModel").html("");
                            $("#subModel").append(data);
                        }
                    });
        });
        
    });
</script>

<?php include './includes/footer.php'; ?>