@extends('adminlte::page')

@section('title', $modelName . ' - ' . 'Subscription Plan')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $modelName . ' - ' . 'Subscription Plan' }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('subscription.create', ['model' => $model]) }}" class="btn bg-gradient-primary float-right">Add Subscription</a>
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
                            <h3 class="card-title">{{ $modelName . ' - ' . 'Subscription Plan' }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th>Name</th>
                                    <th>Cost</th>
                                    <th>Type</th>
                                    <th>Limit</th>
                                    <th>Description</th>
                                    <th style="width: 150px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($subscriptions as $index => $subscription)
                                    <tr>
                                        <td>{{ $index + $subscriptions->firstItem() }}</td>
                                        <td>{{ $subscription->name }}</td>
                                        <td>${{ $subscription->cost }}</td>
                                        <td>/ {{ $subscription->type }}</td>
                                        <td>{{ $subscription->limit >= 100000 ? 'Unlimited' : $subscription->limit }}</td>
                                        <td>{{ $subscription->description }}</td>
                                        <td>
                                            <a href="{{ route('subscription.edit', [$model, $subscription->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('subscription.destroy', ['model' => $model, 'id' => $subscription->id]) }}"
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
                                {!! $subscriptions->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
