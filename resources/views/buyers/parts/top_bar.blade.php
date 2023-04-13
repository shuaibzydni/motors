<div class="hdr_sclmd">
    <ul class="scl_mdi">
        @foreach(cache()->get('social_links') as $socialLink)
            <li><a href="{{$socialLink->link}}"><i class="fa fa-{{$socialLink->fa_icon}}" aria-hidden="true"></i></a></li>
        @endforeach
    </ul>
    <ul class="scl_trs">
        <li><a href="{{ route('buyer.pages.aboutUs') }}">About Us</a></li>
        <li><a href="{{ route('buyer.pages.contactUs') }}">Contact Us</a></li>
        <li><a href="{{ route('buyer.pages.helpCenter') }}">Help Center</a></li>
        <li><a href="{{ route('buyer.pages.termsAndConditions') }}">Terms & Policies</a></li>
    </ul>
</div>
