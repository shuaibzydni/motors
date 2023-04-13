@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Account Settings')

@section('content')
@include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>Account Settings</h1>
                        <ul>
                            <li><a href="{{ route('buyer.pages.home') }}">Home</a></li>
                            <li><a href="#">Account Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- manage us tabs  -->
    <div class="mngbds_wrps">
        <div class="container">
            <account-settings-tab>
                <template v-slot:profile_settings>
                    <div class="prfle_stng">
                        @if(session('success'))
                            <div class="reg-success">{{session('success')}}</div>
                        @endif
                        @if($errors->has('avatar'))
                            <div class="reg-error">{{ $errors->first('avatar') }}</div>
                        @endif
                        <div class="prfle_hdr">
                            <h3>Profile Settings</h3>
                        </div>
                        <div class="prfle_cnt">
                            <form method="POST" action="{{ route('buyer.changeAvatar') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="prfle_vew">
                                <div class="prfl_img">
                                    <label for="avatar-preview">
                                        <img src="{{ $user->avatar }}" id="avatar" alt="icn" style="cursor: pointer">
                                        <input type="file" id="avatar-preview" name="avatar" style="display:none">
                                    </label>
                                    <div class="prfl_nme">
                                        <h4>{{ $user->first_name }}</h4>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn_proprimary">Change Profile Image</button>
                            </div>
                            </form>
                        <form class="login-form" method="POST" action="{{ route('buyer.updateAccountDetail') }}">
                            @csrf
                            <div class="prfle_frmfld">
                                <div class="myrow">
                                    <div class="myproform_wrp">
                                        <div class="myproform">
                                            <img src="{{ asset('static/buyers/images/icons/user.svg') }}" alt="icon">
                                            <div class="myproform_lbl">
                                                <label>Full Name</label>
                                                <input type="text"
                                                       name="first_name"
                                                       value="{{ old('first_name', $user->first_name) }}" />
                                            </div>
                                        </div>
                                        @if($errors->has('first_name'))
                                            <strong class="invalid-msg">{{ $errors->first('first_name') }}</strong>
                                        @endif
                                    </div>
                                    <div class="myproform_wrp">
                                        <div class="myproform">
                                            <img src="{{ asset('static/buyers/images/icons/email.svg') }}" alt="icon">
                                            <div class="myproform_lbl emlvf">
                                                <label>Email</label>
                                                <input type="email"
                                                       name="email"
                                                       value="{{ old('email', $user->email) }}" />
                                                <img src="{{ asset('static/buyers/images/icons/verify.png') }}" alt="icn">
                                            </div>
                                        </div>
                                        @if($errors->has('email'))
                                            <strong class="invalid-msg">{{ $errors->first('email') }}</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="myrow">
                                    <div class="myproform_wrp">
                                        <div class="myproform">
                                            <img src="{{ asset('static/buyers/images/icons/smartphone.svg') }}" alt="icon">
                                            <div class="myproform_lbl">
                                                <label>Phone</label>
                                                <input type="text"
                                                       name="business_phone"
                                                       value="{{ old('business_phone', $user->business_phone) }}" />
                                            </div>
                                        </div>
                                        @if($errors->has('business_phone'))
                                            <strong class="invalid-msg">{{ $errors->first('business_phone') }}</strong>
                                        @endif
                                    </div>
                                    <div class="myproform_wrp">
                                        <div class="myproform">
                                            <img src="{{ asset('static/buyers/images/glyph.png') }}" alt="icon">
                                            <div class="myproform_lbl">
                                                <label>Address Line</label>
                                                <input type="text"
                                                       name="address_line"
                                                       value="{{ old('address_line', $user->address_line) }}" />
                                            </div>
                                        </div>
                                        @if($errors->has('address_line'))
                                            <strong class="invalid-msg">{{ $errors->first('address_line') }}</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="myrow">
                                    <div class="myproform_wrp">
                                        <div class="myproform slctbx">
                                            <img src="{{ asset('static/buyers/images/icons/location.svg') }}" alt="icon">
                                            <div class="myproform_lbl">
                                                <label>State</label>
                                                <select name="location_id" id="location_id">
                                                    <option>Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}" {{ ($state->id == old('location_id', $user->location_id)) ? 'selected' : '' }}> {{ $state->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if($errors->has('location_id'))
                                            <strong class="invalid-msg">{{ $errors->first('location_id') }}</strong>
                                        @endif
                                    </div>
                                    <div class="myproform_wrp">
                                        <div class="myproform">
                                            <img src="{{ asset('static/buyers/images/icons/mailbox.svg') }}" alt="icon">
                                            <div class="myproform_lbl">
                                                <label>Post Code</label>
                                                <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" />
                                            </div>
                                        </div>
                                        @if($errors->has('postal_code'))
                                            <strong class="invalid-msg">{{ $errors->first('postal_code') }}</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="prosubmt_fld">
                                    <button type="submit" class="btn_primary">Update Changes</button>
                                    <button type="reset" class="btn_middle">cancel Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </template>
                <template v-slot:change_password>
                    <div class="prfle_stng">
                        <div class="prfle_hdr">
                            <h3>Change Password</h3>
                        </div>
                        <div class="prfle_cnt">
                            <form class="login-form" method="POST" action="{{ route('buyer.changePassword') }}">
                                @csrf
                                <div class="prfle_frmfld">
                                    <div class="myrow">
                                        <div class="myproform_wrp">
                                            <div class="myproform">
                                                <img src="{{ asset('static/buyers/images/icons/padlock.svg') }}" alt="icon">
                                                <div class="myproform_lbl">
                                                    <label>Old Password</label>
                                                    <input type="password" name="old_password" id="old_password" value="{{ old('old_password') }}"/>
                                                    <div id="psdwr1" onclick="togglePassword('old_password', 'hide1')">
                                                        <img id="hide1" src="{{ asset('static/buyers/images/icons/hide_eye.svg') }}" class="eyehd"
                                                             alt="icn" />
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->has('old_password'))
                                                <strong class="invalid-msg">{{ $errors->first('old_password') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="myrow">
                                        <div class="myproform_wrp">
                                            <div class="myproform">
                                                <img src="{{ asset('static/buyers/images/icons/padlock.svg') }}" alt="icon">
                                                <div class="myproform_lbl">
                                                    <label>Create New Password</label>
                                                    <input type="password" name="password" id="password"/>
                                                    <div id="psdwr2" onclick="togglePassword('password', 'hide2')">
                                                        <img id="hide2" src="{{ asset('static/buyers/images/icons/hide_eye.svg') }}" class="eyehd"
                                                             alt="icn" />
                                                    </div>

                                                </div>
                                            </div>
                                            @if($errors->has('password'))
                                                <strong class="invalid-msg">{{ $errors->first('password') }}</strong>
                                            @endif
                                        </div>
                                        <div class="myproform_wrp">
                                            <div class="myproform">
                                                <img src="{{ asset('static/buyers/images/icons/padlock.svg') }}" alt="icon">
                                                <div class="myproform_lbl">
                                                    <label>Confirm New Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation"/>
                                                    <div id="psdwr3" onclick="togglePassword('password_confirmation', 'hide3')">
                                                        <img id="hide3" src="{{ asset('static/buyers/images/icons/hide_eye.svg') }}" class="eyehd"
                                                             alt="icn" />
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->has('password_confirmation'))
                                                <strong class="invalid-msg">{{ $errors->first('password_confirmation') }}</strong>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="prosubmt_fld">
                                        <button type="submit" class="btn_primary">Update Changes</button>
                                        <button type="reset" class="btn_middle">cancel Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>
            </account-settings-tab>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#avatar-preview").change(function(){
            readURL(this);
        });

        function togglePassword(passwordId, imageId) {
            var x = document.getElementById(passwordId);
            var y = document.getElementById(imageId)
            if (x.type === "password") {
                x.type = "text";
                y.src = "{{ asset('static/buyers/images/icons/open_eye.svg') }}"
            } else {
                x.type = "password";
                y.src = "{{ asset('static/buyers/images/icons/hide_eye.svg') }}"
            }
        }
    </script>
@endpush
