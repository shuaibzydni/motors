<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>@yield('pageName') - Motor Trader Seller</title>
    <link rel="stylesheet" href="{{ asset('static/sellers/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/sellers/css/responsive.css') }}">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    @yield('css')
</head>
<body>
<div id="app" class="pricing-plan_wrapper w-100 flt">
    <div class="pricing-plan-bg">
        <div class="pp-logo w-100">
            <img width="300" src="{{ asset('static/sellers/images/motortraders_logo.png') }}" alt="logo"/>
        </div>
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>
