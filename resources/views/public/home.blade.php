@extends('layouts.public')
@section('content')
<!-- banner-section -->
        <section class="banner-section" style="background-image: url({{ asset('frontend/images/banner/cover_x.jpg') }});">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="content-box centred">
                        <h2>Find your hostel through us</h2>
                        <p>First time in Dhaka we are making accomodition easy for students</p>
                    </div>
                    <div class="search-field">
                        <div class="tabs-box">
                            <div class="tab-btn-box">
                                <ul class="tab-btns tab-buttons centred clearfix">
                                </ul>
                            </div>
                            <div class="tabs-content info-group pb-5">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <div class="top-search">
                                            <form action="{{route('public.hostel')}}" method="get" class="search-form">
                                                <div class="row clearfix">
                                                    <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                        <div class="form-group">
                                                            <label>Search Hostels</label>
                                                            <div class="field-input">
                                                                <i class="fas fa-search"></i>
                                                                <input type="search" name="search-field" placeholder="Search by location or Landmark..." required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                        <div class="form-group">
                                                            <label>Location</label>
                                                            <div class="select-box">
                                                                <i class="far fa-compass"></i>
                                                                <select class="wide">
                                                                   <option data-display="Any Area">Any Area</option>
                                                                   @foreach($areas as $key => $area)
                                                                   <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                                   @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <div class="select-box">
                                                                <select class="wide">
                                                                   <option data-display="All Category">All Category</option>
                                                                   @foreach($categories as $key => $category)
                                                                   <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                   @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="search-btn">
                                                    <button type="submit"><i class="fas fa-search"></i>Search</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-section end -->


        <!-- category-section -->
        <section class="category-section centred">
            <div class="auto-container">
                <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <ul class="category-list clearfix">
                        @foreach($categories as $key => $category)
                        <li>
                            <div class="category-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-{{ $category->id }}"></i></div>
                                    <h5><a href="#">{{ $category->name }}</a></h5>
                                    <span>{{ $category->category_hostels_count }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="more-btn"><a href="{{ route('public.categories') }}" class="theme-btn btn-one">All Categories</a></div>
                </div>
            </div>
        </section>
        <!-- category-section end -->


        <!-- feature-section -->
        <section class="feature-section sec-pad bg-color-1" id="feature">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h5>Features</h5>
                    <h2>Featured Hostels</h2>
                    <p>Here are few featured hostels with maximum facilities <br /> within the affordable price range.</p>
                </div>
                <div class="row clearfix">

                    @foreach($hostels as $key => $hostel)
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block mb-5">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        @if($hostel->featured_image)
                                                <img src="{{ $hostel->featured_image->getUrl() }}">
                                        @else
                                            <img src="https://picsum.photos/id/1/370/250" alt="">
                                        @endif

                                    </figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">{{ $hostel->categories->first()->name }}</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pl-0 pull-left">
                                            <h5> {{ $hostel->area->name ?? '' }} </h5>
                                        </div>
                                        <div class="buy-btn pull-right"> <a href="#">Seats available {{ $hostel->available_room_count ?? '' }}</a></div>
                                    </div>
                                    <div class="title-text"><h4><a href="property-details.html">{{ $hostel->name ?? '' }}</a></h4></div>
                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Starts from</h6>
                                            <h4>BDT  {{ $hostel->hostelRooms->first()->min_price ?? '' }} <span class="font-xs">/month</span></h4>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                        </ul>
                                    </div>
                                    <p>{{ $hostel->address ?? '' }}</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="icon-14"></i>{{ $hostel->total_seat ?? '' }} Seats</li>
                                        <li class="pl-3"><i class="icon-3"></i>Since {{ $hostel->built_on ?? '' }}</li>
                                        <li><i class="icon-16"></i>{{ $hostel->garage_size ?? '' }}</li>
                                    </ul>
                                    <div class="btn-box"><a href="{{ route('public.hostel.show', $hostel->id)}}" class="theme-btn btn-two">See Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="more-btn centred"><a href="{{ route('public.hostel') }}" class="theme-btn btn-one">View All Listing</a></div>
            </div>
        </section>
        <!-- feature-section end -->


        <!-- video-section -->
        <section class="video-section centred" style="background-image: url({{ asset('frontend/images/banner/cover.jpg') }});">
            <div class="auto-container">
                <div class="video-inner">
                    <div class="video-btn">
                        <a href="https://www.youtube.com/watch?v=BkhKjYohtyg" class="lightbox-image" data-caption=""><i class="icon-17"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- video-section end -->


        <!-- deals-section -->
        <section class="deals-section sec-pad">
            <div class="auto-container">
                <div class="sec-title">
                    <h5>Latest hostels</h5>
                    <h2>Available at max seat capacity</h2>
                </div>
                <div class="deals-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                    @foreach($hostels as $key => $hostel)
                    <div class="single-item">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 deals-block">
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="batch"><i class="icon-11"></i></div>
                                        <span class="category">{{ $hostel->categories->first()->name }}</span>
                                        <div class="lower-content">
                                            <div class="title-text"><h4><a href="property-details.html">{{ $hostel->name ?? '' }}</a></h4></div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left">
                                                    <h6>Start From</h6>
                                                    <h4>BDT {{ $hostel->hostelRooms->first()->min_price ?? '' }}</h4>
                                                </div>
                                                <ul class="other-option pull-right clearfix">
                                                    <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                                    <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                                </ul>
                                            </div>
                                            <p>{{ $hostel->address ?? '' }}</p>
                                            <ul class="more-details clearfix">
                                                <li><i class="icon-14"></i>Total {{ $hostel->total_seat ?? '' }} Seats</li>
                                                <li><i class="icon-14"></i>{{ $hostel->available_room_count ?? '' }} Seats avl.</li>
                                                <li><i class="icon-16"></i>{{ $hostel->garage_size ?? '' }} Garage</li>
                                            </ul>
                                            <div class="btn-box"><a href="property-details.html" class="theme-btn btn-one">See Details</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 deals-block">
                                <div class="image-box">
                                    <figure class="image"><img src="https://picsum.photos/id/1/570/410" alt=""></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- deals-section end -->


        <!-- testimonial-section end -->
        <section class="testimonial-section bg-color-1 centred" id="testimonial">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/images/shape/shape-1.png') }});"></div>
            <div class="auto-container">
                <div class="sec-title">
                    <h5>Testimonials</h5>
                    <h2>What the student's feeling about us</h2>
                </div>
                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <figure class="thumb-box"><img src="https://ui-avatars.com/api/?name=Emily" alt=""></figure>
                            <div class="text">
                                <p>"City Hostel made my student life so much easier! I found the perfect hostel with all the amenities I needed for my studies. The reservation process was smooth, and I felt secure knowing that the hostel was verified by the platform. Thank you, City Hostel, for helping me find my ideal accommodation."</p>
                            </div>
                            <div class="author-info">
                                <h4>Emily</h4>
                                <span class="designation">Computer Science Student</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <figure class="thumb-box"><img src="https://ui-avatars.com/api/?name=Alex+Urbasi" alt=""></figure>
                            <div class="text">
                                <p>"As an international student, finding a safe and comfortable place to stay in a new country was a top priority. City Hostel not only helped me discover a cozy hostel but also offered options that fit my budget. The reservation process was straightforward, and I can focus on my studies with peace of mind."</p>
                            </div>
                            <div class="author-info">
                                <h4>Alex Urbasi</h4>
                                <span class="designation">International Student</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <figure class="thumb-box"><img src="https://ui-avatars.com/api/?name=Mohona+Ahmed" alt=""></figure>
                            <div class="text">
                                <p>"I wanted a unique living experience during my studies, and City Hostel delivered just that. I found a themed hostel with creative decor that perfectly matches my interests. The platform's easy search and reservation system made the whole process stress-free."</p>
                            </div>
                            <div class="author-info">
                                <h4>Mohona Ahmed</h4>
                                <span class="designation">Art History Major</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <figure class="thumb-box"><img src="https://ui-avatars.com/api/?name=Mahadi+Jacky" alt=""></figure>
                            <div class="text">
                                <p>"City Hostel provided me with a wide range of hostel options, and I found one near my favorite sports facilities. Now, I can enjoy both my studies and my passion for sports without any compromise. This platform truly understands students' diverse needs."</p>
                            </div>
                            <div class="author-info">
                                <h4>Mahadi Jacky</h4>
                                <span class="designation">Sports Enthusiast</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <figure class="thumb-box"><img src="https://ui-avatars.com/api/?name=Roma+Hussen" alt=""></figure>
                            <div class="text">
                                <p>"I was pleasantly surprised to discover eco-friendly hostels on City Hostel. It aligns with my values, and I feel good about choosing a sustainable place to live. This platform not only simplifies accommodation search but also supports a greener lifestyle."</p>
                            </div>
                            <div class="author-info">
                                <h4>Roma Hussen </h4>
                                <span class="designation">Sustainability Advocate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-section end -->


        <!-- chooseus-section -->
        <section class="chooseus-section">
            <div class="auto-container">
                <div class="inner-container bg-color-2">
                    <div class="upper-box clearfix">
                        <div class="sec-title light">
                            <h5>Why Choose Us?</h5>
                            <h2>Reasons To Choose Us</h2>
                        </div>
                        <div class="btn-box">
                            <a href="categories.html" class="theme-btn btn-one">All Categories</a>
                        </div>
                    </div>
                    <div class="lower-box">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                                <div class="chooseus-block-one">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="icon-19"></i></div>
                                        <h4>Prime Location for Convenience</h4>
                                        <p>Experience city life at your doorstep with easy access to university and urban amenities. Spend less time commuting and more time studying and exploring.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                                <div class="chooseus-block-one">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="icon-26"></i></div>
                                        <h4>Affordable and Flexible Accommodation</h4>
                                        <p>Discover budget-friendly options with tailored packages, including shared and private rooms. We believe quality living should be affordable.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                                <div class="chooseus-block-one">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="icon-21"></i></div>
                                        <h4>Safety and Community</h4>
                                        <p>Your well-being is our priority with 24/7 security. Join our welcoming community, enjoy events, and make lifelong friends in a safe environment.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- chooseus-section end -->


        <!-- place-section -->
        <section class="place-section sec-pad">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h5>AREAS</h5>
                    <h2>We currently cover in Dhaka city only</h2>
                    <p>Soon we will expand our coverage throughout the country</p>
                </div>
                <div class="sortable-masonry">
                    <div class="items-container row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                            <div class="place-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/images/areas/uttara.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <h4><a href="categories.html">Uttara</a></h4>
                                        <p>10 Hostels</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all brand illustration print software logo">
                            <div class="place-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/images/areas/banani.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <h4><a href="categories.html">Banani</a></h4>
                                        <p>08 Hostels</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration marketing logo">
                            <div class="place-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/images/areas/old_dhaka.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <h4><a href="categories.html">Old Dhaka</a></h4>
                                        <p>29 Hostels</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12 masonry-item small-column all brand marketing print software">
                            <div class="place-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/images/areas/mirpur.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <h4><a href="categories.html">Mirpur</a></h4>
                                        <p>05 Hostels</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- place-section end -->

@endsection
