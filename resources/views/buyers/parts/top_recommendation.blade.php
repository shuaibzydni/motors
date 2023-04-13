<template>
    <div class="rcdt_wrp">
        <div class="container">
            <div class="rcdt_dtl">
                <h3>Top Recommendation</h3>
                <p>{{ cache()->get('buyerSettings')['topRecommendationHeader'] }}</p>
                <div class="rcdt_grdctn">
                    @foreach($topRecommendations as $car)
                    <div class="rcdt_grd">
                        <div class="rcdt_ddt">
                            <img src="{{ $car->front_image }}" alt="icn">
                            <div class="rcdt_rcd">
                                <div class="rcd_dts">
                                    <span>{{ $car->published_at }}</span>
                                    @if(request()->user('buyers_web'))
                                        <div class="fav_rte">
                                            <input type="checkbox" id="rate-{{ $car->id }}"
                                                   {{ in_array($car->id, request()->user('buyers_web')->my_fav_ids) ? "checked" : "" }}
                                                   @change="toggleFavourite(`{{ $car->id }}`, `{{ in_array($car->id, request()->user('buyers_web')->my_fav_ids) ? 'remove' : 'add' }}`)">
                                            <label for="rate-{{ $car->id }}">
                                                <img src="{{ asset('static/buyers/images/icons/heart.png') }}" alt="icn">
                                            </label>
                                        </div>
                                    @endif
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
                    <a href="{{ route('buyer.pages.discoverVehicle') }}" class="btn_primary srchicn"> <img src="{{ asset('static/buyers/images/icons/search_white.png') }}" alt=""> Discover
                        More</a>
                </div>
            </div>
        </div>
    </div>
</template>
