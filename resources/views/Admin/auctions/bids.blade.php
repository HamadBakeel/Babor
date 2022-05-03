@extends('partials.master')
@section('body')
    <!-- partial -->

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper" style="position: relative">
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="col-lg-12 col-md-7 col-12 " style="direction:ltr ;margin: right 0px;">
                        <div class="search-bar-top">
                            <div class="search-bar">
                            <h4 class="card-title">عرض بحسب</h4>
                                <select>
                                    <option selected="selected"> الكل</option>
                                    <option>اسم البائع</option>
                                    <option>تاريخ الانتهاء</option>
                                    <option> سعر المزايدة</option>
                                    
                                    
                                </select>
                               
                            </div>
                        </div>
                    </div>
                            <h4 class="card-title">عرض المزايدات</h4>
                            @if (session()->has('errorEdit'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session()->get('errorEdit') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('successAdd'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session()->get('successAdd') }}
                                    <button type=" button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('errorAdd'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session()->get('errorAdd') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <ul class="m-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                البائع
                                            </th>
                                            <th>
                                                 الفائز بالمزاد
                                            </th>
                                            <th>
                                                السعر الحالي
                                            </th>
                                            <th>
                                                 وقت انتهاء المزاد
                                            </th>
                                            <th>
                                                 رابط  المزاد
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bids as $bid)
                                            
                                            <tr>
                                                <td class="py-1">
                                                   
                                                </td>
                                                <td>
                                                    {{ $bid->auctioneer }}
                                                </td>
                                                <td>
                                                    {{ $bid->bidder }}
                                                </td>
                                                <td>
                                                {{ $bid->currentPrice }}
                                                </td>
                                                <td>
                                                {{ $auction->closeDate }}
                                                </td>
                                                <td>
                                                  <!-- some update -->
                                                {{ $auction->link }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          
        </div>
        <!-- Modal -->
       

        <!-- container-scroller -->
    @endsection
