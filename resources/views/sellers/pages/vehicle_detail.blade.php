@extends('sellers.layouts.seller_layout')

@section('pageName', 'Vehicle Detail')

@section('content')
    <vehicle-detail :carData="{{ json_encode($product) }}" :biddings="{{ json_encode($biddings) }}"></vehicle-detail>
@endsection
