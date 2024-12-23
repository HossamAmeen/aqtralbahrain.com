@extends('frontend.layouts.master')

@section('title','Aqtr Albahrain || Order Track Page')

@section('main-content')

<section class="tracking_box_area section_gap py-5">
    <div class="container">
        <div class="tracking_box_inner">
            <p>{{__('application.track_your_order')}}</p>
            <form class="row tracking_form my-4" action="{{route('product.track.order')}}" method="post" novalidate="novalidate">
              @csrf
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control p-2"  name="order_number" placeholder="{{__('application.enter_your_phone_number')}}">
                </div>
                <div class="col-md-8 form-group">
                    <button type="submit" value="submit" class="btn submit_btn">{{__('application.track_order')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection