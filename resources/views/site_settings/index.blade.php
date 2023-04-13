@extends('adminlte::page')

@section('title', 'Site Setting - ' . $model)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Site Settings - ' . $model) }}</h1>
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
                            <h3 class="card-title">Site Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('siteSettings.update', ['model' => $model]) }}" novalidate>
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="siteName">Site Name</label>
                                    <input type="text" class="form-control @error('siteName') is-invalid @enderror" id="siteName" name="siteName" placeholder="Site Name" value="{{ old('siteName', $siteSettings['siteName']) }}">
                                    @error('siteName')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="siteDescription">Site Description</label>
                                    <textarea class="form-control @error('siteDescription') is-invalid @enderror" id="siteDescription" name="siteDescription" placeholder="Description">{{ old('siteDescription', $siteSettings['siteDescription']) }}</textarea>
                                    @error('siteDescription')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="siteEmail">Site Email</label>
                                    <input type="email" class="form-control @error('siteEmail') is-invalid @enderror" id="siteEmail" name="siteEmail" placeholder="Email" value="{{ old('siteEmail', $siteSettings['siteEmail']) }}">
                                    @error('siteEmail')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="siteName">Site Phone</label>
                                    <input type="text" class="form-control @error('sitePhone') is-invalid @enderror" id="sitePhone" name="sitePhone" placeholder="Site Phone" value="{{ old('sitePhone', $siteSettings['sitePhone']) }}">
                                    @error('sitePhone')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="appGooglePlay">App Google Play Link</label>
                                    <input type="text" class="form-control @error('appGooglePlay') is-invalid @enderror" id="appGooglePlay" name="appGooglePlay" value="{{ old('appGooglePlay', $siteSettings['appGooglePlay']) }}">
                                    @error('appGooglePlay')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="appAppStore">App Store Link</label>
                                    <input type="text" class="form-control @error('appAppStore') is-invalid @enderror" id="appAppStore" name="appAppStore" value="{{ old('appAppStore', $siteSettings['appAppStore']) }}">
                                    @error('appAppStore')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="aboutUs">About Us Content</label>
                                    <textarea class="form-control @error('aboutUs') is-invalid @enderror" id="aboutUs" name="aboutUs" placeholder="About Us">{{ old('aboutUs', $siteSettings['aboutUs']) }}</textarea>
                                    @error('aboutUs')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="aboutUs">Contact Us Content</label>
                                    <textarea class="form-control @error('contactUs') is-invalid @enderror" id="contactUs" name="contactUs" placeholder="Contact Us">{{ old('contactUs', $siteSettings['contactUs']) }}</textarea>
                                    @error('contactUs')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="terms">Terms and Conditions Content</label>
                                    <textarea class="form-control @error('terms') is-invalid @enderror" id="terms" name="terms" placeholder="terms">{{ old('terms', $siteSettings['terms']) }}</textarea>
                                    @error('terms')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="homePageTitle">Home Page Title</label>
                                    <textarea class="form-control @error('homePageTitle') is-invalid @enderror" id="homePageTitle" name="homePageTitle" placeholder="">{{ old('homePageTitle', $siteSettings['homePageTitle']) }}</textarea>
                                    @error('homePageTitle')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="homePageSubTitle">Home Page Subtitle</label>
                                    <textarea class="form-control @error('homePageSubTitle') is-invalid @enderror" id="homePageSubTitle" name="homePageSubTitle" placeholder="">{{ old('homePageSubTitle', $siteSettings['homePageSubTitle']) }}</textarea>
                                    @error('homePageSubTitle')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="topRecommendationHeader">Top Recommendation Header</label>
                                    <textarea class="form-control @error('topRecommendationHeader') is-invalid @enderror" id="topRecommendationHeader" name="topRecommendationHeader" placeholder="">{{ old('topRecommendationHeader', $siteSettings['topRecommendationHeader']) }}</textarea>
                                    @error('topRecommendationHeader')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <h2 class="mt-5">How It Works Content</h2>

                                <div class="form-group">
                                    <label for="howItWorkHeader">How it work Header</label>
                                    <textarea class="form-control @error('howItWorkHeader') is-invalid @enderror" id="howItWorkHeader" name="howItWorkHeader" placeholder="">{{ old('howItWorkHeader', $siteSettings['howItWorkHeader']) }}</textarea>
                                    @error('howItWorkHeader')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <hr/>

                                <h5>How it work content 1</h5>
                                <div class="form-group">
                                    <textarea class="form-control @error('hitw_first_q') is-invalid @enderror" id="hitw_first_q" name="hitw_first_q" placeholder="">{{ old('hitw_first_q', $siteSettings['hitw_first_q']) }}</textarea>
                                    @error('hitw_first_q')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control @error('hitw_first_a') is-invalid @enderror" id="hitw_first_a" name="hitw_first_a" placeholder="">{{ old('hitw_first_a', $siteSettings['hitw_first_a']) }}</textarea>
                                    @error('hitw_first_a')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <h5>How it work content 2</h5>
                                <div class="form-group">
                                    <textarea class="form-control @error('hitw_second_q') is-invalid @enderror" id="hitw_second_q" name="hitw_second_q" placeholder="">{{ old('hitw_second_q', $siteSettings['hitw_second_q']) }}</textarea>
                                    @error('hitw_second_q')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control @error('hitw_second_a') is-invalid @enderror" id="hitw_second_a" name="hitw_second_a" placeholder="">{{ old('hitw_second_a', $siteSettings['hitw_second_a']) }}</textarea>
                                    @error('hitw_second_a')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <h5>How it work content 3</h5>
                                <div class="form-group">
                                    <textarea class="form-control @error('hitw_third_q') is-invalid @enderror" id="hitw_third_q" name="hitw_third_q" placeholder="">{{ old('hitw_third_q', $siteSettings['hitw_third_q']) }}</textarea>
                                    @error('hitw_third_q')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control @error('hitw_third_a') is-invalid @enderror" id="hitw_third_a" name="hitw_third_a" placeholder="">{{ old('hitw_third_a', $siteSettings['hitw_third_a']) }}</textarea>
                                    @error('hitw_third_a')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
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
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/file-manager?type=Images',
            filebrowserImageUploadUrl: '/file-manager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/file-manager?type=Files',
            filebrowserUploadUrl: '/file-manager/upload?type=Files&_token='
        };

        CKEDITOR.replace('aboutUs', options);
        CKEDITOR.replace('contactUs', options);
        CKEDITOR.replace('terms', options);
    </script>
@stop
