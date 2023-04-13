@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Vehicle Detail')

@section('content')
                    @include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>{{ $product['brand_name'] ?? '' }} ({{ $product['model_name'] ?? '' }} - {{ $product['model_year'] ?? '' }})</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="{{ route('buyer.pages.discoverVehicle') }}">Discover More</a></li>
                            <li><a href="#">CarDetail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- brpwser_vehicle  -->
    <vehicle-detail-buyer
        :carData="{{ json_encode($product) }}"
        :seller="{{ json_encode($hiddenSeller) }}"
        :biddingCount="{{ $biddingCount }}"
        :biddingDetail="{{ json_encode($biddingDetail) }}"
        :acceptedBid="{{ json_encode($acceptedBid) }}"
        :isUserLoggedIn="{{ json_encode($isUserLoggedIn) }}"
        :isSubscriptionEnded="{{ json_encode($isSubscriptionEnded) }}"
    ></vehicle-detail-buyer>
    <!-- brpwser_vehicle  -->

    @include('buyers.parts.top_recommendation_slider')
@endsection
