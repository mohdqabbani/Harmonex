<?php include "includes/header.php" ?>
<?php
ob_start();
$cusCreateDate = date("Y-m-d");
$queryNumberOfInvoice = " SELECT branch.branch_name ,COUNT(customer.branch_id) AS NumberOfInvoice FROM customer "
        . "LEFT JOIN branch ON customer.branch_id = branch.branch_id WHERE customer.cus_create_date = '$cusCreateDate' GROUP BY branch.branch_name ";
$resNumberOfInvoice = mysqli_query($con, $queryNumberOfInvoice);
?>
<?php
// THis for table Invoice
$queryB = "SELECT branch.branch_name , SUM(CASE WHEN invoice.device_status = 'Done' THEN invoice.hidden_price END)Amount "
        . "FROM((`branch` INNER JOIN `customer` ON branch.branch_id=customer.branch_id) INNER JOIN `invoice` "
        . "ON invoice.bill_date='$cusCreateDate' AND invoice.cus_id=customer.cus_id) GROUP BY branch.branch_name";
$resultB = mysqli_query($con, $queryB);
//----------------------------------------------
?>
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <!--            <div class="col-lg-3">
                            <div class="card">
                                <div class="card-block">
                                    <div class="inline-block">
                                        <h1 class="no-mrg-vertical">$168.90</h1>
                                        <p>This Month</p>
                                    </div>
                                    <div class="pdd-top-25 inline-block pull-right">
                                        <span class="label label-success label-lg mrg-left-5">+18%</span>
                                    </div>
                                    <div class="mrg-top-25">
                                        <div id="bar-config"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <p class="mrg-btm-5">This Quarter</p>
                                    <h1 class="no-mrg-vertical font-size-35">$3,936<b class="font-size-16">.80</b></h1>
                                    <p class="text-semibold">Total Revenue</p>
                                    <div class="mrg-top-10">
                                        <h2 class="no-mrg-btm">88</h2>
                                        <span class="inline-block mrg-btm-10 font-size-13 text-semibold">Online Revenue</span>
                                        <span class="pull-right pdd-right-10 font-size-13">70%</span>
                                        <div class="progress progress-primary">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mrg-top-10">
                                        <h2 class="no-mrg-btm">69</h2>
                                        <span class="inline-block mrg-btm-10 font-size-13 text-semibold">Offline Revenue</span>
                                        <span class="pull-right pdd-right-10 font-size-13">50%</span>
                                        <div class="progress progress-success">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="maps map-500 padding-20">
                                <div id="monthly-target">
                                    <?php
                                    $first_day_this_month = date('Y-m-01'); // First Day in Month
                                    $last_day_this_month = date('Y-m-t'); // Last Day in Moth

                                    $queryChartTow = "SELECT branch.branch_name ,COUNT(customer.branch_id) AS NumberOfInvoice FROM customer "
                                            . "LEFT JOIN branch ON customer.branch_id = branch.branch_id WHERE customer.cus_create_date BETWEEN '$first_day_this_month' AND '$last_day_this_month' "
                                            . "GROUP BY branch.branch_name";

                                    $resChartTow = mysqli_query($con, $queryChartTow);
                                    ?>
                                    <div id="columnchart_values" style="width: 650px; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border left border-hide-sm">
                            <!--                             Chart`s Pie Left             --->


                            <div id="donutchart" style="width: 520px; height: 500px;"></div>
                        </div> 
                    </div>
                    <?php
                    // This In Genearal For ALL Branch`s For One Day
                    $multiQuery = "SELECT COUNT(cus_id) AS NumberCustomer ,COUNT(IF(device_status='Done',1, NULL)) "
                            . "'Done' ,COUNT(IF(device_status='Fix',1, NULL)) 'Fix' ,COUNT(IF(device_status='Pending',1, NULL)) 'Pending' FROM `invoice` WHERE entry_date = '$cusCreateDate'";
                    $resMultiQuery = mysqli_query($con, $multiQuery);

                    $rowMultiQuery = mysqli_fetch_assoc($resMultiQuery);
                    ?>
                    <div class="card-footer d-none d-md-inline-block">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-10 ml-auto mr-auto">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="pdd-vertical-5">
                                                <p class="no-mrg-btm"><b class="text-dark font-size-16"><?php echo $rowMultiQuery['NumberCustomer']; ?></b> Customers</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="pdd-vertical-5">
                                                <p class="no-mrg-btm"><b class="text-dark font-size-16"><?php echo $rowMultiQuery['Done']; ?></b> Done</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="pdd-vertical-5">
                                                <p class="no-mrg-btm"><b class="text-dark font-size-16"><?php echo $rowMultiQuery['Fix']; ?></b> Fix</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="pdd-vertical-5">
                                                <p class="no-mrg-btm"><b class="text-dark font-size-16"><?php echo $rowMultiQuery['Pending']; ?></b> Pending</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="widget card">
                    <div class="card-block">
                        <h5 class="card-title">Amount For Each Branch By Day</h5>
                        <div class="row mrg-top-35">
                            <div class="col-md-12">
                                <div>
                                    <div id="table_div" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="col-lg-5 col-md-12">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="card-title inline-block pdd-top-5">Latest Transaction</h4>
                        <a href="#" class="btn btn-default pull-right no-mrg">All Trasaction</a>
                    </div>
                    <div class="pdd-horizon-20 pdd-vertical-5">
                        <div class="overflow-y-auto relative scrollable" style="max-height: 381px">
                            <table class="table table-lg table-hover">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="list-info">
                                                <img class="thumb-img" src="assets/images/avatars/thumb-1.jpg" alt="">
                                                <div class="info">
                                                    <span class="title">Jordan Hurst</span>
                                                    <span class="sub-title">ID 863</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mrg-top-10">
                                                <span>8 May</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="relative mrg-top-10">
                                                <span class="status online"> </span>
                                                <span class="pdd-left-20">Confirmed</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="list-info">
                                                <img class="thumb-img" src="assets/images/avatars/thumb-4.jpg" alt="">
                                                <div class="info">
                                                    <span class="title">Samuel Field</span>
                                                    <span class="sub-title">ID 868</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mrg-top-10">
                                                <span>8 May</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="relative mrg-top-10">
                                                <span class="status away"> </span>
                                                <span class="pdd-left-20">Pendding</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="list-info">
                                                <img class="thumb-img" src="assets/images/avatars/thumb-5.jpg" alt="">
                                                <div class="info">
                                                    <span class="title">Jennifer Watkins</span>
                                                    <span class="sub-title">ID 860</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mrg-top-10">
                                                <span>8 May</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="relative mrg-top-10">
                                                <span class="status online"> </span>
                                                <span class="pdd-left-20">Confirmed</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="list-info">
                                                <img class="thumb-img" src="assets/images/avatars/thumb-6.jpg" alt="">
                                                <div class="info">
                                                    <span class="title">Michael Birch</span>
                                                    <span class="sub-title">ID 861</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mrg-top-10">
                                                <span>8 May</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="relative mrg-top-10">
                                                <span class="status no-disturb"> </span>
                                                <span class="pdd-left-20">Rejected</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="list-info">
                                                <img class="thumb-img" src="assets/images/avatars/thumb-7.jpg" alt="">
                                                <div class="info">
                                                    <span class="title">Jordan Hurst</span>
                                                    <span class="sub-title">ID 862</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mrg-top-10">
                                                <span>8 May</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="relative mrg-top-10">
                                                <span class="status away"> </span>
                                                <span class="pdd-left-20">Pendding</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
