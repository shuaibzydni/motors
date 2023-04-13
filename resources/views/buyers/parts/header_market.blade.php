<div class="hdr_mrkt">
    <div class="hdr_cntpg">
        <h1>{{ cache()->get('buyerSettings')['homePageTitle'] }}</h1>
        <p>{{ cache()->get('buyerSettings')['homePageSubTitle'] }}</p>
    </div>
    <div class="hdr_flds">
        <h3>The Complete Guide to Find your Perfect Car</h3>
        <form method="GET" id="discover-vehicle" action="{{ route('buyer.pages.discoverVehicle') }}">
        <input type="hidden" name="order_by" value="desc" />
        <div class="cmplt_gde">
            <div class="drpgrn">
                <span>1</span>
                <select name="make[]" id="select-brand">
                    <option selected disabled value="#">Select Make</option>
                    @foreach ($makes as $make)
                        <option value="{{ $make->id }}"> {{ $make->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="drpgrn">
                <span>2</span>
                <select name="model[]" id="select-model">
                    <option selected disabled value="#">Select Model</option>
                </select>
            </div>
            <div class="drpgrn">
                <span>3</span>
                <select name="model_year">
                    <option selected disabled value="#">Select year</option>
                    @foreach ($modelYears as $year)
                        <option value="{{ $year }}"> {{ $year }} </option>
                    @endforeach
                </select>
            </div>
            <div class="drpgrn">
                <span>4</span>
                <select name="body_type[]">
                    <option selected disabled value="#">Select Body Type</option>
                    @foreach ($bodyTypes as $bodyType)
                        <option value="{{ $bodyType->id }}"> {{ $bodyType->title }} </option>
                    @endforeach
                </select>
            </div>
            <div class="drpgrn">
                <span>5</span>
                <select name="fuel_type[]">
                    <option selected disabled value="#">Select Fuel Type</option>
                    @foreach ($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->id }}"> {{ $fuelType->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="drpgrn">
                <span>6</span>
                <select name="drive_type[]">
                    <option selected disabled value="#">Select Drive Type</option>
                    @foreach ($driveTypes as $driveType)
                        <option value="{{ $driveType->id }}"> {{ $driveType->title }} </option>
                    @endforeach
                </select>
            </div>
{{--            <div class="drprge">--}}
{{--                <div class="drp_prcrng">--}}
{{--                    <span>5</span>--}}
{{--                    <label>Price Ranage</label>--}}
{{--                </div>--}}
{{--                <div class="drpd_rnge">--}}
{{--                    <div class="price-range-slider">--}}
{{--                        <p class="range-value">--}}
{{--                            <input type="text" id="amount" readonly>--}}
{{--                        </p>--}}
{{--                        <div id="slider-range" class="range-bar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="drpcln_bt">
                <button class="btn_primary srchicn" type="submit"> <img src="{{ asset('static/buyers/images/icons/search_white.png') }}"
                                                          alt="">Find Cars</button>
            </div>
        </div>
        </form>
    </div>
</div>
