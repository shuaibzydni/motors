@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Discover Vehicle')

@section('content')
                    @include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>Discover Your Car</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="#">Discover Vehicle</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- brpwser_vehicle  -->
    <div class="brsr_vhle_wrp">
        <div class="container_sub">
            <div class="brsr_vhle">
                <div class="brsr_vhlettl">
                    <div class="brsr_srcnt">
                        <h3>Search Result</h3>
                        <span>Latest Model Cars ({{ $cars->count() }})</span>
                    </div>
                    <div class="brsr_srtlst">
                        <span class="active"><i class="fa fa-th-large" aria-hidden="true"></i></span>
                        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                        <select name="" id="" onchange="document.getElementById('order_by').value = this.value; document.getElementById('discover-vehicle').submit();">
                            <option value="desc" {{ request()->order_by === 'desc' ? 'selected' : '' }}>Newest</option>
                            <option value="asc" {{ request()->order_by === 'asc' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                </div>
                <div class="brsr_srtyur">
                    <div class="brsr_grdrwq">
                        @forelse ($cars as $index => $car)
                            <div class="bsr_lstgz">
                            <div class="bsrlstg_dt">
                                <div class="bsr_fig">
                                    <img src="{{ $car->front_image }}" alt="ic">
{{--                                    <span class="fetrs">Featured</span>--}}
                                    <span class="dot_">{{ $car->published_at }}</span>
                                    <div class="fav_bsr">
                                        @if(request()->user('buyers_web'))
                                        <div class="fav_rte">
                                            <input type="checkbox" id="rate-{{ $car->id }}"
                                                   {{ in_array($car->id, request()->user('buyers_web')->my_fav_ids) ? "checked" : "" }}
                                                   @change="toggleFavourite(`{{ $car->id }}`, `{{ in_array($car->id, request()->user('buyers_web')->my_fav_ids) ? 'remove' : 'add' }}`)">
                                            <label for="rate-{{ $car->id }}">
                                                <img src="{{ asset('static/buyers/images/icons/heart.png') }}" alt="icn">
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="bsrcnt">
                                    <h4>{{ $car->name }} ({{ $car->brand_name }})</h4>
                                    <span>
                                            {{ $car->model_name }}
                                        </span>
                                    <div class="cr_prc">
                                        <div class="crprc_cd">
                                            <span>${{ $car->vehicle_price }}</span>
                                        </div>
                                        <a href="{{ route('buyer.pages.vehicleDetail', ['id' => $car->id]) }}" class="btn_secondary">See More Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bsrlstg_lc">
                                <img src="{{ asset('static/buyers/images/icons/lct_nic.png') }}" alt="icn">
                                <span>{{ $car->seller->address_line }}</span>
                            </div>
                        </div>
                        @empty
                            <p>No data found</p>
                        @endforelse
                        <div class="dcr_bt flx-center">
                            {!! $cars->links() !!}
                        </div>
                    </div>
                    <form method="GET" id="discover-vehicle" action="{{ route('buyer.pages.discoverVehicle') }}">
                        <input type="hidden" id="order_by" name="order_by" value="desc" @change="$_discoverVehicle()"/>
                        <div class="brsr_fltr">
                            <div class="bsrfrnt">
                                <div class="hdr_bsrflt">
                                    <h4>Filter By</h4>
                                    <span><a href="{{ route('buyer.pages.discoverVehicle') }}">RESET ALL</a></span>
                                </div>
                                <div class="bsr_fltr">
                                    <h5>Selected Filters</h5>
                                    <ul>
                                        @if(request()->order_by)
                                            @if(request()->order_by === 'asc')
                                                <li>Oldest <span @click="$_removeFilter('order_by', 'asc')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                                @else
                                                <li>Newest <span @click="$_removeFilter('order_by', 'desc')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                            @endif
                                        @endif
                                        @if(request()->make)
                                            @foreach(request()->make as $make)
                                            <li>{{ $makes->find($make)->name }} <span @click="$_removeFilter('make', 'make-{{ $makes->find($make)->id }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                            @endforeach
                                        @endif
                                        @if(request()->model)
                                            @foreach(request()->model as $model)
                                                @if($model && $models->find($model))
                                                <li>{{ $models->find($model)->name }} <span @click="$_removeFilter('model', 'model-{{ $models->find($model)->id }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if(request()->body_type)
                                            @foreach(request()->body_type as $body_type)
                                                <li>{{ $bodyTypes->find($body_type)->title }} <span @click="$_removeFilter('model', 'body_type-{{ $bodyTypes->find($body_type)->id }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                            @endforeach
                                        @endif
                                        @if(request()->fuel_type)
                                            @foreach(request()->fuel_type as $fuel_type)
                                                <li>{{ $fuelTypes->find($fuel_type)->name }} <span @click="$_removeFilter('model', 'fuel_type-{{ $fuelTypes->find($fuel_type)->id }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                            @endforeach
                                        @endif
                                        @if(request()->drive_type)
                                            @foreach(request()->drive_type as $drive_type)
                                                <li>{{ $driveTypes->find($drive_type)->title }} <span @click="$_removeFilter('model', 'drive_type-{{ $driveTypes->find($drive_type)->id }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                            @endforeach
                                        @endif
                                        @if(request()->transmission)
                                            @foreach(request()->transmission as $transmission)
                                                <li>{{ $transmissions->find($transmission)->title }} <span @click="$_removeFilter('model', 'transmission-{{ $transmissions->find($transmission)->id }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                            @endforeach
                                        @endif
                                        @if(request()->model_year)
                                            <li>{{ request()->model_year }} <span @click="$_removeFilter('model_year', '{{ request()->model_year }}')"><img src="{{ asset('static/buyers/images/cls+bl.png') }}" alt="icn"></span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="bsrbtmr">
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            Make ({{ $makes->count() }})
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <ul>
                                                @foreach($makes as $key => $make)
                                                <li>
                                                    <div class="chxtbx">
                                                        <input type="checkbox"
                                                               name="make[]" id="{{ 'make-' . $make->id }}"
                                                               value="{{ $make->id }}"
                                                               {{ in_array($make->id, request()->make ? request()->make : []) ? "checked" : "" }}
                                                               @change="$_discoverVehicle()"/>
                                                        <label for="{{ 'make-' . $make->id }}">{{ $make->name }}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            Select Model ({{ $models->count() }})
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <ul>
                                                @foreach($models as $key => $model)
                                                    <li>
                                                        <div class="chxtbx">
                                                            <input type="checkbox"
                                                                   name="model[]" id="{{ 'model-' . $model->id }}"
                                                                   value="{{ $model->id }}"
                                                                   {{ in_array($model->id, request()->model ? request()->model : []) ? "checked" : "" }}
                                                                   @change="$_discoverVehicle()"/>
                                                            <label for="{{ 'model-' . $model->id }}">{{ $model->name }} @if($model->product_brand_id && $model->brand)({{ $model->brand->name }})@endif</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            By Transmission ({{ $transmissions->count() }})
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <ul>
                                                @foreach($transmissions as $key => $transmission)
                                                    <li>
                                                        <div class="chxtbx">
                                                            <input type="checkbox"
                                                                   name="transmission[]" id="{{ 'transmission-' . $transmission->id }}"
                                                                   value="{{ $transmission->id }}"
                                                                   {{ in_array($transmission->id, request()->transmission ? request()->transmission : []) ? "checked" : "" }}
                                                                   @change="$_discoverVehicle()"/>
                                                            <label for="{{ 'transmission-' . $transmission->id }}">{{ $transmission->title }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            Body Type ({{ $bodyTypes->count() }})
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <ul>
                                                @foreach($bodyTypes as $key => $bodyType)
                                                    <li>
                                                        <div class="chxtbx">
                                                            <input type="checkbox"
                                                                   name="body_type[]" id="{{ 'body_type-' . $bodyType->id }}"
                                                                   value="{{ $bodyType->id }}"
                                                                   {{ in_array($bodyType->id, request()->body_type ? request()->body_type : []) ? "checked" : "" }}
                                                                   @change="$_discoverVehicle()"/>
                                                            <label for="{{ 'body_type-' . $bodyType->id }}">{{ $bodyType->title }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            Fuel Type ({{ $fuelTypes->count() }})
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <ul>
                                                @foreach($fuelTypes as $key => $fuelType)
                                                    <li>
                                                        <div class="chxtbx">
                                                            <input type="checkbox"
                                                                   name="fuel_type[]" id="{{ 'fuel_type-' . $fuelType->id }}"
                                                                   value="{{ $fuelType->id }}"
                                                                   {{ in_array($fuelType->id, request()->fuel_type ? request()->fuel_type : []) ? "checked" : "" }}
                                                                   @change="$_discoverVehicle()"/>
                                                            <label for="{{ 'fuel_type-' . $fuelType->id }}">{{ $fuelType->name }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            Drive Type ({{ $driveTypes->count() }})
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <ul>
                                                @foreach($driveTypes as $key => $driveType)
                                                    <li>
                                                        <div class="chxtbx">
                                                            <input type="checkbox"
                                                                   name="drive_type[]" id="{{ 'drive_type-' . $driveType->id }}"
                                                                   value="{{ $driveType->id }}"
                                                                   {{ in_array($driveType->id, request()->drive_type ? request()->drive_type : []) ? "checked" : "" }}
                                                                   @change="$_discoverVehicle()"/>
                                                            <label for="{{ 'drive_type-' . $driveType->id }}">{{ $driveType->title }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bsracd">
                                    <div class="set">
                                        <a href="javascript:void(0)">
                                            Years
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <div class="content">
                                            <select name="model_year" id="model_year" @change="$_discoverVehicle()">
                                                <option value="">Select Year</option>
                                                @foreach($modelYears as $year)
                                                    <option value="{{ $year }}" {{ request()->model_year == $year ? "selected" : "" }}>{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="bsracd">--}}
{{--                                    <div class="set">--}}
{{--                                        <a href="javascript:void(0)">--}}
{{--                                            Price Range--}}
{{--                                            <i class="fa fa-angle-right"></i>--}}
{{--                                        </a>--}}
{{--                                        <div class="content">--}}
{{--                                            <div class="rangeprce">--}}
{{--                                                <div class="rngvle">--}}
{{--                                                    <div class="rngvl_min">--}}
{{--                                                        <label>min</label>--}}
{{--                                                        <input type="text" value="$2,000">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="rngvl_max">--}}
{{--                                                        <label>max</label>--}}
{{--                                                        <input type="text" value="$25,000">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="sldrange">--}}
{{--                                                    <img src="{{ asset('static/buyers/images/range_pp.png') }}" alt="bnr">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- brpwser_vehicle  -->

    @include('buyers.parts.top_recommendation_slider')
@endsection
