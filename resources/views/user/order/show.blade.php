@extends('user.layouts.master')

@section('title', __('user.order_detail'))

@section('main-content')
<div class="card" style="direction: rtl;text-align:center">
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>{{ __('user.sn') }}</th>
            <th>{{ __('user.order_no') }}</th>
            <th>{{ __('user.name') }}</th>
            <th>{{ __('user.email') }}</th>
            <th>{{ __('user.quantity') }}</th>
            <th>{{ __('user.charge') }}</th>
            <th>{{ __('user.total_amount') }}</th>
            <th>{{ __('user.status') }}</th>
            <th>{{ __('user.action') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>${{$order->shipping->price??''}}</td>
            <td>${{number_format($order->total_amount,2)}}</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">{{ __('user.new') }}</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">{{ __('user.process') }}</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">{{ __('user.delivered') }}</span>
                @else
                  <span class="badge badge-danger">{{ __('user.other') }}</span>
                @endif
            </td>
            <td>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('user.delete') }}"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">{{ __('user.order_information') }}</h4>
              <table class="table">
                    <tr class="">
                        <td>{{ __('user.order_number') }}</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.order_date') }}</td>
                        <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                    </tr>
                    <tr>
                        <td>{{ __('user.quantity') }}</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.order_status') }}</td>
                        <td> : {{$order->status}}</td>
                    </tr>
                    <tr>
                      @php
                          $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                      @endphp
                        <td>{{ __('user.shipping_charge') }}</td>
                        <td> :${{$order->shipping->price??''}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.total_amount') }}</td>
                        <td> : $ {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                      <td>{{ __('user.payment_method') }}</td>
                      <td> : @if($order->payment_method=='cod') {{ __('user.cod') }} @else {{ __('user.paypal') }} @endif</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.payment_status') }}</td>
                        <td> : {{$order->payment_status}}</td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">{{ __('user.shipping_information') }}</h4>
              <table class="table">
                    <tr class="">
                        <td>{{ __('user.full_name') }}</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.email') }}</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.phone') }}</td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.address') }}</td>
                        <td> : {{$order->address1}}, {{$order->address2}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.country') }}</td>
                        <td> : {{$order->country}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('user.post_code') }}</td>
                        <td> : {{$order->post_code}}</td>
                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
@endpush