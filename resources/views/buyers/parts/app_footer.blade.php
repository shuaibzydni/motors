<div class="ftr_wrp tp_shppr">
        <div class="ftr_scltrm">
            <div class="container">
                <div class="ftr_sclmn">
                    <div class="ftrabt">
                        <img src="{{ asset('static/buyers/images/fLogo.jpg') }}" alt="icn" />
                        <h4>Who We Are</h4>
                        <p>{{ cache()->get('buyerSettings')['siteDescription'] }}</p>
                    </div>
                    <div class="ftrabt_lnk">
                        <h4>Links</h4>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="{{ route('buyer.pages.aboutUs') }}">About Us</a></li>
                            <li><a href="{{ route('buyer.pages.contactUs') }}">Contact Us</a></li>
                            <li><a href="{{ route('buyer.pages.helpCenter') }}">Help Center</a></li>
                            <li><a href="{{ route('buyer.pages.termsAndConditions') }}">Terms & Policies</a></li>
                        </ul>
                    </div>
                    <div class="ftrabthlp">
                        <div class="ftrhpy">
                            <h4>Happy to Help you</h4>
                            <span><img src="{{ asset('static/buyers/images/icons/malbx.png') }}" alt="icn">{{ cache()->get('buyerSettings')['siteEmail'] }}</span>
                            <span><img src="{{ asset('static/buyers/images/icons/phone-call.png') }}" alt="icn">{{ cache()->get('buyerSettings')['sitePhone'] }}</span>
                        </div>
                        <div class="ftrscl">
                            <h4>Follow Us On</h4>
                            <ul>
                                @foreach(cache()->get('social_links') as $socialLink)
                                    <li><a href="{{$socialLink->link}}"><i class="fa fa-{{$socialLink->fa_icon}}" aria-hidden="true"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ftr_cpyrgt">
            <div class="container">
                <div class="cpgt_cnt">
                    <p>© Copyrights {{ cache()->get('buyerSettings')['siteName'] }} 2021. All rights reserved</p>
                </div>
            </div>
        </div>
</div>
