@extends('adminlte::page')

@section('title', 'Faq ' . ucwords($model))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Faq ' . ucwords($model)) }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('faqs.create', ['model' => $model]) }}" class="btn bg-gradient-primary float-right">Add Faq</a>
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
                        <h3 class="card-title">{{ 'Faq ' . ucwords($model) }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($faqs as $index => $faq)
                                <tr>
                                    <td>{{ $index + $faqs->firstItem() }}</td>
                                    <td>{{ $faq->question }}</td>
                                    <td>{{ $faq->answer }}</td>
                                    <td>
                                        <a href="{{ route('faqs.edit', ['model' => $model, 'id' => $faq->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form method="POST" action="{{ route('faqs.destroy', ['model' => $model, 'id' => $faq->id]) }}"
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
                            {!! $faqs->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop
