<!--footer-->

<div class="footer wrapper">
    <!--footer_top_section-->
    <div class="footer_top">
        <div class="container">
            <div class="foot_top">
                <div class="footer_lst foot_frt">
                    <a href="#"><img width="300" src="{{ asset('static/sellers/images/motortraders_logo.png') }}"/></a>
                    <h2>Who We Are</h2>
                    <p>{{ cache()->get('sellerSettings')['siteDescription'] }}</p>
                </div>

                <div class="footer_lst foot_scd">
                    <h2>Links</h2>
                    <ul>
                        <li><a href="{{ route('seller.pages.home') }}">Home</a></li>
                        <li><a href="{{ route('seller.pages.aboutUs') }}">About Us</a></li>
                        <li><a href="{{ route('seller.pages.contactUs') }}">Contact Us</a></li>
                        <li><a href="{{ route('seller.pages.helpCenter') }}">Help Center</a></li>
                        <li><a href="{{ route('seller.pages.termsAndPolicy') }}">Terms & Policies</a></li>
                    </ul>
                </div>

                <div class="footer_lst foot_lst">
                    <h2>Happy to Help you</h2>
                    <div class="msg_lst">
                        <ul>
                            <li><a href="mailto:{{ cache()->get('sellerSettings')['siteEmail'] }}"><i class="fa fa-envelope" aria-hidden="true"></i>{{ cache()->get('sellerSettings')['siteEmail'] }}</a></li>
                            <li><a href="tel:{{ cache()->get('sellerSettings')['sitePhone'] }}"><i class="fa fa-phone" aria-hidden="true"></i>{{ cache()->get('sellerSettings')['sitePhone'] }}</a></li>
                        </ul>
                    </div>
                    <div class="social_icons">
                        <h2>Follow Us On</h2>
                        <ul class="social-icon-list">
                            @foreach(cache()->get('social_links') as $socialLink)
                                <li><a href="{{$socialLink->link}}"><i class="fa fa-{{$socialLink->fa_icon}}" aria-hidden="true"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer_top_section-->
    <!--footer_bottom_section-->
    <div class="footer_bottom ">
        <div class="container">
            <div class="foot_btm">
                <p>© Copyrights {{ cache()->get('sellerSettings')['siteName'] }} 2021. All rights reserved</p>
            </div>
        </div>
    </div>
    <!--footer_bottom_section-->
</div>

<!--footer-->
