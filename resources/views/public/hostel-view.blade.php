@extends('layouts.public')
@section('content')
        <!--Page Title-->
        <section class="page-title centred pb-210" style="background-image: url(/frontend/images/background/page-title-2.jpg);">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{ $hostel->name }}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('public.home') }}">Home</a></li>
                        <li>{{ $hostel->name }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- property-details -->
        <section class="property-details property-details-four">
            <div class="auto-container">
                <div class="top-details clearfix">
                    <div class="left-column pull-left clearfix">
                        <h3>{{ $hostel->name }}</h3>
                        <div class="author-info clearfix">
                            <div class="author-box pull-left">
                                <figure class="author-thumb"><img src="/frontend/images/feature/author-1.jpg" alt=""></figure>
                                <h6>{{ $hostel->created_by->name }}</h6>
                            </div>
                            <ul class="rating clearfix pull-left">
                                <li><i class="icon-39"></i></li>
                                <li><i class="icon-39"></i></li>
                                <li><i class="icon-39"></i></li>
                                <li><i class="icon-39"></i></li>
                                <li><i class="icon-40"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="right-column pull-right clearfix">
                        <div class="price-inner clearfix">
                            <ul class="category clearfix pull-left">
                                @foreach($hostel->categories as $key => $category)
                                <li><a href="">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            <div class="price-box pull-right">
                                <h6>Starting from</h6>
                                <h3>BDT {{ $minPrice }}</h3>
                            </div>
                        </div>
                        <ul class="other-option pull-right clearfix">
                            <li><a href="property-details.html"><i class="icon-37"></i></a></li>
                            <li><a href="property-details.html"><i class="icon-38"></i></a></li>
                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-details-content">
                            <div class="details-box content-widget">
                                <div class="title-box">
                                    <h4>Property Details</h4>
                                </div>
                                <ul class="list clearfix">
                                    <li>Property ID: <span>ZOP251C</span></li>
                                    <li>Rooms: <span>06</span></li>
                                    <li>Garage Size: <span>200 Sq Ft</span></li>
                                    <li>Property Price: <span>$30,000</span></li>
                                    <li>Bedrooms: <span>04</span></li>
                                    <li>Year Built: <span>01 April, 2019</span></li>
                                    <li>Property Type: <span>Apertment</span></li>
                                    <li>Bathrooms: <span>03</span></li>
                                    <li>Property Status: <span>For Sale</span></li>
                                    <li>Property Size: <span>2024 Sq Ft</span></li>
                                    <li>Garage: <span>01</span></li>
                                </ul>
                            </div>
                            <div class="amenities-box content-widget">
                                <div class="title-box">
                                    <h4>Amenities</h4>
                                </div>
                                <div class="list clearfix">
                                    {!! $hostel->amenities !!}
                                </div>
                            </div>
                            <div class="floorplan-inner content-widget">
                                <div class="title-box">
                                    <h4>Floor Plan</h4>
                                </div>
                                <ul class="accordion-box">
                                    <li class="accordion block active-block">
                                        <div class="acc-btn active">
                                            <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                            <h5>First Floor</h5>
                                        </div>
                                        <div class="acc-content current">
                                            <div class="content-box">
                                                <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim  est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusa dolore mque laudant.</p>
                                                <figure class="image-box">
                                                    <img src="/frontend/images/resource/floor-1.png" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block">
                                        <div class="acc-btn">
                                            <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                            <h5>Second Floor</h5>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content-box">
                                                <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim  est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusa dolore mque laudant.</p>
                                                <figure class="image-box">
                                                    <img src="/frontend/images/resource/floor-1.png" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block">
                                         <div class="acc-btn">
                                            <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                            <h5>Third Floor</h5>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content-box">
                                                <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim  est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusa dolore mque laudant.</p>
                                                <figure class="image-box">
                                                    <img src="/frontend/images/resource/floor-1.png" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="property-sidebar default-sidebar">
                            <div class="author-widget sidebar-widget">
                                <div class="author-box">
                                    <figure class="author-thumb"><img src="/frontend/images/resource/author-1.jpg" alt=""></figure>
                                    <div class="inner">
                                        <h4>{{ $hostel->created_by->name }}</h4>
                                        <ul class="info clearfix">
                                            <li><i class="fas fa-map-marker-alt"></i>{{ $hostel->address }}</li>
                                            <li><i class="fas fa-phone"></i><a href="tel:{{ $hostel->phone }}">{{ $hostel->phone }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-inner">
                                    <form action="" method="post" class="default-form">
                                        <div class="form-group">
                                            <input type="hidden" name="name" placeholder="Your name" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="email" placeholder="Your Email" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="phone" placeholder="Phone" required="">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Ask your question"></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-details end -->

@endsection