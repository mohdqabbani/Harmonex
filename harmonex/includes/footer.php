<!-- Footer START -->
<footer class="content-footer">
    <div class="footer">
        <div class="copyright">
            <span>Copyright � 2019 <b class="text-dark">Harmonex</b>. All rights reserved.</span><span>Created By Mohammad Qabbani</span>
            <span class="go-right">
                <a href="#" class="text-gray mrg-right-15">Term &amp; Conditions</a>
                <a href="#" class="text-gray">Privacy &amp; Policy</a>
            </span>
        </div>
    </div>
</footer>
<!-- Footer END -->

</div>
<!-- Page Container END -->

</div>
</div>

<script src="assets/js/vendor.js"></script>

<!-- page plugins js -->
<script src="assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/js/maps/jquery-jvectormap-us-aea.js"></script>
<script src="assets/vendors/d3/d3.min.js"></script>
<script src="assets/vendors/nvd3/build/nv.d3.min.js"></script>
<script src="assets/vendors/jquery.sparkline/index.js"></script>
<script src="assets/vendors/chart.js/dist/Chart.min.js"></script>
<script src="assets/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
<script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>

<script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/forms/form-validation.js"></script>
<!-- page js -->
<script src="assets/js/main.js"></script>
<script>
 $(document).on('keydown', ':tabbable', function (e) {

 if (e.which == 13  || e.keyCode == 13  ) 
 {      e.preventDefault();
        var $canfocus = $(':tabbable:visible')
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
}   

});
</script>

<?php //if (basename($_SERVER['PHP_SELF'], '.php') == 'index') echo '<script src="assets/js/dashboard/dashboard.js"></script>'; ?> 

</body>


<!-- Mirrored from themenate.com/espire/html/dist/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2019 13:53:10 GMT -->
</html>