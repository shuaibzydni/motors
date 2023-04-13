@extends('adminlte::page')

@section('title', 'Sellers')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Sellers') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('sellers.index') }}" class="btn bg-gradient-primary float-right">{{ __('Back') }}</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">

                @include('shared.errors')

                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Create Seller') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('sellers.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="first_name">Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                                    @error('first_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5 class="mt-4 mb-2 col-12">{{ _('Other Details') }}</h5>
                                <div class="form-group col-12">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" class="form-control @error('business_name') is-invalid @enderror" id="business_name" name="business_name" value="{{ old('business_name') }}" placeholder="Business Name">
                                    @error('business_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="business_phone">Business Phone</label>
                                    <input type="text" class="form-control @error('business_phone') is-invalid @enderror" id="business_phone" name="business_phone" value="{{ old('business_phone') }}" placeholder="Business Phone">
                                    @error('business_phone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="business_email">Business Email</label>
                                    <input type="email" class="form-control @error('business_email') is-invalid @enderror" id="business_email" name="business_email" value="{{ old('business_email') }}" placeholder="Business Email">
                                    @error('business_email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="abn">ABN</label>
                                    <input type="text" class="form-control @error('abn') is-invalid @enderror" id="abn" name="abn" value="{{ old('abn') }}" placeholder="ABN">
                                    @error('abn')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="abn">Business Registration Document</label>
                                    <input type="file" class="form-control @error('business_registration_document') is-invalid @enderror" id="business_registration_document" name="business_registration_document" value="{{ old('business_registration_document') }}">
                                    @error('business_registration_document')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="address_line">Address</label>
                                    <textarea class="form-control @error('address_line') is-invalid @enderror" id="address_line" name="address_line" placeholder="Address">{{ old('address_line') }}</textarea>
                                    @error('address_line')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="location_id">Location</label>
                                    <select class="form-control select2 @error('location_id') is-invalid @enderror" id="select2-dropdown" name="location_id" data-placeholder="Select a Location">
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal Code">
                                    @error('postal_code')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="postal_code">Subscription Plan</label>
                                    <select class="form-control @error('subscription_plan_id') is-invalid @enderror" id="subscription_plan_id" name="subscription_plan_id">
                                        <option value="">Select Plan (Optional)</option>
                                        @foreach($subscriptionPlans as $subscriptionPlan)
                                            <option value="{{ $subscriptionPlan->id }}">{{ $subscriptionPlan->name }} ({{ $subscriptionPlan->cost }})</option>
                                        @endforeach
                                    </select>
                                    @error('subscription_plan_id')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#select2-dropdown').select2();
        });
    </script>
@stop
