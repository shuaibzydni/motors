<!--header-->
<div class="header wrapper">
    <div class="header_inner_wrap">
        <div class="logo logo_shape">
            <a href="{{ route('seller.pages.home') }}"><img width="300" src="{{ asset('static/sellers/images/motortraders_logo.png') }}"/></a>
        </div>
        <div class="header_list">
            <div class="header_top_list">
                <div class="head_lst">
                    <ul>
                        <li><a href="{{ route('seller.pages.home') }}">Home</a></li>
                        <li><a href="{{ route('seller.pages.aboutUs') }}">About Us</a></li>
                        <li><a href="{{ route('seller.pages.contactUs') }}">Contact Us</a></li>
                        <li><a href="{{ route('seller.pages.helpCenter') }}">Help Center</a></li>
                        <li><a href="{{ route('seller.pages.termsAndPolicy') }}">Terms & Policies</a></li>
                    </ul>
                </div>
                @if(auth()->guard('sellers_web')->check())
                <div class="my_account" onclick="redirectToAccountSettings()" style="cursor: pointer">
                    <img src="{{ asset('static/sellers/images/user.png') }}"/>
                    <span> {{ auth()->guard('sellers_web')->user()->first_name }} <img src="{{ asset('static/sellers/images/account_arrow.png') }}"/></span>
                </div>
                @else
                <div class="my_account">
                    <img src="{{ asset('static/sellers/images/user.png') }}"/>
                    <span> <a href="{{ route('seller.login') }}" style="color: #FFFFFF">Login / Register</a> </span>
                </div>
                @endif

                <div class="social_icon">
                    <ul>
                        @foreach(cache()->get('social_links') as $socialLink)
                            <li><a href="{{$socialLink->link}}"><i class="fa fa-{{$socialLink->fa_icon}}" aria-hidden="true"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="header_bottom_list">
                <ul>
                    <li><a href="{{ route('seller.pages.home') }}">Home</a></li>
                    <li><a href="{{ route('buyer.pages.home') }}">Buy a Car</a></li>
                    <li><a href="{{ route('seller.pages.pricingPlan') }}">Pricing Plans</a></li>
                    @if(auth()->guard('sellers_web')->check())
                    <li><a href="{{ route('seller.pages.myVehicles') }}">My Vehicles</a></li>
                    <li><a @click.prevent="$_confirmSellerLogout" style="color: red; cursor: pointer">Logout</a></li>
                    @endif
                </ul>

                @if(auth()->guard('sellers_web')->check())
                    <!-- notification st -->
                        <div onclick="togglePopup()" class="notifi">
                            @if($unreadNotificationCount > 0)
                                <img src="{{ asset('static/sellers/images/notification.png') }}" />
                            @else
                                <img src="{{ asset('static/sellers/images/Line.png') }}" />
                            @endif
                        </div>
                        <div class="notification_body">
                            <div class="notification_top">
                                <h6 class="notification_header"><img src="{{ asset('static/sellers/images/Line.png') }}" alt="notification">Notifications</h6>
                                <div onclick="togglePopup()" class="close-btn icon">
                                    <img class="icon" src="{{ asset('static/sellers/images/Vector (3).png') }}" alt="clous">
                                </div>

                            </div>
                            @foreach($last5Notifications as $notification)
                            <a href="{{ route('seller.notification.redirect', ['notificationId' => $notification->id]) }}">
                            <div class="notifitcaion_mgs {{ $notification->is_read == "0" ? 'unread' : '' }}">
                                <div class="notification_title">
                                    <div class="notification_name">
                                        <h6>{{ $notification->title }}</h6>
                                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p>{{ $notification->notification_message }}</p>
                                </div>
                            </div>
                            </a>
                            @endforeach

                            <div style="display: flex; align-items: center;">
                                <div class="notifitcaion_btn">
                                    <a href="{{ route('seller.notification') }}">See More</a>
                                </div>

                                <a href="{{ route('seller.notification.markAllAsRead') }}" class="btn_markallread" style="color: #1763ea; font-size: 14px;">Mark All as Read</a>
                            </div>

                        </div>
                        <!-- notification end -->
                @endif

                <div class="head_btn">
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

    <sell-your-car-component>
        <div class="popup" id="post-your-vehicle">
            <div class="popup_head">
                <h3>Post Your Vehicle</h3>
                <div class="close_btn" @click="$_closeModal('sell-your-car')">&times;</div>
            </div>
            <car-create-component

            ></car-create-component>
        </div>
    </sell-your-car-component>

    <edit-your-car-component>
        <div class="popup" id="post-your-vehicle">
            <div class="popup_head">
                <h3>Edit Your Vehicle</h3>
                <div class="close_btn" @click="$_closeModal('edit-your-car')">&times;</div>
            </div>
            <car-edit-component

            ></car-edit-component>
        </div>
    </edit-your-car-component>

</div>
<!--header-->
