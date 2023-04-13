@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Manage Bids')

@section('content')
                    @include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>My Favourites</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li class="active"><a href="#">Manage Bids</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- manage us tabs  -->
    <div class="mngbds_wrps">
        <div class="container">
            <manage-bids-tab>
                <template v-slot:current_bid>
                    <div class="tbsmngr_sbr">
                        @forelse($currentBids as $bids)
                        <div class="tbsmng_grd">
                            <div class="tnsmg_dtl">
                                <img src="{{ $bids->product->front_image }}" alt="bnr" />
                                <div class="crdnt">
                                    <div class="bid_crdnt_nme">
                                        <div class="bd_crdnt_mdl">
                                            <img src="{{ asset('static/buyers/images/icons/cr_ic.png') }}" alt="cr">
                                            <div class="cr_nm">
                                                <h3>{{ $bids->product->brand_name }} {{ $bids->product->model_name }}</h3>
                                                <p>{{ $bids->product->model_year }}</p>
                                            </div>
                                        </div>
                                        <div class="bd_crdnt_lbl">
                                            <label>Vehicle Price</label>
                                            <span>${{ $bids->product->vehicle_price }}</span>
                                        </div>
                                        <div class="bd_crdnt_btn">
                                            <a href="{{ route('buyer.pages.vehicleDetail', ['id' => $bids->product->id]) }}" class="btn_secondary">See car detail</a>
                                        </div>
                                    </div>
                                    <div class="bid_crdnt">
                                        <div class="bd_prc">
                                            <img src="{{ asset('static/buyers/images/icons/hmr_ic.png') }}" alt="icn" />
                                            <span>
                                                        My Bid Price
                                                        <label>${{ $bids->bid_price }}</label>
                                                    </span>
                                        </div>
                                       {{-- <div class="bd_edt">
                                           <img src="{{ asset('static/buyers/images/icons/edit_mg.png') }}" alt="icn" />
                                       </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="tnsmg_trm">
                                        {{-- <span class="trm_cnd"><img src="{{ asset('static/buyers/images/icons/chk_ic.png') }}" alt="icn" />Terms and
                                            Conditions</span> --}}
                                <span class="advid_nu"><label>Advertisement ID - </label>{{ $bids->product->advertisement_id }}</span>
                            </div>
                        </div>
                        @empty
                            <div class="tbsmng_grd">No data found.</div>
                        @endforelse
                    </div>
                </template>
                <template v-slot:successful_bid>
                    <div class="tbsmngr_sbr">
                        @forelse($successfulBids as $bids)
                        <div class="tbsmng_grd">
                            <div class="tnsmg_dtl">
                                <img src="{{ $bids->product->front_image }}" alt="bnr" />
                                <div class="crdnt">
                                    <div class="bid_crdnt_nme">
                                        <div class="bd_crdnt_mdl">
                                            <img src="{{ asset('static/buyers/images/icons/cr_ic.png') }}" alt="cr">
                                            <div class="cr_nm">
                                                <h3>{{ $bids->product->brand_name }} {{ $bids->product->model_name }}</h3>
                                                <p>{{ $bids->product->model_year }}</p>
                                            </div>
                                        </div>
                                        <div class="bd_crdnt_lbl">
                                            <label>Vehicle Price</label>
                                            <span>${{ $bids->product->vehicle_price }}</span>
                                        </div>
                                        <div class="bd_crdnt_btn">
                                            <a href="{{ route('buyer.pages.vehicleDetail', ['id' => $bids->product->id]) }}" class="btn_secondary">See car detail</a>
                                        </div>
                                    </div>
                                    <div class="bid_crdnt">
                                        <div class="bd_prc">
                                            <img src="{{ asset('static/buyers/images/icons/hmr_ic.png') }}" alt="icn" />
                                            <span>
                                                        Seller Name
                                                        <label>{{ $bids->seller->first_name }}</label>
                                                    </span>
                                        </div>
                                        <div class="bd_prc">
                                            <img src="{{ asset('static/buyers/images/icons/hmr_ic.png') }}" alt="icn" />
                                            <span>
                                                        My Bid Price
                                                        <label>${{ $bids->bid_price }}</label>
                                                    </span>
                                        </div>
                                        <span style="width:42px;">
                                                    <!-- alignment dnt remove this div -->
                                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="tnsmg_trm">
                                        {{-- <span class="trm_cnd"><img src="{{ asset('static/buyers/images/icons/chk_ic.png') }}" alt="icn" />Terms and
                                            Conditions</span> --}}
                                <span class="trm_stscl">
                                            Status
                                            <label>Purchased</label>
                                        </span>
                                <span class="advid_nu"><label>Advertisement ID - </label>{{ $bids->product->advertisement_id }}</span>
                            </div>
                        </div>
                        @empty
                            <div class="tbsmng_grd">No data found.</div>
                        @endforelse
                    </div>
                </template>
                <template v-slot:declined_bid>
                    <div class="tbsmngr_sbr">
                        @forelse($declinedBids as $bids)
                        <div class="tbsmng_grd">
                            <div class="tnsmg_dtl">
                                <img src="{{ $bids->product->front_image }}" alt="bnr" />
                                <div class="crdnt">
                                    <div class="bid_crdnt_nme">
                                        <div class="bd_crdnt_mdl">
                                            <img src="{{ asset('static/buyers/images/icons/cr_ic.png') }}" alt="cr">
                                            <div class="cr_nm">
                                                <h3>{{ $bids->product->brand_name }} {{ $bids->product->model_name }}</h3>
                                                <p>{{ $bids->product->model_year }}</p>
                                            </div>
                                        </div>
                                        <div class="bd_crdnt_lbl">
                                            <label>Vehicle Price</label>
                                            <span>${{ $bids->product->vehicle_price }}</span>
                                        </div>
                                        <div class="bd_crdnt_btn">
                                            <a href="{{ route('buyer.pages.vehicleDetail', ['id' => $bids->product->id]) }}" class="btn_secondary">See car detail</a>
                                        </div>
                                    </div>
                                    <div class="bid_crdnt sdtcrd">
                                        <div class="bd_prc">
                                            <img src="{{ asset('static/buyers/images/icons/hmr_ic.png') }}" alt="icn" />
                                            <span>
                                                        My Bid Price
                                                        <label>${{ $bids->bid_price }}</label>
                                                    </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tnsmg_trm">
                                        {{-- <span class="trm_cnd"><img src="{{ asset('static/buyers/images/icons/chk_ic.png') }}" alt="icn" />Terms and
                                            Conditions</span> --}}
                                <span class="trm_stsfl">
                                            Status
                                            <label>Cancelled</label>
                                        </span>
                                <span class="advid_nu"><label>Advertisement ID - </label>{{ $bids->product->advertisement_id }}</span>
                            </div>
                        </div>
                        @empty
                            <div class="tbsmng_grd">No data found.</div>
                        @endforelse
                    </div>
                </template>
            </manage-bids-tab>

        </div>
    </div>
    <!-- manage us tabs  -->
@endsection
