<div class="hwtwrk_wrp tp_shppr">
    <div class="container">
        <div class="hwterk_cnt">
            <img src="{{ asset('static/buyers/images/car_tc.png') }}" alt="img" />
            <div class="hwterk_dtl">
                <h4>How it is Work</h4>
                <p>{{ cache()->get('buyerSettings')['howItWorkHeader'] }}</p>
                <ul>
                    <li>
                        <img src="{{ asset('static/buyers/images/icons/slctn.svg') }}" alt="icn">
                        <div class="img_ctn">
                            <h4>{{ cache()->get('buyerSettings')['hitw_first_q'] }}</h4>
                            <p>{{ cache()->get('buyerSettings')['hitw_first_a'] }}</p>
                        </div>
                    </li>
                    <li>
                        <img src="{{ asset('static/buyers/images/icons/prcar.svg') }}" alt="icn">
                        <div class="img_ctn">
                            <h4>{{ cache()->get('buyerSettings')['hitw_second_q'] }}</h4>
                            <p>{{ cache()->get('buyerSettings')['hitw_second_a'] }}</p>
                        </div>
                    </li>
                    <li>
                        <img src="{{ asset('static/buyers/images/icons/bid.svg') }}" alt="icn">
                        <div class="img_ctn">
                            <h4>{{ cache()->get('buyerSettings')['hitw_third_q'] }}</h4>
                            <p>{{ cache()->get('buyerSettings')['hitw_third_a'] }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
