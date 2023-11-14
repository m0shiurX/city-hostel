@extends('layouts.public')
@section('content')
        <!-- Sign in-section -->
        <section class="register-section sec-pad">
            <div class="auto-container">
                <div class="row clearfix justify-content-center">
                    <div class="col-md-6">
                        <div class="inner-box">
                            <h4>Log in</h4>
                            <form action="" method="post" class="default-form">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" required="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="name" required="">
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Sign in</button>
                                </div>
                            </form>
                            <div class="othre-text">
                                <p>Have not any account? <a href="{{ route('public.signup') }}">Register Now</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in-section end -->

        
@endsection