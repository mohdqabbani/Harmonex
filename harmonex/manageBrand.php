<?php include './includes/header.php';?>
<?php include './includes/config.php'; ?>
<?php
ob_start();
if(isset($_POST['add']))
{
    $brandName     = $_POST['brandName'];
    $queryAddBrand = " INSERT INTO `brand`(`brand_name`) VALUES ('$brandName')";
    $resultBrand   = mysqli_query($con, $queryAddBrand);
    
    
}

?>


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
                                                    <input type="text" class="form-control"  id="branch_name" name="brandName" required autocomplete="off" placeholder="Brand Name">
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
                        <h4 class="card-title">All Brand`s</h4>
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
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $quertSelectBrand = "SELECT * FROM `brand` ";
                                            $resultBrand = mysqli_query($con, $quertSelectBrand);
                                            while ($row = mysqli_fetch_assoc($resultBrand)) {
                                                echo '<tr>';
                                                echo "<td>{$row['brand_id']}</td>";
                                                echo "<td>{$row['brand_name']}</td>";
                                                echo "<td><a href='editBrand.php?id={$row['brand_id']}'>Edit</a></td>";
                                                echo "<td><a href='deleteBrand.php?id={$row['brand_id']}'>Delete</a></td>";
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