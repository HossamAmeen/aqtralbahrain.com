@extends('backend.layouts.master')

@section('title', __('admin.order_detail'))

@section('main-content')
<div class="card">
  <h5 class="card-header">{{ __('admin.order_edit') }}</h5>
  <div class="card-body">
    <form action="{{ route('order.update', $order->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">{{ __('admin.status') }} :</label>
        <select name="status" id="" class="form-control">
          <option value="new" 
            {{ ($order->status == 'delivered' || $order->status == 'process' || $order->status == 'cancel') ? 'disabled' : '' }}  
            {{ (($order->status == 'new') ? 'selected' : '') }}>
            {{ __('admin.status_new') }}
          </option>
          <option value="process" 
            {{ ($order->status == 'delivered' || $order->status == 'cancel') ? 'disabled' : '' }}  
            {{ (($order->status == 'process') ? 'selected' : '') }}>
            {{ __('admin.status_process') }}
          </option>
          <option value="delivered" 
            {{ ($order->status == 'cancel') ? 'disabled' : '' }}  
            {{ (($order->status == 'delivered') ? 'selected' : '') }}>
            {{ __('admin.status_delivered') }}
          </option>
          <option value="cancel" 
            {{ ($order->status == 'delivered') ? 'disabled' : '' }}  
            {{ (($order->status == 'cancel') ? 'selected' : '') }}>
            {{ __('admin.status_cancelled') }}
          </option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
    </form>
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