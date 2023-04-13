<!--mobile_app-->
<div class="mobile_wrap wrapper">
    <div class="mobile_inner_wrap">
        <div class="container">
            <div class="mobile_app_section">
                <div class="mobile_app_left">
                    <img src="{{ asset('static/sellers/images/Our-Mobile-App.png') }}" alt="mobile_app"/>
                </div>
                <div class="mobile_app_right">
                    <h5>Discover with in Everywhere</h5>
                    <h2>Our Mobile App</h2>
                    <h6>Get it for Free</h6>
                    <p>Choose your native platform and download the app FREE!</p>
                    <div class="mobile_app_btn">
                        <a href="{{ cache()->get('sellerSettings')['appGooglePlay'] }}"><img src="{{ asset('static/buyers/images/google_pay.png') }}" alt="google_pay"/></a>
                        <a href="{{ cache()->get('sellerSettings')['appAppStore'] }}"><img src="{{ asset('static/buyers/images/app_store.png') }}" alt="App store"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--mobile_app-->
