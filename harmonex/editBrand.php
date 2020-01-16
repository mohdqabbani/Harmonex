<?php include './includes/config.php'; ?>
<?php
ob_start();

$brandId = $_GET['id'];
if (isset($_POST['Edit'])) {

    $brandEdit = $_POST['brandName'];
    $queryEditBrand = " UPDATE `brand` SET `brand_name`='$brandEdit' WHERE `brand_id` = '$brandId'";
    $resultBrand = mysqli_query($con, $queryEditBrand);

    header("Location: manageBrand.php");
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
                        <h4 class="card-title">Manage Brand</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
<?php
$quertSlectBrand = "Select * FROM brand WHERE  `brand_id` = '$brandId'";
$resultBrandSele = mysqli_query($con, $quertSlectBrand);
$rowSelBrand = mysqli_fetch_assoc($resultBrandSele);
?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Brand Name</label>
                                                    <input type="text" class="form-control" value="<?php echo "{$rowSelBrand['brand_name']}"; ?>" id="branch_name" name="brandName" required autocomplete="off" placeholder="Brand Name">
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