<div class="hdr_bnr">
    @if(request()->route()->getName() === 'buyer.pages.home')
    <div id="testimonial-slider" class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/banner.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.helpCenter')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/question-mark.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.favourites')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/bnr_nst.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.manageBids')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/bnr_nst.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.termsAndConditions')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/kybrd.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.contactUs')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/ph_cit.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.aboutUs')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/btct.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.accountSettings')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/bnr_nst.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.discoverVehicle')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/cr1.png') }}" alt="banner_pic">
        </div>
    </div>
    @elseif(request()->route()->getName() === 'buyer.pages.vehicleDetail')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/cr2.png') }}" alt="banner_pic">
        </div>
    </div>
    @else(request()->route()->getName() === 'buyer.pages.home')
    <div class="hdr_bnr">
        <div class="bnrsldr">
            <img src="{{ asset('static/buyers/images/bnr_nst.png') }}" alt="banner_pic">
        </div>
    </div>
    @endif
</div>
