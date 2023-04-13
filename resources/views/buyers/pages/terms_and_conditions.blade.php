@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Terms and Condition')

@section('content')
                    @include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>Terms & Policies</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Terms & Conditions and Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- terms&policy  -->
    <div class="trms_prlcwrp">
        <div class="container">
            <div class="trms_flrcep">
                <div class="trms_flrgrd">
                    <h2>Terms & Conditions</h2>
                    <div class="trms_bx">
                        {!! cache()->get('buyerSettings')['terms'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- terms&policy  -->

@endsection
