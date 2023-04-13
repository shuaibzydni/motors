<div class="hdr_nav mt-2">
    <div class="logo">
        <a href="{{ route('buyer.pages.home') }}">
            <img width="300" src="{{ asset('static/buyers/images/motortraders_logo.png') }}" alt="logo" />
        </a>
    </div>
    <div class="navwacc">
        <div class="navbar">
            <ul>
                <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                <li><a href="{{ route('seller.pages.home') }}">Sell a Car</a></li>
                <li><a href="{{ route('buyer.pages.pricingPlan') }}">Pricing Plans</a></li>
                <li><a href="{{ route('buyer.pages.manageBids') }}">Manage Bids</a></li>
                <li><a href="{{ route('buyer.pages.favourites') }}">My Favourites</a></li>
            </ul>
        </div>
        <div class="acc_src">
            <div class="srch_pod">
                <div class="srchpod_ic">
                    @if(auth()->guard('buyers_web')->check())
                    <span class="icosrch_ic">
                            <!-- notification st -->
                                <div onclick="togglePopup()" class="notifi">
                                    @if($unreadNotificationCount > 0)
                                        <img src="{{ asset('static/buyers/images/notification.png') }}" />
                                    @else
                                        <img src="{{ asset('static/sellers/images/Line.png') }}" />
                                    @endif
                                </div>
                                <div class="notification_body">
                            <div class="notification_top">
                                <h6 class="notification_header"><img src="{{ asset('static/sellers/images/Line.png') }}" alt="notification">Notifications</h6>
                                <!--<a class="text-primary">Mark all as Read</a>-->
                                <div onclick="togglePopup()" class="close-btn icon">
                                    <img class="icon" src="{{ asset('static/sellers/images/Vector (3).png') }}" alt="clous">
                                </div>

                            </div>
                            @foreach($last5Notifications as $notification)
                            <a href="{{ route('buyer.notification.redirect', ['notificationId' => $notification->id]) }}">
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
                                    <a href="{{ route('buyer.notification') }}">See More</a>
                                </div>

                                <a href="{{ route('buyer.notification.markAllAsRead') }}" class="btn_markallread" style="color: #1763ea; font-size: 14px;">Mark All as Read</a>
                            </div>

                        </div>
                                <!-- notification end -->
                    </span>
                    @endif
                    <div class="srchpod_bx" style="display: none">
                        <div class="srchpd_lct">
                            <div class="lct_icn">
                                <img src="{{ asset('static/buyers/images/icons/green_location.png') }}" alt="icn" />
                            </div>
                            <select>
                                <option selected disabled value="#">Select Location</option>
                                <option value="#">Chennai</option>
                            </select>
                        </div>
                        <div class="srchpd_srcnw">
                            <div class="schnw_ic">
                                <img src="{{ asset('static/buyers/images/icons/search_green.png') }}" alt="icon" />
                            </div>
                            <input type="search"
                                   placeholder="Search by Car Brand, Make, Model...">
                            <button class="btn_primary">Search Now</button>
                        </div>
                    </div>
                </div>
                <div class="myacc_btn">
                    @if(!auth()->guard('buyers_web')->check())
                    <div class="lgsg_ac">
                        <a href="{{ route('buyer.login') }}">
                            <img src="{{ asset('static/buyers/images/icons/prfl.png') }}" alt="icon">
                            <span>Login / Signup</span>
                        </a>
                    </div>
                    @else
                    <div class="lgsg_ac myact">
                        <a href="#">
                            <img src="{{ asset('static/buyers/images/icons/prfl.png') }}" alt="icon">
                            <span>My Account</span>
                            <img src="{{ asset('static/buyers/images/icons/drparr_wht.svg') }}" alt="icon">
                        </a>
                        <div class="prf_stng" style="display: none;">
                            <a class="prl_st" href="{{ route('buyer.pages.accountSettings') }}">
                                <img src="{{ auth()->guard('buyers_web')->user()->avatar }}" style="width: 82px" alt="ico">
                                <div class="prlst_nme">
                                    <h5>{{ auth()->guard('buyers_web')->user()->first_name }}</h5>
                                    <span>account settings</span>
                                </div>
                            </a>
                            <ul>
                                <li><a href="{{ route('buyer.pages.accountSettings') }}">Change Password</a></li>
                                <li><a href="" @click.prevent="$_confirmBuyerLogout"> <i class="fa fa-sign-out"
                                                                            aria-hidden="true"></i>
                                        Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
