<?php include './includes/config.php' ?>;
<?php
ob_start();

$branch_id = $_GET['id'];
$query = "SELECT * FROM `branch` WHERE `branch_id` = $branch_id";
$result = mysqli_query($con, $query);
$rowEditBranch = mysqli_fetch_assoc($result);
if (isset($_POST['edit'])) {
    $branch_name = $_POST['branchName'];
    $query2 = "UPDATE `branch` SET `branch_name`='$branch_name' WHERE `branch_id`=$branch_id";
    $res = mysqli_query($con, $query2);
    header("Location:manageBranch.php");
    exit();
}
?>

<?php include './includes/header.php'; ?>

<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Edit Branch</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Branch Name</label>
                                                    <input type="text" class="form-control" 
                                                           id="branch_name" name="branchName" 
                                                           required autocomplete="off" value="<?php echo $rowEditBranch['branch_name']; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button id="btnEdit" type="submit" class="btn btn-primary" name="edit" value="edit">Edit</button>
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
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function ()
    {
        
          $("#btnEdit").click(function () {
                alert("Edit Branch successfully");
            });
    });
</script>
    <?php include './includes/footer.php'; ?>