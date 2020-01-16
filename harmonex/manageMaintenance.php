<?php include './includes/header.php'; ?>

<?php include './includes/config.php'; ?>
<?php
ob_start();

if (isset($_POST['add'])) {
    $modelId2 = $_POST['subId'];
    $output = '';
    $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
    $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
    if (in_array($extension, $allowed_extension)) { //check selected file extension is present in allowed extension array
        $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
        include("./PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
        $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

        $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            for ($row = 3; $row <= $highestRow; $row++) {
                $output .= "<tr>";
                //name = english
                $name = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                //arabic
                $name2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $email = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $queryAddPart = " INSERT INTO `changing_parts`(`Sub_id`, `part_name_en`, `part_name_ar`, `part_price`) VALUES "
                        . "('$modelId2','" . $name . "','" . $name2 . "', '" . $email . "')";
                //$queryAddPart = " INSERT INTO `changing_parts`(`sub_id`, `part_name`, `part_price`) VALUES "
                // . "('$modelId2','".$name."', '".$email."')";
                // $query = "INSERT INTO tbl_excel(`part_name`, `part_price`) VALUES ('" . $name . "', '" . $name . "')";
                mysqli_query($con, $queryAddPart);
                $output .= '<td>' . $name . '</td>';
                $output .= '<td>' . $name2 . '</td>';
                $output .= '<td>' . $email . '</td>';
                $output .= '</tr>';
            }
        }
        $output .= '</table>';
    } else {
        $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
    }
//    $modelId2 = $_POST['subId'];
//    $partName = $_POST['partName'];
//    $partPrice = $_POST['partPrice'];
//
//    $queryAddPart = " INSERT INTO `changing_parts`(`sub_id`, `part_name`, `part_price`) VALUES ('$modelId2','$partName','$partPrice')";
//    $resultAddPart = mysqli_query($con, $queryAddPart);
    header("Location: manageMaintenance.php");
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
                        <h4 class="card-title">Manage Maintenance</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Brand Name :</label>
                                                    <select name="subId" id="brname" class="form-control">
                                                        <?php
                                                        $queryAllBrand = "SELECT * FROM `brand` ";
                                                        $resultAllBrand = mysqli_query($con, $queryAllBrand);
                                                        echo '<option></option>';
                                                        while ($rowAllBrand = mysqli_fetch_assoc($resultAllBrand)) {
                                                            echo "<option value='{$rowAllBrand ['brand_id']}'>{$rowAllBrand ['brand_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Model Name :</label>
                                                    <select name="subId" id="modelName" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Sub Model Name</label>
                                                    <select name="subId" id="subModel" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Part`s Name</label>
                                                    <input type="file" class="form-control"  id="branch_name" name="excel" required autocomplete="off" placeholder="Part`s Name">
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
                        <h4 class="card-title">All Maintenance Part</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="table-overflow">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style='font-size: 10px;'>Model Name</th>
                                                <th style='font-size: 10px;'> Part Name En</th>
                                                <th style='font-size: 10px;'> Part Name Ar</th>
                                                <th style='font-size: 10px;'>Part Price</th>
                                                <th style='font-size: 10px;'>Edit</th>
                                                <th style='font-size: 10px;'>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $queryShowPart = "SELECT * FROM `changing_parts`  INNER JOIN `sub_model` ON changing_parts.sub_id  = sub_model.sub_id";
                                            $resultShowPart = mysqli_query($con, $queryShowPart);
                                            while ($rowShowPart = mysqli_fetch_assoc($resultShowPart)) {
                                                echo "<tr>";
                                                echo "<td style='font-size: 10px;'>{$rowShowPart['part_id']} </td>";
                                                echo "<td style='font-size: 10px;'>{$rowShowPart['sub_name']} </td>";
                                                echo "<td style='font-size: 10px;'>{$rowShowPart['part_name_en']} </td>";
                                                echo "<td style='font-size: 10px;'>{$rowShowPart['part_name_ar']} </td>";
                                                echo "<td style='font-size: 10px;'>{$rowShowPart['part_price']} </td>";
                                                echo "<td style='font-size: 10px;'><a href='editPart.php?id={$rowShowPart['part_id']}&sub_id={$rowShowPart['sub_id']}'>Edit</a></td>";
                                                echo "<td style='font-size: 10px;'><a href='deletePart.php?id={$rowShowPart['part_id']}'>Delete</a></td>";
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
        $('#brname').change(function () {
            //get selected parent option 
            var brand_id = $("#brname").val();
            $.ajax(
                    {
                        type: "GET",
                        url: "modelAjax.php?brand_id=" + brand_id,
                        cache: false,
                        success: function (data)
                        {
                            $("#modelName").html("");
                            $("#modelName").append(data);
                        }
                    });
        });
        $('#modelName').change(function () {
            //get selected parent option 
            var subModel = $("#modelName").val();
            $.ajax(
                    {
                        type: "GET",
                        url: "subModelAjax.php?subModel=" + subModel,
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