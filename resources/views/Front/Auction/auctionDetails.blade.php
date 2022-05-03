@extends('partials.usermaster')
@section('body')

{{--<div class="container mt-2 ">--}}

{{--    <div id="sync1" class="owl-carousel owl-theme">--}}
{{--        <div class="item">--}}
{{--            <h1>1</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>2</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>3</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>4</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>5</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>6</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>7</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>8</h1></div>--}}
{{--    </div>--}}

{{--    <div id="sync2" class="owl-carousel owl-theme">--}}
{{--        <div class="item">--}}
{{--            <h1>1</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>2</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>3</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>4</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>5</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>6</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>7</h1></div>--}}
{{--        <div class="item">--}}
{{--            <h1>8</h1></div>--}}
{{--    </div>--}}
    <div class="carImages d-flex flex-column align-items-center gap-3 mt-3 ">
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon slider-btn next">
            <i class="mdi mdi-arrow-left "></i>
        </button>
        <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon slider-btn prev">
            <i class="mdi mdi-arrow-right "></i>
        </button>
        <div class="bigImage ">
            <img src="{{@asset('assets/img/cars/car.webp')}}" alt="car image">
        </div>
        <div class="smallImages d-flex gap-2">
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car2.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car3.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car4.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car5.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car6.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car7.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car8.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car9.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car.webp')}}" alt="car image">
            </div>
            <div class="small-img-container">
                <img src="{{@asset('assets/img/cars/car.webp')}}" alt="car image">
            </div>
        </div>
    </div>
@endsection

