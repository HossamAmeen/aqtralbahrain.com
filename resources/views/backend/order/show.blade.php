@extends('backend.layouts.master')

@section('title', __('admin.order_detail'))

@section('main-content')
<div class="card">
    <h5 class="card-header">
        {{ __('admin.order') }}
    </h5>
    <div class="card-body">
        @if($order)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('admin.sn') }}</th>
                    <th>{{ __('admin.order_no') }}</th>
                    <th>{{ __('admin.name') }}</th>
                    <th>{{ __('admin.email') }}</th>
                    <th>{{ __('admin.quantity') }}</th>
                    <th>{{ __('admin.charge') }}</th>
                    <th>{{ __('admin.total_amount') }}</th>
                    <th>{{ __('admin.status') }}</th>
                    <th>{{ __('admin.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->shipping->price ?? '' }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        @if($order->status == 'new')
                            <span class="badge badge-primary">{{ __('admin.status_new') }}</span>
                        @elseif($order->status == 'process')
                            <span class="badge badge-warning">{{ __('admin.status_process') }}</span>
                        @elseif($order->status == 'delivered')
                            <span class="badge badge-success">{{ __('admin.status_delivered') }}</span>
                        @else
                            <span class="badge badge-danger">{{ __('admin.status_cancelled') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" title="{{ __('admin.edit') }}" data-placement="bottom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('order.destroy', [$order->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm dltBtn" data-id="{{ $order->id }}" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.delete') }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
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
                            <h4 class="text-center pb-4">{{ __('admin.order_information') }}</h4>
                            <table class="table">
                                <tr>
                                    <td>{{ __('admin.order_number') }}</td>
                                    <td>: {{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.order_date') }}</td>
                                    <td>: {{ $order->created_at->format('D d M, Y') }} at {{ $order->created_at->format('g : i a') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.quantity') }}</td>
                                    <td>: {{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.order_status') }}</td>
                                    <td>: {{ __('admin.status_' . $order->status) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.shipping_charge') }}</td>
                                    <td>: ${{ $order->shipping->price ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.coupon') }}</td>
                                    <td>: ${{ number_format($order->coupon, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.total_amount') }}</td>
                                    <td>: ${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.payment_method') }}</td>
                                    <td>: @if($order->payment_method == 'cod') {{ __('admin.cash_on_delivery') }} @else {{ __('admin.paypal') }} @endif</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.payment_status') }}</td>
                                    <td>: {{ $order->payment_status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6 col-lx-4">
                        <div class="shipping-info">
                            <h4 class="text-center pb-4">{{ __('admin.shipping_information') }}</h4>
                            <table class="table">
                                <tr>
                                    <td>{{ __('admin.full_name') }}</td>
                                    <td>: {{ $order->first_name }} {{ $order->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.email') }}</td>
                                    <td>: {{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.phone_no') }}</td>
                                    <td>: {{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.address') }}</td>
                                    <td>: {{ $order->address1 }}, {{ $order->address2 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.country') }}</td>
                                    <td>: {{ $order->country }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('admin.post_code') }}</td>
                                    <td>: {{ $order->post_code }}</td>
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
    .order-info, .shipping-info {
        background: #ECECEC;
        padding: 20px;
    }
    .order-info h4, .shipping-info h4 {
        text-decoration: underline;
    }
</style>
@endpush
