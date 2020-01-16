<?php include './includes/config.php'; ?>
<?php
ob_start();

if (isset($_POST['sign-in'])) { 
    session_start();
    $name       = $_POST['name'];
    $password   = $_POST['password'];
    $encryptMd  = md5($password);
    $querySignUp = "SELECT * FROM `admin` inner join branch ON branch.branch_id= admin.branch_id WHERE `admin_name` = '$name' AND `admin_password` = '$encryptMd' ";
    $resultSignUp = mysqli_query($con, $querySignUp);
    $rowSignUp = mysqli_fetch_assoc($resultSignUp);
    if ($rowSignUp['admin_name'] == $name && $rowSignUp['admin_password'] == $encryptMd) {
        $_SESSION['admin_id']    = $rowSignUp['admin_id'];
        $_SESSION['admin_name']  = $rowSignUp['admin_name'];
        $_SESSION['admin_prev']  = $rowSignUp['admin_prev'];
        $_SESSION['branch_id']   = $rowSignUp['branch_id'];
        $_SESSION['branch_name']   = $rowSignUp['branch_name'];
        if($_SESSION['admin_prev'] == 'admin')
        {
        header("Location: index.php");
        }else if($_SESSION['admin_prev'] == 'callcenter')
        {
            header("Location: manageCheck.php");
        }else if ($_SESSION['admin_prev']  == 'reception')
        {
            header("Location: manageCustomer.php");
        }
        exit();
    }
}
?>
<!DOCTYPE html>
<html>


    <!-- Mirrored from themenate.com/espire/html/dist/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2019 14:00:59 GMT -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
        <title>Harmonex System</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/logo/favicon.png">

        <!-- plugins css -->
        <link rel="stylesheet" href="assets/vendors/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendors/PACE/themes/blue/pace-theme-minimal.css" />
        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />
        <link rel="stylesheet" href="assets/css/sweetalert.css" />

        <!-- core css -->
        <link href="assets/css/ei-icon.css" rel="stylesheet">
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/animate.min.css" rel="stylesheet">
        <link href="assets/css/app.css" rel="stylesheet">

    </head>

    <body>
        <div class="app">
            <?php //if($msg) echo '<div class="alert position-absolute" style="right:0;z-index:999"></div>';    ?>
            <div class="authentication">
                <div class="sign-in">
                    <div class="row no-mrg-horizon">
                        <div class="col-md-8 no-pdd-horizon d-none d-md-block">
                            <div class="full-height bg" style="background-image: url('assets/images/logo/logo_image.jpg')">
                                <div class="img-caption">
                                    <h1 class="caption-title">Harmonex Login </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 no-pdd-horizon">
                            <div class="full-height bg-white height-100">
                                <div class="vertical-align full-height pdd-horizon-70">
                                    <div class="table-cell">
                                        <div class="pdd-horizon-15">
                                            <h2>Login</h2>
                                            <p class="mrg-btm-15 font-size-13">Please enter your user name and password to login</p>
                                            <form action=""  role="form" id="form-validation" method="post">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" placeholder="User name" required autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
                                                </div>
                                                <button name="sign-in" class="btn btn-info">Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="login-footer">
                                    <!--<img class="img-responsive inline-block" src="assets/images/allimages/harmo.png" width="100" alt="">->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="assets/js/vendor.js"></script>
    
        <script src="assets/js/app.min.js"></script>
    
                                    <!-- page plugins js -->
                                    <script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>

                                    <!-- page js -->
                                    <script src="assets/js/forms/form-validation.js"></script>
                                    <script src="assets/vendors/sweetalert/lib/sweet-alert.js"></script>
                                    <script src="assets/vendors/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>

       <!-- <script>
            (function ($) {
                'use strict';
                $('.alert').noty({
                    theme: 'app-noty',
                    text: 'Username or Password incorrect',
                    type: 'error',
                    timeout: 3000,
                    layout: 'topRight',
                    closeWith: ['button', 'click'],
                    animation: {
                        open: 'noty-animation fadeIn',
                        close: 'noty-animation fadeOut'
                    }
                });
            })(jQuery); 
        </script> -->

                                    </body>


                                    <!-- Mirrored from themenate.com/espire/html/dist/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2019 14:01:20 GMT -->
                                    </html>