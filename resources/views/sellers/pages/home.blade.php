@extends('sellers.layouts.seller_layout')

@section('pageName', 'Home')

@section('content')
    <div class="slider">
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <li>
                        <div class="content_main">
                            <img src="{{ asset('static/sellers/images/car-race.png') }}" alt=""/>
                            <div class="content_lst">
                                <h1>{{ cache()->get('sellerSettings')['homePageTitle'] }}</h1>
                                <p>{{ cache()->get('sellerSettings')['homePageSubTitle'] }}</p>
                                @if(auth()->guard('sellers_web')->check())
                                    @if(empty(request()->user('sellers_web')->currentSubscriptionPlan()))
                                        <a href="{{ route('seller.pages.pricingPlan') }}"><img src="{{ asset('static/sellers/images/sell_your_car.png') }}"/>Sell your Car</a>
                                    @else
                                        @if(!request()->user('sellers_web')->currentSubscriptionPlan()->ends_at->isFuture() || request()->user('sellers_web')->subscriptionPlanLimit() < 1)
                                            <a href="{{ route('seller.pages.pricingPlan') }}"><img src="{{ asset('static/sellers/images/sell_your_car.png') }}"/>Sell your Car</a>
                                        @else
                                            <a href="#" @click.prevent="sellYourCar"><img src="{{ asset('static/sellers/images/sell_your_car.png') }}"/>Sell your Car</a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('seller.login') }}"><img src="{{ asset('static/sellers/images/car_green.png') }}"/>Sell your Car</a>
                                @endif
                            </div>
                        </div>
                </ul>
            </div>
            <a href="#" class="jcarousel-control-prev"></a>
            <a href="#" class="jcarousel-control-next"></a>
        </div>
    </div>

    @include('sellers.parts.company_trade')

    @include('sellers.parts.how_it_work')
@endsection
