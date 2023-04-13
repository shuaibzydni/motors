@extends('adminlte::page')

@section('title', 'Vehicles')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Vehicle - ') . $vehicle->name }} ({{ $vehicle->brand_name }})</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('vehicle.index') }}" class="btn bg-gradient-primary float-right">Back</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle</h3>
                        </div>

                        <admin-image-slider :carData="{{ json_encode($vehicle) }}"></admin-image-slider>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <!--<tr>-->
                                <!--    <td><strong>{{ __('Vehicle Name') }}</strong></td>-->
                                <!--    <td>{{ $vehicle->name }}</td>-->
                                <!--</tr>-->
                                <tr>
                                    <td><strong>{{ __('Vehicle Brand') }}</strong></td>
                                    <td>{{ $vehicle->brand_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Vehicle Model') }}</strong></td>
                                    <td>{{ $vehicle->model_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Vehicle Description') }}</strong></td>
                                    <td>{{ $vehicle->model_description }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Body Type') }}</strong></td>
                                    <td>{{ $vehicle->body_type }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Fuel Type') }}</strong></td>
                                    <td>{{ $vehicle->fuel_type }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Drive Type') }}</strong></td>
                                    <td>{{ $vehicle->drive_type }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Transmission') }}</strong></td>
                                    <td>{{ $vehicle->transmission }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Odometer Mileage') }}</strong></td>
                                    <td>{{ $vehicle->odometer_mileage }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Vehicle VIN') }}</strong></td>
                                    <td>{{ $vehicle->vehicle_vin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Vehicle Registration Number') }}</strong></td>
                                    <td>{{ $vehicle->vehicle_registration_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Vehicle Price') }}</strong></td>
                                    <td>$ {{ $vehicle->vehicle_price }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Vehicle Status') }}</strong></td>
                                    <td>{{ $vehicle->vehicle_status }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body">
                            <h4>Seller Detail</h4>
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <tr>
                                    <td><strong>{{ __('Name') }}</strong></td>
                                    <td>{{ $vehicle->seller->first_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Email') }}</strong></td>
                                    <td>{{ $vehicle->seller->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Name') }}</strong></td>
                                    <td>{{ $vehicle->seller->business_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Phone') }}</strong></td>
                                    <td>{{ $vehicle->seller->business_phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Email') }}</strong></td>
                                    <td>{{ $vehicle->seller->business_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Registration Document') }}</strong></td>
                                    <td>
                                        @if($vehicle->seller->business_registration_document)
                                            <a href="{{ route('sellers.documentDownload', ['path' => $vehicle->seller->business_registration_document]) }}" class="btn btn-sm btn-warning">Download</a>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('ABN') }}</strong></td>
                                    <td>{{ $vehicle->seller->abn }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Address Line') }}</strong></td>
                                    <td>{{ $vehicle->seller->address_line }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Location') }}</strong></td>
                                    <td>{{ $vehicle->seller->location ? $vehicle->seller->location->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Postal Code') }}</strong></td>
                                    <td>{{ $vehicle->seller->postal_code }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
