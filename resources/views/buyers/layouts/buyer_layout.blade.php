<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>@yield('pageName') - Motor Trader Buyer</title>
    <link rel="stylesheet" href="{{ asset('static/buyers/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('static/buyers/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('static/buyers/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('static/buyers/css/resposnive.css') }}">
    <link rel="stylesheet" href="{{ asset('static/buyers/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/buyers/css/owl.theme.min.css') }}">
    @yield('css')
</head>
<body>
<div id="app" class="fullwrapper">
    @yield('content')
    @include('buyers.parts.mobile_app')
    @include('buyers.parts.app_footer')
    <form method="POST" id="buyer-logout" action="{{ route('buyer.logout') }}">
        @csrf
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    // Notification
    function togglePopup() {
        $(".notification_body").toggle();
        $('.prf_stng').hide();
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
