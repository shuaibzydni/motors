@extends('sellers.layouts.seller_layout')

@section('pageName', 'My Vehicles')

@section('content')
    <!--banner-->
    <div class="banner about_bg">
        <div class="content_main">
            <img src="{{ asset('static/sellers/images/about_us_mg.png') }}" alt=""/>
            <div class="content_lst common_content">
                <h1>My Vehicles</h1>
                <ul>
                    <li><a href="{{ route('seller.pages.home') }}">Home</a> <span>&#62;</span><a href="#" class="active-clr">My Vehicles</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--banner-->
    <!--my vehicle-->
    <my-vehicles></my-vehicles>
    <!--my vehicle-->
@endsection
