@extends('backend.layouts.master')

@section('title', __('admin.comment_edit'))

@section('main-content')
<div class="card">
  <h5 class="card-header">{{ __('admin.comment_edit') }}</h5>
  <div class="card-body">
    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">{{ __('admin.by') }}:</label>
        <input required type="text" disabled class="form-control" value="{{ $comment->user_info->name }}">
      </div>
      <div class="form-group">
        <label for="comment">{{ __('admin.comment') }}</label>
        <textarea required name="comment" id="" cols="20" rows="10" class="form-control">{{ $comment->comment }}</textarea>
      </div>
      <div class="form-group">
        <label for="status">{{ __('admin.status') }}:</label>
        <select required name="status" id="" class="form-control">
          <option value="">{{ __('admin.select_status') }}</option>
          <option value="active" {{ ($comment->status == 'active') ? 'selected' : '' }}>{{ __('admin.active') }}</option>
          <option value="inactive" {{ ($comment->status == 'inactive') ? 'selected' : '' }}>{{ __('admin.inactive') }}</option>
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