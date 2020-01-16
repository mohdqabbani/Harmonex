<?php include './includes/header.php'; ?>
<?php
ob_start();

if (isset($_POST['create'])) {
    $adminName = $_POST['adminName'];
    $password = $_POST['password'];
    $encryptPass = md5($password);
    $branchid = $_POST['branch'];
    $admin_prev = $_POST['adminPriv'];
    $query = "INSERT INTO `admin`(`admin_name`, `admin_password`, `admin_prev`, `branch_id`) VALUES ('$adminName','$encryptPass','$admin_prev','$branchid')";
    $result = mysqli_query($con, $query);
    $rowLogin = mysqli_fetch_assoc($result);

    header("Location: manageUser.php");

    exit();
}
?>


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
                                                    <input type="text" class="form-control" id="full_name" name="adminName" required autocomplete="off" placeholder="Admin Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" required autocomplete="off" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Branch</label>
                                                    <select name="branch" required class="form-control">
                                                        <?php
                                                        $queryBracnh = "SELECT * FROM `branch` ";
                                                        $result = mysqli_query($con, $queryBracnh);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='{$row['branch_id']}'>{$row['branch_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Admin Privigen</label>
                                                    <select name="adminPriv" class="form-control">
                                                        <option  value="callcenter">Call center</option>
                                                        <option value="reception"> Reception </option>
                                                        <option value="admin"> Admin </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button id="btnSave" type="submit" class="btn btn-primary" name="create" value="create">Create</button>
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
                        <h4 class="card-title">Manage Admins</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="table-overflow">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                               <!-- <th>Password</th> -->
                                                <th>Admin Prev</th>
                                                <th>Branch Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //$sql    = "SELECT * FROM `admin` ";
                                            // $query2 = "SELECT admin.branch_id , branch.branch_name FROM admin INNER JOIN branch ON admin.admin_id = branch.branch_id";
                                            $sql = "SELECT * FROM admin INNER JOIN branch ON admin.branch_id = branch.branch_id";

                                            //$result = mysqli_query($con, $query2);

                                            $res = mysqli_query($con, $sql);
                                            while ($row7 = mysqli_fetch_assoc($res)) {
                                                echo '<tr>';
                                                echo "<td>{$row7['admin_id']}</td>";
                                                echo "<td>{$row7['admin_name']}</td>";
                                                //echo "<td>{$row7['admin_password']}</td>";
                                                echo "<td>{$row7['admin_prev']}</td>";
                                                // echo "<td>{$row['branch_id']}</td>";
                                                echo "<td>{$row7['branch_name']}</td>";
                                                echo "<td><a href='editManageUser.php?id={$row7['admin_id']}'>Edit</a></td>";
                                                echo "<td><a href='deleteManageUser.php?id={$row7['admin_id']}'>Delete</a></td>";
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {

        $("#btnSave").click(function () {
            alert("Create new user successfully");
        });
    });
</script>
<?php include 'includes/footer.php'; ?>