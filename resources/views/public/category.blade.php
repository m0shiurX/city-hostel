@extends('layouts.public')
@section('content')
	        <!--Page Title-->
        <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{ asset('frontend/images/shape/shape-9.png') }});"></div>
                <div class="pattern-2" style="background-image: url({{ asset('frontend/images/shape/shape-10.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Categories</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li>Categories</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        <!-- category-section -->
        <section class="category-section category-page centred mr-0 pt-120 pb-90">
            <div class="auto-container">
                <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <ul class="category-list clearfix">
						@foreach($categories as $key => $category)
                          <li>
                            <div class="category-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-{{ $category->id }}"></i></div>
                                    <h5><a href="{{ route('public.hostel') }}">{{ $category->name }}</a></h5>
                                    <span>{{ $category->category_hostels_count }}</span>
                                </div>
                            </div>
                        </li>
                         @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <!-- category-section end -->
@endsection