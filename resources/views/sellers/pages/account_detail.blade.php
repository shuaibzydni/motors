@extends('sellers.layouts.seller_layout')

@section('pageName', 'Account Detail')

@section('content')
    <!-- manage us tabs  -->
    <div class="mngbds_wrps">
        <div class="container">
            <div class="mgnbr_sct">
                <div class="tabs-nav">
                    <ul>
                        <li class="active"><a href="#tab1">Profile Settings</a></li>
                        <li><a href="#tab2">Change Password</a></li>
                        <li class="lgt_sgn" @click="$_confirmSellerLogout"><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div id="tab1">
                        <div class="prfle_stng">
                            <div class="prfle_hdr">
                                <h3>Profile Settings</h3>
                            </div>
                            @if(session('success'))
                                <div class="reg-success">{{session('success')}}</div>
                            @endif
                            @if($errors->has('avatar'))
                                <div class="reg-error">{{ $errors->first('avatar') }}</div>
                            @endif
                            <div class="prfle_cnt">
                                <form method="POST" action="{{ route('seller.changeAvatar') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="prfle_vew" style="margin: 10px 20px 20px 20px;">
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
                                <form class="login-form" method="POST" action="{{ route('seller.updateAccountDetail') }}">
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
                                                <img src="{{ asset('static/buyers/images/icons/suitcase.svg') }}" alt="icon">
                                                <div class="myproform_lbl">
                                                    <label>Business Name</label>
                                                    <input type="text"
                                                           name="business_name"
                                                           value="{{ old('business_name', $user->business_name) }}" />
                                                </div>
                                            </div>
                                            @if($errors->has('business_name'))
                                                <strong class="invalid-msg">{{ $errors->first('business_name') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="myrow">
                                        <div class="myproform_wrp">
                                            <div class="myproform">
                                                <img src="{{ asset('static/buyers/images/icons/email.svg') }}" alt="icon">
                                                <div class="myproform_lbl emlvf">
                                                    <label>Business Email</label>
                                                    <input type="email"
                                                           name="business_email"
                                                           value="{{ old('business_email', $user->business_email) }}" />
                                                    <img src="{{ asset('static/buyers/images/icons/verify.png') }}" alt="icn">
                                                </div>
                                            </div>
                                            @if($errors->has('business_email'))
                                                <strong class="invalid-msg">{{ $errors->first('business_email') }}</strong>
                                            @endif
                                        </div>
                                        <div class="myproform_wrp">
                                            <div class="myproform">
                                                <img src="{{ asset('static/buyers/images/icons/smartphone.svg') }}" alt="icon">
                                                <div class="myproform_lbl">
                                                    <label>Business Phone</label>
                                                    <input type="text"
                                                           name="business_phone"
                                                           value="{{ old('business_phone', $user->business_phone) }}" />
                                                </div>
                                            </div>
                                            @if($errors->has('business_phone'))
                                                <strong class="invalid-msg">{{ $errors->first('business_phone') }}</strong>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="myrow">
                                        <div class="myproform_wrp">
                                            <div class="myproform">

                                                <div class="myproform_lbl pl-0">
                                                    <label>Business Registration Document</label>
                                                    <div class="pdflstr">
                                                        <img src="{{ asset('static/buyers/images/icons/pdf.svg') }}" alt="icp">
                                                            <input type="file" id="uplodr" />
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->has('business_registration_document'))
                                                <strong class="invalid-msg">{{ $errors->first('business_registration_document') }}</strong>
                                            @endif
                                        </div>
                                        <div class="myproform_wrp">
                                            <div class="myproform">
                                                <img src="{{ asset('static/buyers/images/icons/identity-card.svg') }}" alt="icon">
                                                <div class="myproform_lbl">
                                                    <label>ABN</label>
                                                    <input type="text" name="abn" value="{{ old('abn', $user->abn) }}" />
                                                </div>
                                            </div>
                                            <@if($errors->has('abn'))
                                                <strong class="invalid-msg">{{ $errors->first('abn') }}</strong>
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
                                        <button class="btn_primary">Update Changes</button>
                                        <button class="btn_middle">cancel Changes</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tab2">
                        <div class="prfle_stng">
                            <div class="prfle_hdr">
                                <h3>Change Password</h3>
                            </div>
                            <div class="prfle_cnt">
                                <form class="login-form" method="POST" action="{{ route('seller.changePassword') }}">
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
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- manage us tabs  -->
@endsection

@push('js')
    <script>
        $(function () {
            $('.tabs-nav a').click(function () {

                // Check for active
                $('.tabs-nav li').removeClass('active');
                $(this).parent().addClass('active');

                // Display active tab
                let currentTab = $(this).attr('href');
                $('.tabs-content >div').hide();
                $(currentTab).show();

                return false;
            });
        });

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
