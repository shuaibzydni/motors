@extends('adminlte::page')

@section('title', 'Product Models')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Product Models') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('productMakes.create') }}" class="btn bg-gradient-primary float-right">Add Product Model</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-2 col-md-8">
                @include('shared.errors')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product Model</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('productMakes.index') }}" method="GET">
                        <div class="row mb-2">
                            <input type="text" placeholder="Search by Name" name="search" id="search" value="{{ old('search', request()->search) }}" class="form-control col-4 m-2">
                            <select name="brand_id" id="brand_id" class="form-control col-4 m-2">
                                <option value="">Filter by Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', request()->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <input type="submit" class="btn btn-sm btn-primary m-2 col-2" value="Search">
                        </div>
                        </form>

                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productMakes as $index => $productMake)
                                <tr>
                                    <td>{{ $index + $productMakes->firstItem() }}</td>
                                    <td>{{ $productMake->name }}</td>
                                    <td>{{ $productMake->product_brand_id && $productMake->brand ? $productMake->brand->name : '-' }}</td>
                                    <td>
                                        <a href="{{ route('productMakes.edit', $productMake->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form method="POST" action="{{ route('productMakes.destroy', $productMake->id) }}"
                                              accept-charset="UTF-8"
                                              style="display: inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete?');">
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
                            {!! $productMakes->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop
