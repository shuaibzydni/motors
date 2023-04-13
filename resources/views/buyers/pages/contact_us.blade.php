@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Contact Us')

@section('content')
@include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>Contact Us</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- contact_us  -->
    <div class="cnct_us">
        <div class="container">
            <div class="cnxt_wrp">
                <div class="gttc_wrp">
                    <h3>Get in Touch</h3>
                    {!! cache()->get('buyerSettings')['contactUs'] !!}
                    <div class="mail_bx">
                        <label>Mail us to</label>
                        <span>{{ cache()->get('buyerSettings')['siteEmail'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact_us  -->

@endsection
