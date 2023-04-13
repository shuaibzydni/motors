<!--howitwork-->
<div class="howitwork_wrap wrapper">
    <div class="howitwork_inner_wrap">
        <div class="howitwork_main">
            <div class="how_it_work_left">
                <img src="{{ asset('static/sellers/images/howitwork_car.png') }}"/>
            </div>
            <div class="how_it_work_right">
                <h3>How it is Work - <span>Easy to Access</span></h3>
                <p>{{ cache()->get('sellerSettings')['howItWorkHeader'] }}</p>
                <div class="how_lst">
                    <div class="how_it_list">
                        <img src="{{ asset('static/sellers/images/post_vehicle.png') }}"/>
                        <div class="cont">
                            <h4>{{ cache()->get('sellerSettings')['hitw_first_q'] }}</h4>
                            <p>{{ cache()->get('sellerSettings')['hitw_first_a'] }}</p>
                        </div>
                    </div>
                    <div class="how_it_list">
                        <img src="{{ asset('static/sellers/images/speedy_car.png') }}"/>
                        <div class="cont">
                            <h4>{{ cache()->get('sellerSettings')['hitw_second_q'] }}</h4>
                            <p>{{ cache()->get('sellerSettings')['hitw_second_a'] }}</p>
                        </div>
                    </div>
                    <div class="how_it_list">
                        <img src="{{ asset('static/sellers/images/get_buyer.png') }}"/>
                        <div class="cont">
                            <h4>{{ cache()->get('sellerSettings')['hitw_third_q'] }}</h4>
                            <p>{{ cache()->get('sellerSettings')['hitw_third_a'] }}</p>
                        </div>
                    </div>
                </div>
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
    </div>
</div>
<!--howitwork-->
