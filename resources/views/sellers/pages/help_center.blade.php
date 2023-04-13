@extends('sellers.layouts.seller_layout')

@section('pageName', 'Help Center')

@section('content')
    <div class="banner about_bg">
        <div class="content_main">
            <img src="{{ asset('static/sellers/images/help_center.png') }}" alt="">
            <div class="content_lst common_content">
                <h1>Help Center (FAQ)</h1>
                <ul>
                    <li><a href="{{ route('seller.pages.home') }}">Home</a> <span>&gt;</span><a href="#" class="active-clr">Help Center</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--help center-->
    <div class="terms_cond wrapper">
        <div class="container">
            <div class="terms_lst ">
                <div class="faq">

                    <h1>How Can we Help You</h1>
                    <div class="faq_search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <form action="{{ route('seller.pages.helpCenter') }}">
                        <input type="search" name="search" placeholder="Ask a Question to Search here..."/>
                        <button type="submit">Search Now</button>
                        </form>
                    </div>
                    <div class="faq_mg">
                        <img src="{{ asset('static/sellers/images/faq_bg.png') }}"/>
                    </div>
                </div>

                <h2 class="common_title">Frequently Asked Questions</h2>
                <!--accord-->
                <div class="content">

                    <div class="acc">
                        @foreach($faqs as $faq)
                            <div class="acc__card">
                                <div class="acc__title">{{ $faq->question }}</div>
                                <div class="acc__panel">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--accord-->
            </div>
        </div>
    </div>
    <!--help center-->
@endsection

@push('js')
    <script>
        $(function() {
            $('.acc__title').click(function(j) {
                var dropDown = $(this).closest('.acc__card').find('.acc__panel');
                $(this).closest('.acc').find('.acc__panel').not(dropDown).slideUp();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).closest('.acc').find('.acc__title.active').removeClass('active');
                    $(this).addClass('active');
                }
                dropDown.stop(false, true).slideToggle();
                j.preventDefault();
            });
        });
    </script>
@endpush
