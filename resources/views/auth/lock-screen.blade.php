<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Majestic Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ @asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ @asset('assets/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ @asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ @asset('assets/images/favicon.png ') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-transparent text-left p-5 text-center">
                            <img src="{{ @asset('assets/images/faces/face13.jpg') }}" class="lock-profile-img"
                                alt="img">
                            <form class="pt-5">
                                <div class="form-group">
                                    <label for="examplePassword1">Password to unlock</label>
                                    <input type="password" class="form-control text-center" id="examplePassword1"
                                        placeholder="Password">
                                </div>
                                <div class="mt-5">
                                    <a class="btn btn-block btn-success btn-lg font-weight-medium"
                                        href="index.html">Unlock</a>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="#" class="auth-link text-white">Sign in using a different account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ @asset('assets/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ @asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ @asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ @asset('assets/js/template.js') }}"></script>
    <!-- endinject -->
</body>

</html>
