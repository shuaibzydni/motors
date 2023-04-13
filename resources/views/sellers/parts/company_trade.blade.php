<!--company_trade-->
<div class="company_trade wrapper">
    <div class="comapny_inner_wrap">
        <div class="container">
            <div class="comp_main">
                <h3><span>Welcome to</span> {{ cache()->get('sellerSettings')['siteName'] }}</h3>
                <div class="compare_lst">
                    <div>
                        <img src="{{ asset('static/sellers/images/company_trade.png') }}" alt="Company Trade"/>
                        <h5>Largest Number of  Genuine Buyers</h5>
                    </div>

                    <p>{{ cache()->get('buyer_count') }} + Customers are ready to buy a Car!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="company_about">
        <div class="container">
            <h5>About Us</h5>
            {!! cache()->get('sellerSettings')['aboutUs']  !!}
        </div>
    </div>
</div>
<!--company_trade-->
