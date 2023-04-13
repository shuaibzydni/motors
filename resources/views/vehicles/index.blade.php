@extends('adminlte::page')

@section('title', 'Vehicles')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Vehicles') }}</h1>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('shared.errors')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <!--<th>Name</th>-->
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Fuel Type</th>
                                    <th>Drive Type</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($vehicles as $index => $vehicle)
                                    <tr>
                                        <td>{{ $index + $vehicles->firstItem() }}</td>
                                        <!--<td>{{ $vehicle->name }}</td>-->
                                        <td>{{ $vehicle->brand_name }}</td>
                                        <td>{{ $vehicle->model_name }}</td>
                                        <td>{{ $vehicle->fuel_type }}</td>
                                        <td>{{ $vehicle->drive_type }}</td>
                                        <td>
                                            <a href="{{ route('vehicle.show', $vehicle->id) }}" class="btn btn-sm btn-info">View</a>
                                            <form method="POST" action="{{ route('vehicle.destroy', $vehicle->id) }}"
                                                  accept-charset="UTF-8"
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to delete? This action cannot be undone');">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                {!! $vehicles->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
