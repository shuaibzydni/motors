@extends('sellers.layouts.seller_layout')

@section('pageName', 'About Us')

@section('content')
    <!--banner-->
    <div class="banner about_bg">
        <div class="content_main">
            <img src="{{ asset('static/sellers/images/about_us_mg.png') }}" alt=""/>
            <div class="content_lst common_content">
                <h1>About Us</h1>
                <ul>
                    <li><a href="{{ route('seller.pages.home') }}">Home</a> <span>&#62;</span><a href="#" class="active-clr">About Us</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--banner-->
    @include('sellers.parts.company_trade')

    @include('sellers.parts.how_it_work')
@endsection
