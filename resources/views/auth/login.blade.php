@extends('layouts.public')
@section('content')
        <!-- Sign in-section -->
        <section class="register-section sec-pad">
            <div class="auto-container">
                <div class="row clearfix justify-content-center">
                    <div class="col-md-6">
                        <div class="inner-box">
                            <h4 class="text-muted">{{ trans('global.login') }}</h4>

                            @if(session('message'))
                                <div class="alert alert-info" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form action="{{ route('login') }}" method="POST" class="default-form">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" required="">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" required="">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Sign in</button>
                                </div>
                                <div class="form-row align-items-center mb-4">
                                    <div class="col-6">
                                        <div class="form-check checkbox">
                                            <input class="form-check-input remember-check" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                            <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                                {{ trans('global.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        @if(Route::has('password.request'))
                                            <a class="btn btn-link text-warning px-0" href="{{ route('password.request') }}">
                                                {{ trans('global.forgot_password') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                
                            </form>
                            <div class="othre-text">
                                
                                <p>Have not any account? <a href="{{ route('register') }}">Register Now</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in-section end -->

        
@endsection