@extends('adminlte::page')

@section('title', 'Create Subscription Plan - ' . $modelName )

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Create Subscription - ')  . $modelName }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('subscription.index', ['model' => $model]) }}" class="btn bg-gradient-primary float-right">Back</a>
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
                            <h3 class="card-title">Create Subscription Plan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('subscription.edit', ['model' => $model, $subscriptionPlan->id]) }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Plan Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name', $subscriptionPlan->name) }}">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Cost</label>
                                    <input type="text" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" placeholder="Cost" value="{{ old('cost', $subscriptionPlan->cost) }}">
                                    @error('cost')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Per</label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                        @foreach(\App\Models\SubscriptionPlan::PLAN_TYPE as $planType)
                                            <option value="{{ $planType }}" {{ old('type', $subscriptionPlan->type) === $planType ? 'selected' : '' }}>{{ ucwords($planType) }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="unlimited" name="unlimited" value="1" {{ $subscriptionPlan->limit > 99999 ? 'checked' : '' }}>
                                        <label for="unlimited" class="custom-control-label">Check this box for no limit</label>
                                    </div>
                                </div>
                                <div class="form-group limit-bid">
                                    <label for="name">Limit (Bid or Car Create Limit)</label>
                                    <input type="text" class="form-control @error('limit') is-invalid @enderror" id="limit" name="limit" placeholder="0" value="{{ old('limit', $subscriptionPlan->limit) }}">
                                    @error('limit')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description (Optional)" value="{{ old('description', $subscriptionPlan->description) }}">
                                    @error('description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h4>Subscription Features</h4>
                                @foreach($subscriptionPlan->features as $feature)
                                <div id="inputFormRow">
                                    <div class="input-group mb-3">
                                        <input type="text" name="features[]" class="form-control m-input" placeholder="Feature" autocomplete="off" value="{{ $feature->features }}">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div id="newRow"></div>
                                <button id="addRow" type="button" class="btn btn-info">Add Feature</button>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        if({{ $subscriptionPlan->limit }} > 99999) {
            $(".limit-bid").hide();
        }

        $("#unlimited").change(function() {
            if ( $(this).is(':checked') ) {
                $(".limit-bid").hide();
            } else {
                $(".limit-bid").show();
            }
        });

        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="features[]" class="form-control m-input" placeholder="Feature" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
