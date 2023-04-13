@extends('sellers.layouts.seller_layout')

@section('pageName', 'Contact Us')

@section('content')
    <div class="banner about_bg">
        <div class="content_main">
            <img src="{{ asset('static/sellers/images/contact_us_mg.png') }}" alt=""/>
            <div class="content_lst common_content">
                <h1>Contact Us</h1>
                <ul>
                    <li><a href="{{ route('seller.pages.home') }}">Home</a> <span>&#62;</span><a href="#" class="active-clr">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--banner-->
    <div class="contact_info_wrap wrapper">
        <div class="container">
            <div class="contact_info">
                <div class="contact-lst">
                    <h2>Get in Touch</h2>
                    {!! cache()->get('sellerSettings')['contactUs'] !!}
                    <div class="mail_box">
                        <a class="ico_cen" href="mailto:samplemailid123@gmail.com"><img src="{{ asset('static/sellers/images/contact_ico.png') }}"/></a>
                        <div class="mail_cont">
                            <span>Mail us to</span>
                            <a href="mailto:{{ cache()->get('sellerSettings')['siteEmail'] }}">{{ cache()->get('sellerSettings')['siteEmail'] }}</a>
                        </div>
                    </div>
                </div> </div>
        </div>
    </div>
@endsection
