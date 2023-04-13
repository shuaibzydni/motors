<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>@yield('pageName') - Motor Trader Seller</title>
    <link rel="stylesheet" href="{{ asset('static/sellers/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('static/sellers/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/sellers/css/responsive.css') }}">
    @yield('css')
</head>
<body>
<div id="app" class="page">
    @include('sellers.parts.app_header')
    @yield('content')
    @include('sellers.parts.mobile_app')
    @include('sellers.parts.app_footer')
    <form method="POST" id="seller-logout" action="{{ route('seller.logout') }}">
        @csrf
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function redirectToAccountSettings() {
        window.location = "{{ route('seller.pages.accountDetail') }}"
    }

    // Notification
    function togglePopup() {
        $(".notification_body").toggle();
    }
    
    $(document).ready(function () {
        var base_url = window.location.origin;
        var pathname = window.location.pathname;
        
        $('.btn_markallread').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: base_url + "/notification-allread",
                success: function (response) {
                    if(response.data == 'success') {
                        $('.notifitcaion_mgs').removeClass('unread');
                        
                        if(pathname == '/notifications') {
                            location.reload(true);
                        }
                    }
                }
            });
        });
    });
</script>
@stack('js')
</body>
</html>
