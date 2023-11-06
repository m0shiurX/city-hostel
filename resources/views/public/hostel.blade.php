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
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Hostels</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->
	<!-- property-page-section -->
	<section class="property-page-section property-grid">
		<div class="auto-container">
			<div class="row clearfix">
				<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
					<div class="default-sidebar property-sidebar">
						<div class="filter-widget sidebar-widget">
							<div class="widget-title">
								<h5>Property</h5>
							</div>
							<div class="widget-content">
								<div class="select-box">
									<select class="wide">
										<option data-display="All Category">All Category</option>
										@foreach($categories as $key => $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="select-box">
									<select class="wide">
										<option data-display="Any Area">Any Area</option>
										@foreach($areas as $key => $area)
										<option value="{{ $area->id }}">{{ $area->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="select-box">
									<select class="wide">
										<option data-display="Seats Available">Max Seats</option>
										<option value="1">2+ seats</option>
										<option value="2">3+ seats</option>
										<option value="3">4+ seats</option>
										<option value="4">5+ seats</option>
									</select>
								</div>
								<div class="select-box">
									<select class="wide">
										<option data-display="Any Floor">Select Floor</option>
										<option value="1">2x Floor</option>
										<option value="2">3x Floor</option>
										<option value="3">4x Floor</option>
									</select>
								</div>
								<div class="filter-btn">
									<button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
								</div>
							</div>
						</div>
						<div class="price-filter sidebar-widget">
							<div class="widget-title">
								<h5>Price Range (per month)</h5>
							</div>
							<div class="range-slider clearfix">
								<div class="clearfix">
									<div class="input">
										<input type="text" class="property-amount" name="field-name" readonly="">
									</div>
								</div>
								<div class="price-range-slider"></div>
							</div>
						</div>
						<div class="category-widget sidebar-widget">
							<div class="widget-title">
								<h5>Areas in Dhaka</h5>
							</div>
							<ul class="category-list clearfix">
								@foreach($areas as $key => $area)
								<li><a href="javascript:void">{{ $area->name }} <span>({{ $area->hostel_count }})</span></a></li>
								@endforeach
							</ul>
						</div>
						<div class="category-widget sidebar-widget">
							<div class="widget-title">
								<h5>Categories List</h5>
							</div>
							<ul class="category-list clearfix">
								@foreach($categories as $key => $category)
								<li><a href="javascript:void">{{ $category->name }} <span>({{ $category->hostel_count }})</span></a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-12 col-sm-12 content-side">
					<div class="property-content-side">
						<div class="item-shorting clearfix">
							<div class="left-column pull-left">
								@if ($hostels->total() > 0)
								<h5>Search Reasults: <span>Showing {{  ($hostels->perPage() * $hostels->currentPage()) - ($hostels->perPage() -1) }} - {{ $hostels->currentPage() * $hostels->perPage() > $hostels->total() ? $hostels->total() : $hostels->currentPage() * $hostels->perPage()   }} of {{ $hostels->total() }} Listings</span></h5>
								@endif
							</div>
							<div class="right-column pull-right clearfix">
								<div class="short-box clearfix">
									<div class="select-box">
										<select class="wide">
											<option value="">Newest</option>
											<option value="1">New Arrival</option>
											<option value="2">Top Rated</option>
											<option value="3">Offer Place</option>
											<option value="4">Most Place</option>
										</select>
									</div>
								</div>
								<div class="short-menu clearfix">
									<button class="list-view"><i class="icon-35"></i></button>
									<button class="grid-view on"><i class="icon-36"></i></button>
								</div>
							</div>
						</div>
						<div class="wrapper grid">
							<div class="deals-grid-content grid-item">
								<div class="row clearfix">
									@foreach($hostels as $key => $hostel)
									<div class="col-lg-6 col-md-6 col-sm-12 feature-block">
										<div class="feature-block-one">
											<div class="inner-box">
												<div class="image-box">
													<figure class="image">
														<img src="{{ $hostel->featured_image?->getUrl()?? '/frontend/images/background/page-title-2.jpg' }}">
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
													<div class="title-text"><h4><a href="{{ route('public.hostel.show', $hostel->id)}}">{{ $hostel->name ?? '' }}</a></h4></div>
													<div class="price-box clearfix">
														<div class="price-info pull-left">
															<h6>Starts from</h6>
															<h4>BDT  {{ $hostel->hostelRooms->first()->min_price ?? '' }} <span class="font-xs">/month</span></h4>
														</div>
														<ul class="other-option pull-right clearfix">
															<li><a href="{{ route('public.hostel.show', $hostel->id)}}"><i class="icon-12"></i></a></li>
															<li><a href="{{ route('public.hostel.show', $hostel->id)}}"><i class="icon-13"></i></a></li>
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
							</div>
						</div>
    					{{ $hostels->links() }}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- property-page-section end -->
@endsection