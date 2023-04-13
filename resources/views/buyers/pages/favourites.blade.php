@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Favourites')

@section('content')
                    @include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>My Favourites</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="#">My Favourites</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- top recommendation  -->
    <div class="rcdt_wrp pt-0">
        <div class="container">
            <div class="rcdt_dtl">
                <div class="rcdt_grdctn">
                    @foreach ($favourites as $car)
                        <div class="rcdt_grd">
                            <div class="rcdt_ddt">
                                <img src="{{ $car->front_image }}" alt="icn">
                                <div class="rcdt_rcd">
                                    <div class="rcd_dts">
                                        <span>{{ $car->published_at }}</span>
                                        <div class="fav_rte">
                                            <input type="checkbox" name="rate" id="rate-{{ $car->id }}"
                                                   {{ in_array($car->id, request()->user('buyers_web')->my_fav_ids) ? "checked" : "" }}
                                                   @change="toggleFavourite(`{{ $car->id }}`, 'remove')">
                                            <label for="rate-{{ $car->id }}">
                                                <img src="{{ asset('static/buyers/images/icons/heart.png') }}" alt="icn">
                                            </label>
                                        </div>
                                    </div>
                                    <span class="crnme">{{ $car->brand_name }} - {{ $car->model_name }}</span>
                                <span class="crnmdl">{{ $car->model_year }}</span>
                                    <div class="cr_prc">
                                        <div class="crprc_cd">
                                            <label>Vehicle Price</label>
                                            <span>${{ $car->vehicle_price }}</span>
                                        </div>
                                        <a href="{{ route('buyer.pages.vehicleDetail', ['id' => $car->id]) }}" class="btn_secondary">See More Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rcdt_lst">
                                <ul>
                                    <li><img src="{{ asset('static/buyers/images/icons/petrol.png') }}" alt="icn">
                                        <span>{{ $car->fuel_type }}</span>
                                    </li>
                                    <li><img src="{{ asset('static/buyers/images/icons/automation_ic.png') }}" alt="icn">
                                        <span>{{ $car->drive_type }}</span>
                                    </li>
                                    <li><img src="{{ asset('static/buyers/images/icons/speed_ic.png') }}" alt="icn">
                                        <span>{{ $car->odometer_mileage }} KM</span>
                                    </li>
                                    <li><img src="{{ asset('static/buyers/images/icons/car_ic.png') }}" alt="icn">
                                        <span>{{ $car->transmission }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="dcr_bt">
                    {{ $favourites->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- top recommendation  -->
    <!-- top recommendation slider  -->
    @include('buyers.parts.top_recommendation_slider')
@endsection
