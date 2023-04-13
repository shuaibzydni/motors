@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Home')

@section('content')
    <!-- header -->
    @include('buyers.parts.header_nav')
    <div class="main_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    @include('buyers.parts.header_market')
                </div>
                <a class="mse_pd">
                    <img src="{{ asset('static/buyers/images/icons/mouse.png') }}" alt="ico">
                </a>
            </div>
        </div>
    </div>
    <!-- header end -->
    @include('buyers.parts.top_recommendation')
    @include('buyers.parts.how_it_work')
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#select-brand').on('change', function () {
                let brandId = this.value;
                $("#select-model").html('');
                $.ajax({
                    url: "{{ route('buyer.ajax.modelByBrand') }}",
                    type: "GET",
                    data: {
                        brand_id: brandId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#select-model').html('<option value="">Select Model</option>');
                        $.each(result, function (key, value) {
                            $("#select-model").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
