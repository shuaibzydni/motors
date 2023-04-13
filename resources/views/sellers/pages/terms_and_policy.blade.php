@extends('sellers.layouts.seller_layout')

@section('pageName', 'Terms and Policy')

@section('content')
    <!--banner-->
    <div class="banner about_bg">
        <div class="content_main">
            <img src="{{ asset('static/sellers/images/terms_mg.png') }}" alt=""/>
            <div class="content_lst common_content">
                <h1>Terms & Policies</h1>
                <ul>
                    <li><a href="{{ route('seller.pages.home') }}">Home</a> <span>&#62;</span><a href="#" class="active-clr"> Terms & Conditions and Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--banner-->

    <!--terms-->
    <div class="terms_cond wrapper">
        <div class="container">
            <div class="terms_lst ">
                <h2 class="common_title"> Terms & Conditions</h2>
                <div class="common_cont_lst">
                    {!! cache()->get('sellerSettings')['terms'] !!}
                </div>
            </div>
        </div>
    </div>
    <!--terms-->
@endsection
