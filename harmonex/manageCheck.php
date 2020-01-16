<?php include './includes/header.php';?>
<?php include './includes/config.php'; ?>
<?php
ob_start();
if (isset($_POST['Clear'])) {
    header("Location: manageCheck.php");
}
?>

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Check About Product`s</h4>
                    </div>
                    <div class="card">
                        <div class="mrg-top-1">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="branch_name">Brand Name</label>
                                                    <select name="brandName" id="BrandN" class="form-control">
                                                        <?php
                                                        $queryNameBrand = "SELECT * FROM `brand`";
                                                        $resNameBrand = mysqli_query($con, $queryNameBrand);
                                                        echo "<option></option>";
                                                        while ($rowNameBrand = mysqli_fetch_assoc($resNameBrand)) {

                                                            echo "<option value='{$rowNameBrand['brand_id']}'>{$rowNameBrand['brand_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                           </div>
                                       
                                        
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="branch_name">Sub Model</label>
                                                    <select name="modelName" id="subModel" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                       
                                       
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="branch_name">Model Name</label>
                                                    <select name="modelName" id="modelN" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="col-md-3">
                                                <div class="text-right mrg-top-5">
                                                    <button type="submit" class="btn btn-danger" name="Clear"  value="Clear">Clear</button>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Changing Part`s</h4>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto">
                            <div class="table-bordered">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Part Name English</th>
                                            <th>Part Name Arabic</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="searchTable" class="table">

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

<!-- Content Wrapper END -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#BrandN').change(function () {
            //get selected parent option 
            var brand_id = $("#BrandN").val();
            $.ajax(
                    {
                        type: "GET",
                        url: "modelAjax.php?brand_id=" + brand_id,
                        cache: false,
                        success: function (data)
                        {
                            $("#subModel").html("");
                            $("#subModel").append(data);
                        }
                    });
        });


        $('#subModel').change(function () {
            //get selected parent option 
            var subModel = $("#subModel").val();
            $.ajax(
                    {
                        type: "GET",
                        url: "subModelAjax.php?subModel=" + subModel,
                        cache: false,
                        success: function (data)
                        {
                            $("#modelN").html("");
                            $("#modelN").append(data);
                        }
                    });
        });
       $('#modelN').change(function () {
            //get selected parent option 
            var modelN = $("#modelN").val();
            $.ajax(
                    {
                        type: "GET",
                        url: "partAjax.php?modelN=" + modelN,
                        cache: false,
                        success: function (data)
                        {
                            $("#searchTable").html("");
                            $("#searchTable").append(data);
                        }
                    });
        });
        
    });
</script>
<?php include './includes/footer.php'; ?>