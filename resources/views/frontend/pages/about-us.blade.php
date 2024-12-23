@extends('frontend.layouts.master')

@section('title','Aqtr Albahrain || About Us')

@section('main-content')



	<!-- About Us -->
	<section class="about-us section" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							@php
								$settings=DB::table('settings')->get();
							@endphp
							<h3>{{__('application.welcome_to')}} <span>{{__('application.attara_shop')}}</span></h3>
							<p>@foreach($settings as $data) {!!$data->description!!} @endforeach</p>
							<div class="button">
								<a href="{{route('blog')}}" class="btn">{{__('application.our_blog')}}</a>
								<a href="{{route('contact')}}" class="btn primary">{{__('application.contact_us')}}</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-img overlay">
							{{-- <div class="button">
								<a href="https://www.youtube.com/watch?v=nh2aYrGMrIE" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
							</div> --}}
							<img src="@foreach($settings as $data) {{$data->photo}} @endforeach" alt="@foreach($settings as $data) {{$data->photo}} @endforeach">
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->

	<!-- End Shop Services Area -->

	@include('frontend.layouts.newsletter')
@endsection
