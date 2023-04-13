@extends('buyers.layouts.login_layout')

@section('content')
    <div class="login_wrapper forgot-wrap w-100 flt">
        <div class="login-margin-auto-part">
            <a href="/">
                <img class="login-logo" width="300" src="{{ asset('static/buyers/images/motortraders_logo.png') }}" alt="logo"/>
            </a>
            <div class="switch-part">
                <a class="login-sw swich-sec active" href="{{ route('buyer.login') }}">Login</a>
                <a class="new-user-sw swich-sec" href="{{ route('buyer.register') }}">New User</a>
            </div>
            <div class="login-section">
                @if(session('success'))
                    <div class="reg-success">{{session('success')}}</div>
                @endif
                <h2><span>Welcome to</span> {{ cache()->get('buyerSettings')['siteName'] }}</h2>
                <p>Login to continue using your account</p>
                <form class="login-form" method="POST" action="{{ route('buyer.login.post') }}">
                    @csrf
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/email.png') }}" alt="email"></span>
                        <input type="text" name="email" value="{{ old('email') }}"/>
                        <label>Email</label>
                    </div>
                    @if($errors->has('email'))
                    <strong class="invalid-msg">{{ $errors->first('email') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/padlock.png') }}" alt="padlock"/></span>
                        <input type="password" name="password" value="{{ old('password') }}" id="password"/>
                        <label>Password</label>
                        <div class="password-toggle" onclick="togglePassword()" style="cursor: pointer">
                            <img id="hide" src="{{ asset('static/buyers/images/hide.png') }}" alt="hide"/>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <strong class="invalid-msg">{{ $errors->first('password') }}</strong>
                    @endif
                    <div class="forgot-sec">
                        <a href="{{ route('buyer.password.request') }}">Forgot Password?</a>
                    </div>
                    <div class="submit-btn w-100">
                        <button type="submit" class="login-btn">LOGIN</button>
                    </div>
                    <div class="login-within-line">
                    <span class="line-part">Or Login With</span>
                    </div>
                    <div class="social-media-btns">
                        <a href="{{ route('buyer.redirect.google') }}" class="google-btn"><img src="{{ asset('static/buyers/images/google.png') }}" alt="google"/> Google</a>
                        <a href="{{ route('buyer.redirect.facebook') }}" class="fb-btn"><img src="{{ asset('static/buyers/images/facebook.png') }}" alt="facebook"/> Facebook</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("hide")
            if (x.type === "password") {
                x.type = "text";
                y.src = "{{ asset('static/buyers/images/password-eye.png') }}"
            } else {
                x.type = "password";
                y.src = "{{ asset('static/buyers/images/hide.png') }}"
            }
        }
    </script>
@endsection
