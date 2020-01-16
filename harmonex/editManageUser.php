<?php include './includes/config.php'; ?>
<?php
ob_start();
$admin_id = $_GET['id'];
$queryedit = " SELECT * FROM `admin` WHERE `admin_id` = $admin_id ";
$resultes = mysqli_query($con, $queryedit);
$row5 = mysqli_fetch_assoc($resultes);


if (isset($_POST['edit'])) {
    $admin_name = $_POST['adminName'];
    $admin_password = $_POST['adminPassword'];
    $admin_prev = $_POST['adminPriv'];
    $branch_id = $_POST['branch'];
    $encryptPass = md5($admin_password);
    $sql = "UPDATE `admin` SET `admin_name`='$admin_name',`admin_password`='$encryptPass',`admin_prev`='$admin_prev',`branch_id`=$branch_id WHERE `admin_id` = $admin_id";
    $result = mysqli_query($con, $sql);
    header("Location:manageUser.php");
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
                        <h4 class="card-title">Add New Admin</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="adminName" required autocomplete="off" value="<?php echo $row5['admin_name'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="adminPassword" required autocomplete="off" value="<?php echo $row5['admin_password']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Branch :</label>
                                                    <select name="branch" required class="form-control">

                                                        <?php
                                                        $queryBracnh = "SELECT * FROM `branch` ";
                                                        $result = mysqli_query($con, $queryBracnh);
                                                        while ($row = mysqli_fetch_assoc($result)) {

                                                            echo "<option";
                                                            if ($row['branch_id'] == $row5['branch_id'])
                                                                echo " selected value='{$row['branch_id']}'>{$row['branch_name']}";
                                                            echo "</option>";
                                                            if ($row['branch_id'] != $row5['branch_id'])
                                                                echo "<option";
                                                            echo "  value='{$row['branch_id']}'>{$row['branch_name']}";
                                                            echo "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <label for="password">Admin Privigen :</label>
                                                    <select name="adminPriv" class="form-control">
                                                        <option    value="callcenter" <?php
                                                        if ($row5['admin_prev'] == 'callcenter') {
                                                            echo "selected";
                                                        }
                                                        ?> >Call center</option>
                                                        <option      value="reception" <?php
                                                        if ($row5['admin_prev'] == 'reception') {
                                                            echo "selected ";
                                                        }
                                                        ?>> Reception </option>
                                                        <option    value="admin" <?php
                                                        if ($row5['admin_prev'] == 'admin') {
                                                            echo " selected";
                                                        }
                                                        ?> > Admin </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button id="btnSave" type="submit" class="btn btn-primary" name="edit" value="Save">Save</button>
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

            $("#btnSave").click(function () {
                alert("Edit user successfully");
            });
        });
    </script>
    <?php include './includes/footer.php'; ?>