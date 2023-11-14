@extends('layouts.public')
@section('content')
        <!-- register-section -->
        <section class="register-section signup_padding">
            <div class="auto-container">
                <div class="row clearfix justify-content-center">
                    <div class="col-md-8 ">
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
                                        <form action="" method="post" class="default-form">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name="email" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="password" required="">
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Sign up</button>
                                            </div>
                                        </form>
                                        <div class="othre-text text-center">
                                            <p>Already have an account? <a href="{{ route('public.signin') }}">Sign in</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="tab-2">
                                    <div class="inner-box">
                                        <h4>Register as Student</h4>
                                        <form action="" method="post" class="default-form">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name="email" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="name" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="name" required="">
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Sign up</button>
                                            </div>
                                        </form>
                                        <div class="othre-text text-center">
                                            <p>Already have an account? <a href="{{ route('public.signin') }}">Sign in</a></p>
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