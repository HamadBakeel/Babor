<footer class="footer text-center">
    <span class="text-muted d-block d-sm-inline-block">جميع الحقوق محفوضة لدى © <a href="" target="_blank"> Babor
        </a>2022</span>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- plugins:js -->
<script src="{{ @asset('assets/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ @asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ @asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ @asset('assets/js/template.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.previewImage').change(function() {
            $("#frames").html('');
            for (var i = 0; i < $(this)[0].files.length; i++) {
                $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                    '" width="100px" height="100px"/>');
            }
        });
    });
</script>
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>

</html>
