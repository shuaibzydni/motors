@extends('buyers.layouts.buyer_layout')

@section('pageName', 'About Us')

@section('content')
@include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>About Us</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="#">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- company trade  -->
    <div class="cmpy_trd">
        <div class="container">
            <div class="cmpytrd_wrp">
                <div class="cmypy_cntr">
                    <h5>{{ cache()->get('buyerSettings')['siteName'] }}</h5>
                    {!! cache()->get('buyerSettings')['aboutUs'] !!}
                </div>
                <div class="cmypy_img">
                    <img src="{{ asset('static/buyers/images/plcrpl.png') }}" alt="bnr">
                </div>
            </div>
        </div>
    </div>
    <!-- company trade  -->
    <!-- How it work  -->
    <div class="hwtwrk_wrp tp_shppr">
        <div class="container">
            <div class="hwterk_cnt">
                <img src="{{ asset('static/buyers/images/car_tc.png') }}" alt="img" />
                <div class="hwterk_dtl">
                    <h4>How it is Work</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <ul>
                        <li>
                            <img src="{{ asset('static/buyers/images/icons/slctn.svg') }}" alt="icn">
                            <div class="img_ctn">
                                <h4>Choose Location</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae
                                    soluta, dignissimos aut, assumenda dolore totam natus qui cum.
                                </p>
                            </div>
                        </li>
                        <li>
                            <img src="{{ asset('static/buyers/images/icons/prcar.svg') }}" alt="icn">
                            <div class="img_ctn">
                                <h4>Find Your Perfect Car</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae
                                    soluta, dignissimos aut, assumenda dolore totam natus qui cum.
                                </p>
                            </div>
                        </li>
                        <li>
                            <img src="{{ asset('static/buyers/images/icons/bid.svg') }}" alt="icn">
                            <div class="img_ctn">
                                <h4>Bid Your Request</h4>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae
                                    soluta, dignissimos aut, assumenda dolore totam natus qui cum.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- How it work  -->
    <!-- company trade  -->
    <div class="cmpy_trd blbgm">
        <div class="container">
            <div class="cmpytrd_wrp">
                <div class="cmypy_cntr">
                    <h5>{{ cache()->get('buyerSettings')['siteName'] }}</h5>
                    <p>{{ cache()->get('buyerSettings')['siteDescription'] }}</p>
                </div>
                <div class="cmypy_img">
                    <img src="{{ asset('static/buyers/images/drk_ppl.png') }}" alt="bnr">
                </div>
            </div>
        </div>
    </div>
@endsection
