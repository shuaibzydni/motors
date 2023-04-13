@extends('adminlte::page')

@section('title', 'Create Faq for ' . ucwords($model))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Create Faq') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('faqs.index', ['model' => $model]) }}" class="btn bg-gradient-primary float-right">Back</a>
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
                            <h3 class="card-title">Create Faq for {{ ucwords($model) }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('faqs.store', ['model' => $model]) }}" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea class="form-control @error('question') is-invalid @enderror" id="question" name="question" placeholder="Question">{{ old('question') }}</textarea>
                                    @error('question')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" placeholder="Answer">{{ old('answer') }}</textarea>
                                    @error('answer')
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
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('question');
        CKEDITOR.replace('answer');
    </script>
@stop
