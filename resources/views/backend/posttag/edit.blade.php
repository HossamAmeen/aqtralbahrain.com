@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.edit_post_tag') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('post-tag.update',$postTag->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">{{ __('admin.title') }}</label>
          <input id="inputTitle" type="text" name="title" placeholder="{{ __('admin.enter_title') }}"  value="{{$postTag->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">{{ __('admin.status') }}</label>
          <select name="status" class="form-control">
            <option value="active" {{(($postTag->status=='active') ? 'selected' : '')}}>{{ __('admin.active') }}</option>
            <option value="inactive" {{(($postTag->status=='inactive') ? 'selected' : '')}}>{{ __('admin.inactive') }}</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">{{ __('admin.update') }}</button>
        </div>
      </form>
    </div>
</div>

@endsection