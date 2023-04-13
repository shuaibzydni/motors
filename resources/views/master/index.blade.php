@extends('adminlte::page')

@section('title', $modelName)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $modelName }}</h1>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <master-component
            :model-name="`{{ $modelName }}`"
            :column-name="`{{ $columnName }}`"
        ></master-component>
    </section>
@stop
