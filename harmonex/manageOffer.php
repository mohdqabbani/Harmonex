<?php include './includes/config.php'; ?>
<?php
ob_start();

if(isset($_POST['save']))
{
    $offerName = $_POST['offerName'];
    
    if($_FILES['offerImage']['error'] == 0 )
    {
        $offer_image = $_FILES['offerImage']['name'];
        $offer_temp  = $_FILES['offerImage']['tmp_name'];
        $path        = "../admin/assets/offerImages/";
        $mov =   move_uploaded_file($offer_temp,$path . $offer_image);
         
    }
    $location = $path.$offer_image;
    $queryInsertOffer  = "INSERT INTO `offer`( `offer_name`, `offer_image`) VALUES ('$offerName','$location')";
    mysqli_query($con, $queryInsertOffer);
    header("Location: manageOffer.php");
    exit();
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
                        <h4 class="card-title">Manage Offer`s</h4>
                    </div>
                    <div class="card-block">
                        <div class="mrg-top-40">
                            <div class="row">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <form action="" method="post" role="form" id="form-validation" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Offer Name </label>
                                                    <input type="text" class="form-control" id="branch_name" name="offerName" required autocomplete="off" placeholder="Offer Name">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="branch_name">Upload Image </label>
                                                    <input type="file" class="form-control"  name="offerImage" required autocomplete="off" placeholder="Offer Image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right mrg-top-5">
                                                    <button type="submit" class="btn btn-primary" name="save" value="Save">Save</button>
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
                        <h4 class="card-title">Manage Offer`s</h4>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="table-overflow">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                               
                                                <th>Offer Name</th>
                                                <th>Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                            
                                            $queryShowOffer  = "SELECT * FROM `offer` ";
                                            $resultQuerOffer = mysqli_query($con, $queryShowOffer);
                                            while($rowShowOffer = mysqli_fetch_assoc($resultQuerOffer))
                                            {
                                                echo "<tr>";
                                                echo "<td>{$rowShowOffer['offer_name']}</td>";
                                                echo "<td>  <img src='http://localhost/Harmonex{$rowShowOffer['offer_image']}' width='150px' height='150px'/></td>";
                                                 
                                                 echo "<td><a href=''>Edit</a></td>";
                                                echo "<td><a href=''>Delete</a></td>";
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
<!-- Content Wrapper END -->

<?php include './includes/footer.php'; ?>