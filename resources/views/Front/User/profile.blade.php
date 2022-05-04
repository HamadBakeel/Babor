@include('partials.header')
@include('partials.navbar');
@include('partials.userSidebar')
<!-- Content wrapper -->
<div class="content-wrapper" dir="rtl">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Modal -->
        @if (session()->has('Emailverfication'))
        <div class="alert alert-dismissible alert-danger fade show" role="alert">
            {{ session()->get('Emailverfication') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="modal fade" id="profile_pic" tabindex="-1"
            aria-labelledby="profile_pic_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profile_pic_label">اختر صورة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('avatar.change') }}" method="POST"
                            enctype="multipart/form-data" id="profileForm">
                            @csrf
                            <input type="file" name="avatar" class="form-control previewImage">
                            <div class="d-inline mx-auto mt-2 previewFrames alert alert-dismissible"
                                                                            style="position: relative;"></div>
                        </form>
                    </div>
                    @error('avatar')
                        {{ $message }}
                    @enderror
                    <div class="modal-footer">
                        <button type="submit" form="profileForm"
                            class="btn btn-primary text-white">حفظ</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto pt-3 pe-3" style="position: relative">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#profile_pic" style="position: absolute; bottom:0; left:-37px;">
                                    <i class="fas fa-camera"></i>
                            </button>
                            @if (isset($user->profile->avatar))
                                <img src="/images/profiles/{{ $user->profile->avatar }}" alt="profile" width="100"
                                    class="d-block h-auto ms-0 rounded user-profile-img" />
                            @else
                                <img src="/images/profiles/default.png" alt="profile"
                                    class="d-block h-auto ms-0 rounded user-profile-img" width="100"/>
                            @endif

                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info text-md-end">
                                    <h4>{{ $user->profile->username }}</h4>
                                    <ul
                                        class="p-0 list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item fw-semibold">
                                            <i class='bx bx-pen'></i> @if(@isset($user->profile->job )) {{ $user->profile->job }} - @endif
                                        </li>
                                        <li class="list-inline-item fw-semibold">
                                            <i class='bx bx-map'></i> @if(@isset($user->profile->city )) {{ $user->profile->city }} - @endif
                                        </li>
                                        <li class="list-inline-item fw-semibold">
                                            <i class='bx bx-calendar-alt'></i> انضم بتاريخ
                                            {{ date_format($user->profile->created_at, 'm-Y') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-warning text-nowrap">
                                    <i class='bx bx-user-check'></i> تواصل
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item"><a class="nav-link active bg-dark" href="#"><i class='bx bx-user'></i>
                            البروفايل</a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="#"><i class='bx bx-group'></i>
                            الفريق</a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="#"><i class='bx bx-grid-alt'></i>
                            المبيعات</a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="#"><i class='bx bx-link-alt'></i>
                            المشتريات</a></li>
                </ul>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="text-muted text-uppercase">نبذة</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span
                                    class="fw-semibold mx-2"><i class="fa-solid fa-user-large"></i> الاسم: </span> <span>{{ $user->name }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span
                                    class="fw-semibold mx-2"><i class="fa-solid fa-suitcase"></i> المهنة: </span> <span>{{ $user->profile->job }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span
                                    class="fw-semibold mx-2"><i class="fa-solid fa-location-dot"></i> العنوان: </span> <span>{{ $user->profile->city }} -
                                    {{ $user->profile->address }}</span>
                            </li>
                        </ul>
                        <small class="text-muted text-uppercase">معلومات التواصل</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span
                                    class="fw-semibold mx-2"><i class="fa-solid fa-phone"></i> الهاتف: </span> <span>{{ $user->profile->phone }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span
                                    class="fw-semibold mx-2"><i class="fa-solid fa-envelope"></i> ايميل: </span> <span>{{ $user->email }}</span></li>
                        </ul>

                    </div>
                </div>
                <!--/ About User -->
                <!-- Profile Overview -->
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="text-muted text-uppercase">الانجازات</small>
                        <ul class="list-unstyled mt-3 mb-0">
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span
                                    class="fw-semibold mx-2">عملية شراء:</span> <span>13.5k</span></li>
                            <li class="d-flex align-items-center mb-3"><i class='bx bx-customize'></i><span
                                    class="fw-semibold mx-2">عملية بيع:</span> <span>146</span></li>
                        </ul>
                    </div>
                </div>
                <!--/ Profile Overview -->
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>ابرز الانشطة </h5>

                    </div>
                    <div class="card-body">
                        <ul class="timeline ms-2">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0"> الدخول بمزاد</h6>
                                        <small class="text-muted">اليوم</small>
                                    </div>
                                    <p class="mb-2">عقد صفقة بيع الساعة 12:40PM </p>

                                </div>

                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0"> الدخول بمزاد</h6>
                                        <small class="text-muted">اليوم</small>
                                    </div>
                                    <p class="mb-2">عقد صفقة بيع الساعة 12:40PM </p>

                                </div>

                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0"> الدخول بمزاد</h6>
                                        <small class="text-muted">اليوم</small>
                                    </div>
                                    <p class="mb-2">عقد صفقة بيع الساعة 12:40PM </p>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Activity Timeline -->
        </div>
    </div>
    <!--/ User Profile Content -->

    @include('partials.footer')
