<?php
session_start();
ob_start();
include './includes/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:login.php");
}

$admin_id = $_SESSION['admin_id'];
$sql = "SELECT  * FROM admin  WHERE admin_id=$admin_id";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>


    <!-- Mirrored from themenate.com/espire/html/dist/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2019 13:51:42 GMT -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
        <title>Harmonex - System</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/logo/favicon.png">

        <!-- plugins css -->
        <link rel="stylesheet" href="assets/vendors/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendors/PACE/themes/blue/pace-theme-minimal.css" />
        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />

        <!-- page plugins css -->
        <link rel="stylesheet" href="assets/vendors/selectize/dist/css/selectize.default.css" />
        <link rel="stylesheet" href="assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
        <link rel="stylesheet" href="assets/vendors/nvd3/build/nv.d3.min.css" />

        <!-- core css -->
        <link href="assets/css/ei-icon.css" rel="stylesheet">
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/animate.min.css" rel="stylesheet">
        <link href="assets/css/app.css" rel="stylesheet">
        <link href="assets/css/print.css" rel="stylesheet">
        <style type="text/css">
            html, body { height: auto; }

            .print:last-child{
                page-break-after: auto;

            }
            .print{
                border: 1px solid #000;
            }
            .printmessage{

                margin-left:120px;
                color:#000;
                font-size:45px;
                font-weight:bolder;
            }
            .printsubmessage{
                margin-left:120px;
                color: #000;
                font-size: 25px;
                font-weight: bold; 
            }
        </style>

    </head>

    <body>
        <div class="app">
            <div class="layout">
                <!-- Side Nav START -->
                <div class="side-nav">
                    <div class="side-nav-inner">
                        <div class="side-nav-logo">
                            <a href="">
                                <div  class="logo logo-dark" style="  background-image: url('assets/images/logo/logo_transparent.png')"></div>
                                <div class="logo logo-white" style="background-image: url('assets/images/logo/logo_transparent.png')"></div>

                            </a>

                        </div>
                        <ul class="side-nav-menu scrollable">
                            <!-- ClassRoom | End -->
                            <li class="nav-item">
                                <a class="" href="index.php"  <?php 
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }?>>
                                    <span class="icon-example">
                                        <i class="ti-pencil-alt"></i>
                                    </span>
                                    <span class="title">Daily Chat</span>
                                </a>
                            </li>

                            <li class="nav-item  "> 
                                <a class="" href="manageUser.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>   
                                    <span class="icon-holder">
                                        <i class="ti-user"></i>
                                    </span>
                                    <span class="title">Add Or Del User</span>
                                </a>
                            </li>
                            <!-- Admin | Start -->
                            <!-- Admin | End -->
                            <!-- Instructor | Start -->
                            <li class="nav-item dropdown">
                                <a class="" href="manageBranch.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-id-badge"></i>
                                    </span>
                                    <span class="title">Add Branch</span>
                                </a>
                            </li>
                            <!-- Instructor | End -->
                            <!-- ClassRoom | Start -->
                            <li class="nav-item">
                                <a class="" href="manageCustomer.php" <?php
                                if ($row['admin_prev'] == 'callcenter') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-receipt"></i>
                                    </span>
                                    <span class="title">New Customer</span>
                                </a>
                            </li>
                            <!-- ClassRoom | End -->
                            <!-- ClassRoom | Start -->
                            <li class="nav-item">
                                <a class="" href="manageReception.php" <?php
                                if ($row['admin_prev'] == 'callcenter') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-info"></i>
                                    </span>
                                    <span class="title">Reception</span>
                                </a>
                            </li>
                            <!-- ClassRoom | End -->
                            <!-- ClassRoom | Start -->
                            <li class="nav-item">
                                <a class="" href="manageCallCenter.php" <?php
                                if ($row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-mobile"></i>
                                    </span>
                                    <span class="title">Call Center</span>
                                </a>
                            </li>
                            <!-- ClassRoom | End -->
                            <!-- Courses | Start -->
                            <li class="nav-item">
                                <a class="" href="manageInvoice.php" <?php
                                if ($row['admin_prev'] == 'callcenter') {
                                    echo'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-info"></i>
                                    </span>
                                    <span class="title">Manage Invoice</span>
                                </a>
                            </li>
                            <!-- Courses | End -->
                            <li class="nav-item">
                                <a class="" href="manageCheck.php">
                                    <span class="icon-holder">
                                        <i class="ti-comment"></i>
                                    </span>
                                    <span class="title">Prices</span>
                                </a>
                            </li>
                            <!-- ClassRoom | End -->

                            <!-- ClassRoom | End -->
                            <li class="nav-item " >
                                <a class="" href="manageReporting.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-money"></i>
                                    </span>
                                    <span class="title">Daily Checked Out Devices</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="manageBrand.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-pencil-alt"></i>
                                    </span>
                                    <span class="title">Add Brand</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="manageModel.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-check"></i>
                                    </span>
                                    <span class="title">Add Category</span>
                                </a>
                            </li>
                              <!-- ClassRoom | End -->
                            <li class="nav-item">
                                <a class="" href="manageSubModel.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-view-grid"></i>
                                    </span>
                                    <span class="title">Add Sub Category</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="manageMaintenance.php" <?php
                                if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                    echo 'hidden';
                                }
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-pencil-alt"></i>
                                    </span>
                                    <span class="title">Category Option</span>
                                </a>
                            </li>
                            
                          <!--  <li class="nav-item">
                                <a class="" href="manageOffer.php" <?php
                                //if ($row['admin_prev'] == 'callcenter' || $row['admin_prev'] == 'reception') {
                                   // echo 'hidden';
                                //}
                                ?>>
                                    <span class="icon-holder">
                                        <i class="ti-pencil-alt"></i>
                                    </span>
                                    <span class="title">Manage Offer`s</span>
                                </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
                <!-- Side Nav END -->

                <!-- Page Container START -->
                <div class="page-container">
                    <!-- Header START -->
                    <div class="header navbar">
                        <div class="header-container">
                            <ul class="nav-left">
                                <li>
                                    <a class="side-nav-toggle" href="javascript:void(0);">
                                        <i class="ti-view-grid"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <li class="user-profile dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-info">
                                            <span class="name pdd-right-5 text-lowercase text-capitalize">Welcome Mr.<?php echo $_SESSION['admin_name']; ?></span>
                                            <i class="ti-angle-down font-size-10"></i>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <i class=" pdd-right-10" ></i>
                                            <span style="color: blue; margin-left: 10px;"> <?php echo $row['admin_prev']; ?></span>
                                        </li>
                                        <li>
                                            <a href="<?php echo $_SERVER['PHP_SELF'] . '?logout=1'; ?>">
                                                <i class="ti-power-off pdd-right-10"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header END -->

                    <!-- theme configurator START -->
                    <div class="theme-configurator">
                        <div class="configurator-wrapper">
                            <div class="config-header">
                                <h4 class="config-title">Config Panel</h4>
                                <button class="config-close">
                                    <i class="ti-close"></i>
                                </button>
                            </div>
                            <div class="config-body">
                                <div class="mrg-btm-30">
                                    <p class="lead font-weight-normal">Header Color</p>
                                    <div class="theme-colors header-default">
                                        <input type="radio" id="header-default" name="theme">
                                        <label for="header-default"></label>
                                    </div>
                                    <div class="theme-colors header-primary">
                                        <input type="radio" class="primary" id="header-primary" name="theme">
                                        <label for="header-primary"></label>
                                    </div>
                                    <div class="theme-colors header-info">
                                        <input type="radio" id="header-info" name="theme">
                                        <label for="header-info"></label>
                                    </div>
                                    <div class="theme-colors header-success">
                                        <input type="radio" id="header-success" name="theme">
                                        <label for="header-success"></label>
                                    </div>
                                    <div class="theme-colors header-danger">
                                        <input type="radio" id="header-danger" name="theme">
                                        <label for="header-danger"></label>
                                    </div>
                                    <div class="theme-colors header-dark">
                                        <input type="radio" id="header-dark" name="theme">
                                        <label for="header-dark"></label>
                                    </div>
                                </div>
                                <div class="mrg-btm-30">
                                    <p class="lead font-weight-normal">Sidebar Color</p>
                                    <div class="theme-colors sidenav-default">
                                        <input type="radio" id="sidenav-default" name="sidenav">
                                        <label for="sidenav-default"></label>
                                    </div>
                                    <div class="theme-colors side-nav-dark">
                                        <input type="radio" id="side-nav-dark" name="sidenav">
                                        <label for="side-nav-dark"></label>
                                    </div>
                                </div>
                                <div class="mrg-btm-30">
                                    <p class="lead font-weight-normal no-mrg-btm">RTL</p>
                                    <div class="toggle-checkbox checkbox-inline toggle-sm mrg-top-10">
                                        <input type="checkbox" name="rtl-toogle" id="rtl-toogle">
                                        <label for="rtl-toogle"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- theme configurator END -->

                    <!-- Theme Toggle Button START -->
                    <button class="theme-toggle btn btn-rounded btn-icon">
                        <i class="ti-palette"></i>
                    </button>
                    <!-- Theme Toggle Button END -->