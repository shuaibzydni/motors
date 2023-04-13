@extends('adminlte::page')

@section('title', 'Buyer')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Buyer - ') . $buyer->first_name}}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('buyers.index') }}" class="btn bg-gradient-primary float-right">Back</a>
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
                            <h3 class="card-title">Buyers</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <tr>
                                    <td><strong>{{ __('Name') }}</strong></td>
                                    <td>{{ $buyer->first_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Email') }}</strong></td>
                                    <td>{{ $buyer->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Name') }}</strong></td>
                                    <td>{{ $buyer->business_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Phone') }}</strong></td>
                                    <td>{{ $buyer->business_phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Email') }}</strong></td>
                                    <td>{{ $buyer->business_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Business Registration Document') }}</strong></td>
                                    <td>
                                        @if($buyer->business_registration_document)
                                            <a href="{{ route('buyers.documentDownload', ['path' => $buyer->business_registration_document]) }}" class="btn btn-sm btn-warning">Download</a>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('ABN') }}</strong></td>
                                    <td>{{ $buyer->abn }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Address Line') }}</strong></td>
                                    <td>{{ $buyer->address_line }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Location') }}</strong></td>
                                    <td>{{ $buyer->location ? $buyer->location->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Postal Code') }}</strong></td>
                                    <td>{{ $buyer->postal_code }}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Subscription Plan') }}</strong></td>
                                    @if($latestSubscription && $latestSubscription->plan_data)
                                        <td>
                                            <div>{{ $latestSubscription->plan_data['name'] }} (${{ $latestSubscription->plan_data['cost'] }})</div>
                                            <div><strong>Expires at: </strong> {{ $latestSubscription->ends_at->format('d-m-Y') }}</div>
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
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
@stop
