@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Help Center')

@section('content')
                    @include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>Help Center (FAQ)</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="#">Help Center</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- help center  -->
    <div class="help_center">
        <div class="container">
            <div class="hlp_wrp">
                <div class="hpl_srch">
                    <div class="hpl_sbx">
                        <h2>How Can we Help You</h2>
                        <form action="{{ route('buyer.pages.helpCenter') }}">
                        <div class="srchpd_srcnw">
                            <div class="schnw_ic">
                                <img src="{{ asset('static/buyers/images/icons/search_green.png') }}" alt="icon" />
                            </div>
                            <input type="search" name="search" placeholder="Ask a Question to Search here...">
                            <button type="submit" class="btn_primary">Search Now</button>
                        </div>
                        </form>
                    </div>
                    <img src="{{ asset('static/buyers/images/hlp_cnt.png') }}" alt="icn">
                </div>
                <div class="hpl_acdrn">
                    <h2>Frequently Asked Questions</h2>
                    @foreach($faqs as $faq)
                    <div class="set">
                        <a href="javascript:void(0)">
                            {{ $faq->question }}
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <div class="content">
                            {{ $faq->answer }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(".set > a").on("click", function () {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $(this)
                        .siblings(".content")
                        .slideUp(200);
                    $(".set > a i")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                } else {
                    $(".set > a i")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                    $(this)
                        .find("i")
                        .removeClass("fa-plus")
                        .addClass("fa-minus");
                    $(".set > a").removeClass("active");
                    $(this).addClass("active");
                    $(".content").slideUp(200);
                    $(this)
                        .siblings(".content")
                        .slideDown(200);
                }
            });
        });
    </script>
@endsection
