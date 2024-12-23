@extends('user.layouts.master')

@section('title', __('user.comment_edit'))

@section('main-content')
<div class="card">
  <h5 class="card-header">{{ __('user.comment_edit') }}</h5>
  <div class="card-body">
    <form action="{{ route('user.post-comment.update', $comment->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">{{ __('user.by') }}:</label>
        <input type="text" disabled class="form-control" value="{{ $comment->user_info->name }}">
      </div>
      <div class="form-group">
        <label for="comment">{{ __('user.comment') }}</label>
        <textarea name="comment" id="" cols="20" rows="10" class="form-control">{{ $comment->comment }}</textarea>
      </div>
      <div class="form-group">
        <label for="status">{{ __('user.status') }} :</label>
        <select name="status" id="" class="form-control">
          <option value="">{{ __('user.select_status') }}</option>
          <option value="active" {{ (($comment->status == 'active') ? 'selected' : '') }}>{{ __('user.active') }}</option>
          <option value="inactive" {{ (($comment->status == 'inactive') ? 'selected' : '') }}>{{ __('user.inactive') }}</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">{{ __('user.update') }}</button>
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