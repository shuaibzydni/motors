<!-- Our mobile app  -->
<div class="mbleapp_wrp">
    <div class="container">
        <div class="mblapp_rst">
            <img src="{{ asset('static/buyers/images/mble-app.png') }}" alt="img">
            <div class="mblapp_cnt">
                <span class="ttl_mblapp">Discover with in Everywhere</span>
                <h4>Our Mobile App</h4>
                <span class="mblefrr">Get it for Free</span>
                <p>Choose your native platform and download the app FREE!</p>
                <div class="applnks">
                    <a href="{{ cache()->get('buyerSettings')['appGooglePlay'] }}"><img src="{{ asset('static/buyers/images/googleplay.svg') }}" alt="str"></a>
                    <a href="{{ cache()->get('buyerSettings')['appAppStore'] }}"><img src="{{ asset('static/buyers/images/appstore.svg') }}" alt="str"></a>
                </div>
            </div>
        </div>
    </div>
</div>