<!--        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card widget-weather">
                    <div class="card-block">
                        <h5 class="card-title">New York, 22 July</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="inline-block">
                                    <h1 class="today-cel">
                                        <span>28°</span>
                                        <i class="ei-partialy-cloudy text-warning"></i> 
                                    </h1>
                                    <p>Partly Sunny</p>
                                </div>
                            </div>
                        </div>
                        <div class="row border bottom mrg-top-30">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <h3 class="no-mrg-btm">22°/28°</h3>
                                        <p class="font-size-13">Temp</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <h3 class="no-mrg-btm">61%</h3>
                                        <p class="font-size-13">Humidity</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <h3 class="no-mrg-btm">18<span class="font-size-13">km/h</span></h3>
                                        <p class="font-size-13">Wind</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mrg-top-35">
                            <div class="col-md-2 col-sm-2 col-2">
                                <div class="next-7day">
                                    <span class="display-block">WED</span>
                                    <h2 class="mrg-top-10"><i class="ei-cloud"></i></h2>
                                    <span>28°</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2">
                                <div class="next-7day">
                                    <span class="display-block">THU</span>
                                    <h2 class="mrg-top-10"><i class="ei-breeze"></i></h2>
                                    <span>23°</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2">
                                <div class="next-7day">
                                    <span class="display-block">FRI</span>
                                    <h2 class="mrg-top-10"><i class="ei-blizzard"></i></h2>
                                    <span>25°</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2">
                                <div class="next-7day">
                                    <span class="display-block">SAT</span>
                                    <h2 class="mrg-top-10"><i class="ei-sunny-day"></i></h2>
                                    <span>27°</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2">
                                <div class="next-7day">
                                    <span class="display-block">SUN</span>
                                    <h2 class="mrg-top-10"><i class="ei-partialy-cloudy"></i></h2>
                                    <span>24°</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-2">
                                <div class="next-7day">
                                    <span class="display-block">MON</span>
                                    <h2 class="mrg-top-10"><i class="ei-sunny-day"></i></h2>
                                    <span>26°</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Latest Feed</h4>
                    </div>
                    <div class="widget-feed">
                        <ul class="list-info overflow-y-auto relative scrollable" style="max-height: 340px">
                            <li class="border bottom mrg-btm-10">
                                <div class="pdd-vertical-10">
                                    <span class="thumb-img bg-primary">
                                        <span class="text-white">JH</span>
                                    </span>
                                    <div class="info">
                                        <a href="#" class="text-link"><span class="title"><b class="font-size-15">Jordan Hurst</b></span></a>
                                        <span class="sub-title">5 mins ago</span>
                                    </div>
                                    <div class="mrg-top-10">
                                        <p class="no-mrg-btm">Remember, a Jedi can feel the Force flowing through him. You mean it controls your actions? Partially.</p>
                                    </div>
                                    <ul class="feed-action">
                                        <li>
                                            <a href="#">
                                                <i class="ti-heart text-danger pdd-right-5"></i>
                                                <span>168</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ti-comments text-primary pdd-right-5"></i>
                                                <span>18</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="border bottom mrg-btm-10">
                                <div class="pdd-vertical-10">
                                    <span class="thumb-img bg-success">
                                        <span class="text-white">JW</span>
                                    </span>
                                    <div class="info">
                                        <a href="#" class="text-link"><span class="title"><b class="font-size-15">Jennifer Watkins</b></span></a>
                                        <span class="sub-title">5 mins ago</span>
                                    </div>
                                    <div class="mrg-top-15">
                                        <p>What good's a reward if you ain't around to use it?</p>
                                    </div>
                                    <ul class="feed-action">
                                        <li>
                                            <a href="#">
                                                <i class="ti-heart text-danger pdd-right-5"></i>
                                                <span>168</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ti-comments text-primary pdd-right-5"></i>
                                                <span>18</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="border bottom">
                                <div class="pdd-vertical-10">
                                    <span class="thumb-img bg-warning">
                                        <span class="text-white">MB</span>
                                    </span>
                                    <div class="info">
                                        <a href="#" class="text-link"><span class="title"><b class="font-size-15">Michael Birch</b></span></a>
                                        <span class="sub-title">5 mins ago</span>
                                    </div>
                                    <div class="mrg-top-15">
                                        <p>What good's a reward if you ain't around to use it? Besides, attacking that battle station ain't my idea of courage.</p>
                                    </div>
                                    <ul class="feed-action">
                                        <li>
                                            <a href="#">
                                                <i class="ti-heart text-danger pdd-right-5"></i>
                                                <span>168</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ti-comments text-primary pdd-right-5"></i>
                                                <span>18</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-heading border bottom">
                        <h4 class="card-title">Project</h4>
                    </div>
                    <div class="card-block">
                        <div class="pdd-vertical-10">
                            <ul class="list-info">
                                <li>
                                    <img class="thumb-img img-circle" src="assets/images/others/thumb-1.jpg" alt="">
                                    <div class="info">
                                        <span class="title"><a href="#" class="text-link text-dark"><b class="font-size-15">Devolopment - Android App</b></a></span>
                                        <span class="sub-title">Android App</span>
                                        <div class="float-object dropdown right">
                                            <i class="ti-android-o"></i>
                                            <a href="#" class="btn btn-icon btn-flat btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="ti-more"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="#">
                                                        <i class="ti-files pdd-right-10"></i>
                                                        <span>Duplicate</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="ti-smallcap pdd-right-10"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="ti-image pdd-right-10"></i>
                                                        <span>Add Images</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mrg-top-20">
                                        <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.</p>
                                    </div>
                                    <div class="mrg-top-30">
                                        <b class="pull-left lh-2-5 pdd-right-15">Team: </b>
                                        <ul class="list-members list-inline">
                                            <li>
                                                <a href="#">
                                                    <img src="assets/images/avatars/thumb-1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/images/avatars/thumb-2.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/images/avatars/thumb-3.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/images/avatars/thumb-4.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/images/avatars/thumb-5.jpg" alt="">
                                                </a>
                                            </li>
                                            <li class="all-members">
                                                <a href="#">
                                                    <span>+2</span>
                                                </a>
                                            </li>
                                            <li class="add-member">
                                                <a href="#">
                                                    <span>+</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class=" mrg-top-30">
                                        <span>Due date: <span class="text-success text-semibold">23/7/2017</span></span>
                                    </div>
                                    <div class="mrg-top-30">
                                        <p class="mrg-btm-5">Task completed: <span class="text-dark text-semibold">7/10</span></p>
                                        <div class="progress progress-info">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>

<!-- Content Wrapper END -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Number of Invoice', 'Hours per Day'],
<?php
while ($rowNumberInvoice = mysqli_fetch_assoc($resNumberOfInvoice)) {
    echo "['{$rowNumberInvoice['branch_name']}',{$rowNumberInvoice['NumberOfInvoice']}],";
}
?>
        ]);
        var options = {
            title: 'My Daily Activities',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Density", {role: "style"}],
<?php
while ($rowCharTow = mysqli_fetch_assoc($resChartTow)) {
    echo "['{$rowCharTow['branch_name']}',{$rowCharTow['NumberOfInvoice']},'color: #00BFFF'],";
}
?>

        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"},
            2]);

        var options = {
            title: "Monthly Chart`s",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: {position: "none"},
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['table']});
    google.charts.setOnLoadCallback(drawTable);

    function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Branch');
        data.addColumn('number', 'Amount ');
        data.addColumn('string', 'Date');
        data.addRows([
<?php
while ($rowB = mysqli_fetch_assoc($resultB)) {
    echo "  ['{$rowB['branch_name']}', {$rowB['Amount']}, '$cusCreateDate'],";
}
?>

        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '500px', height: '1500px;'});
    }
</script>
<?php include 'includes/footer.php'; ?>