@extends('sellers.layouts.login_layout')

@section('content')
    <div class="login_wrapper create-account w-100 flt">
        <div class="login-margin-auto-part">
            <a href="{{ route('seller.pages.home') }}">
                <img class="login-logo" width="300" src="{{ asset('static/buyers/images/motortraders_logo.png') }}" alt="logo"/>
            </a>
            <div class="switch-part">
                <a class="login-sw swich-sec" href="{{ route('seller.login') }}">Login</a>
                <a class="new-user-sw swich-sec active" href="{{ route('seller.register') }}">New User</a>
            </div>
            <div class="login-section">
                <p>Create your account</p>
                <form class="login-form" method="POST"  action="{{ route('seller.register.post') }}" enctype="multipart/form-data" novalidate>
                    <div id="style-3" class="register-scrolable">
                    @csrf
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/email.png') }}" alt="first_name"></span>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"/>
                        <label>Full Name</label>
                    </div>
                    @if($errors->has('first_name'))
                        <strong class="invalid-msg">{{ $errors->first('first_name') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/email.png') }}" alt="email"></span>
                        <input type="text" name="email" value="{{ old('email') }}"/>
                        <label>Email Address</label>
                    </div>
                    @if($errors->has('email'))
                        <strong class="invalid-msg">{{ $errors->first('email') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/smartphone.png') }}" alt="business_phone"></span>
                        <input type="text" name="business_phone" value="{{ old('business_phone') }}"/>
                        <label>Phone</label>
                    </div>
                    @if($errors->has('business_phone'))
                        <strong class="invalid-msg">{{ $errors->first('business_phone') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/smartphone.png') }}" alt="business_name"></span>
                        <input type="text" name="business_name" value="{{ old('business_name') }}"/>
                        <label>Business Name</label>
                    </div>
                    @if($errors->has('business_name'))
                        <strong class="invalid-msg">{{ $errors->first('business_name') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/smartphone.png') }}" alt="business_email"></span>
                        <input type="text" name="business_email" value="{{ old('business_email') }}"/>
                        <label>Business Email</label>
                    </div>
                    @if($errors->has('business_email'))
                        <strong class="invalid-msg">{{ $errors->first('business_email') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/glyph.png') }}" alt="address_line"></span>
                        <input type="text" name="address_line" value="{{ old('address_line') }}"/>
                        <label>Address Line</label>
                    </div>
                    @if($errors->has('address_line'))
                        <strong class="invalid-msg">{{ $errors->first('address_line') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/location.png') }}" alt="location_id"></span>
                        <select name="location_id">
                            <option>Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"> {{ $state->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('location_id'))
                        <strong class="invalid-msg">{{ $errors->first('location_id') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/email.png') }}" alt="postal_code"></span>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}"/>
                        <label>Postal Code</label>
                    </div>
                    @if($errors->has('postal_code'))
                        <strong class="invalid-msg">{{ $errors->first('postal_code') }}</strong>
                    @endif
                    <div class="input-container">
                        <span class="form-inp-icon"><img src="{{ asset('static/buyers/images/padlock.png') }}" alt="padlock"/></span>
                        <input type="password" id="password" name="password" value="{{ old('password') }}"/>
                        <label>Password</label>
                        <div class="password-toggle" onclick="togglePassword()" style="cursor: pointer">
                            <img id="hide" src="{{ asset('static/buyers/images/hide.png') }}" alt="hide"/>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <strong class="invalid-msg">{{ $errors->first('password') }}</strong>
                    @endif
                    <div class="submit-btn w-100">
                        <button type="submit" class="login-btn">REGISTER</button>
                    </div>
                    </div>
                    <div class="login-within-line">
                        <span class="line-part">Or Login With</span>
                    </div>
                    <div class="social-media-btns">
                        <a href="{{ route('seller.redirect.google') }}" class="google-btn"><img src="{{ asset('static/sellers/images/google.png') }}" alt="google"/> Google</a>
                        <a href="{{ route('seller.redirect.facebook') }}" class="fb-btn"><img src="{{ asset('static/sellers/images/facebook.png') }}" alt="facebook"/> Facebook</a>
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
                y.src = "{{ asset('static/sellers/images/password-eye.png') }}"
            } else {
                x.type = "password";
                y.src = "{{ asset('static/sellers/images/hide.png') }}"
            }
        }
    </script>
@endsection
