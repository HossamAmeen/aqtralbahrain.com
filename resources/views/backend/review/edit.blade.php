@extends('backend.layouts.master')

@section('title', __('admin.review_edit'))

@section('main-content')
<div class="card">
  <h5 class="card-header">{{ __('admin.review_edit') }}</h5>
  <div class="card-body">
    <form action="{{ route('review.update', $review->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">{{ __('admin.review_by') }}:</label>
        <input type="text" disabled class="form-control" value="{{ $review->user_info->name }}">
      </div>
      <div class="form-group">
        <label for="review">{{ __('admin.review') }}</label>
        <textarea name="review" id="" cols="20" rows="10" class="form-control">{{ $review->review }}</textarea>
      </div>
      <div class="form-group">
        <label for="status">{{ __('admin.status') }}:</label>
        <select name="status" id="" class="form-control">
          <option value="">{{ __('admin.select_status') }}</option>
          <option value="active" {{ (($review->status == 'active') ? 'selected' : '') }}>{{ __('admin.active') }}</option>
          <option value="inactive" {{ (($review->status == 'inactive') ? 'selected' : '') }}>{{ __('admin.inactive') }}</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
    </form>
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