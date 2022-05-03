<div class="container-fluid page-body-wrapper">
    <!-- partial:'assets/partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav " style="padding-inline: 0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-user menu-icon ms-3 "></i>
                    <span class="menu-title fw-bold " style="font-family: Tajawal">إدارة المستخدمين</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.service.index') }}">
                    <i class="fa-solid fa-user menu-icon ms-3 "></i>
                    <span class="menu-title fw-bold " style="font-family: Tajawal">إدارة الخدمات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="fa-solid fa-user menu-icon ms-3 "></i>
                    <span class="menu-title fw-bold " style="font-family: Tajawal">إدارة الاقسام</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="mdi mdi-car menu-icon ms-3 "></i>
                    <span class="menu-title  fw-bold" style="font-family: Tajawal">إدارة مواصفات السيارات</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item me-5">
                            <a class="nav-link" href="{{ route('admin.brand.index') }}" target="_self" style="font-family: Tajawal">
                                الماركات
                            </a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="{{ route('admin.series.index') }}" style="font-family: Tajawal">
                                الانواع
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auction" aria-expanded="false" aria-controls="auction">
                    <i class="mdi mdi-car menu-icon ms-3 "></i>
                    <span class="menu-title fw-bold " style="font-family: Tajawal">إدارة المزادات</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auction">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item me-5">
                            <a class="nav-link" href="{{ route('admin.auction.index') }}" target="_self">
                                المزادات
                            </a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="{{ url('admin/bids') }}" style="font-family: Tajawal">
                                عمليات المزايدة
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


        </ul>
    </nav>
