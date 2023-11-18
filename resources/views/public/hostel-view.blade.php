@extends('layouts.public')
@section('content')
        <!--Page Title-->
        
        <section class="page-title centred pb-210" style="background-image: url({{ $hostel->featured_image?->getUrl()?? '/frontend/images/background/page-title-2.jpg' }});">
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
                            <li><a href="javascript:void"><i class="icon-37"></i></a></li>
                            <li><a href="javascript:void"><i class="icon-38"></i></a></li>
                            <li><a href="javascript:void"><i class="icon-12"></i></a></li>
                            <li><a href="javascript:void"><i class="icon-13"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-details-content">
                            <div class="details-box content-widget">
                                <div class="title-box">
                                    <h4>Hostel Details</h4>
                                </div>
                                <ul class="list clearfix">
                                    <li>Hostel Name: <span>{{ $hostel->name }}</span></li>
                                    <li>Total Seats: <span>{{ $hostel->total_seat }}</span></li>
                                    <li>Available Seats: <span>{{ $hostel->available_room_count }}</span></li>
                                    <li>Garage: <span class="text-capitalize"> {{ $hostel->garage }} | {{ $hostel->garage_size ?? '0' }} (Sq. Ft)</span></li>
                                    <li>Year Built: <span>{{ $hostel->built_on }}</span></li>
                                    <li>Hostel Type: <span>{{ $hostel->categories->first()->name }}</span></li>
                                    <li>Floor: <span>3rd</span></li>
                                    <li>Address: <span>{{ $hostel->address }}, {{ $hostel->area->name }}</span></li>
                                </ul>
                            </div>
                            <div class="floorplan-inner content-widget">
                                <div class="title-box">
                                    <h4>Available Seats ({{ $hostel->available_room_count }})</h4>
                                    @guest
                                        <h6>Please <a href="{{ route('login') }}"> login </a> to make a reservation</h6>
                                    @endguest
                                </div>
                                <ul class="accordion-box">
                                    @foreach($availableRooms->values() as $key => $room)
                                    <li key="{{$key}}" class="accordion block {{ $key == 0 ? 'active-block' : ''}}">
                                        <div class="acc-btn  {{ $key == 0 ? 'active' : ''}}">
                                            <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                            <h5>{{ $room->room_info }}</h5>
                                        </div>
                                        <div class="acc-content {{ $key == 0 ? 'current' : ''}}">
                                            <div class="content-box">
                                                <ul class="list clearfix">
                                                    <li>Price   : BDT {{ $room->price }} (per month)</li>
                                                    <li>Placement: {{ $room->placement }}</li>
                                                    <li>Status   : {{ $room->status }}</li>
                                                    <li>Capacity : {{ $room->capacity }} Persons</li>
                                                </ul>
                                                <figure class="image-box">
                                                    @foreach($room->images as $key => $media)
                                                        <img src="{{ $media->getUrl('preview') }}">
                                                    @endforeach
                                                </figure>
                                            </div>
                                            @auth
                                            <div class="mt-2">
                                                <form method="POST" action="{{ route("frontend.reservations.store") }}" enctype="multipart/form-data">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                    <input type="hidden" name="paid_amount" value="{{ $room->price }}">
                                                    <input type="hidden" name="status" value="unpaid">
                                                    <div class="form-group">
                                                        <button  type="submit" class="btn btn-success">Make reservation</button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endauth
                                        </div>
                                    </li>
                                    @endforeach
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
                                @guest
                                    <p>Please <a href="{{ route('login') }}"> login </a> to send messages to the host directly from here.</p>
                                @endguest
                                @auth
                                <div class="form-inner">
                                    <p>Hi, {{Auth::user()->name }}. You can message to the host directly from here.</p>
                                    <form action="{{ route("frontend.messenger.storeTopic") }}" method="post" class="default-form">
                                        @csrf
                                        {{-- <div class="form-group">
                                            <input type="hidden" name="name" placeholder="Your name">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="email" placeholder="Your Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="phone" placeholder="Phone">
                                        </div> --}}
                                        <div class="form-group">
                                            <input type="hidden" name="recipient" value="{{ $hostel->created_by->id }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="subject" value="Query for {{ $hostel->name }}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="content" placeholder="Ask your question"></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                                @endauth
                            </div>

                            <div class="sidebar-widget">
                                <div class="card border-0">
                                    <div class="card-title mb-2">
                                        <h5>Available Facilities</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                        @foreach($hostel->facilities as $key => $facility)
                                            <li class="list-group-item">{{$facility->name}}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-details end -->

@endsection