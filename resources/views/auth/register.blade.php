@extends('layouts.public')
@section('content')
        <!-- register-section -->
        <section class="register-section signup_padding">
            <div class="auto-container">
                <div class="row clearfix justify-content-center">
                    <div class="col-md-8">
                        <div class="tabs-box">
                            <div class="tab-btn-box">
                                <ul class="tab-btns tab-buttons centred clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1">Hostel Owner</li>
                                    <li class="tab-btn" data-tab="#tab-2">Student</li>
                                </ul>
                            </div>
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <h4>Register as Hostel Owner</h4>
                                        <form action="{{ route('register') }}" method="post" class="default-form">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="role" value="host"  class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}">
                                                @if($errors->has('role'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('role') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                                                @if($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                                                @if($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                                                @if($errors->has('password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="password_confirmation" required="">
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">{{ trans('global.register') }}</button>
                                            </div>
                                        </form>
                                        <div class="othre-text text-center">
                                            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="tab-2">
                                    <div class="inner-box">
                                        <h4>Register as Student</h4>
                                        <form action="{{ route('register') }}" method="post" class="default-form">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="role" value="student"  class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}">
                                                @if($errors->has('role'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('role') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                                                @if($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                                                @if($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                                                @if($errors->has('password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="password_confirmation" required="">
                                            </div>

                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">{{ trans('global.register') }}</button>
                                            </div>

                                        </form>
                                        <div class="othre-text text-center">
                                            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- register-section end -->
@endsection