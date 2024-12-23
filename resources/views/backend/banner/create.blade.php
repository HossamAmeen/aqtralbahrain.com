@extends('backend.layouts.master')

@section('title', __('admin.e_shop_banner_create'))

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.add_banner') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.store')}}">
        {{ csrf_field() }}
       
   

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">{{ __('admin.photo') }} <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> {{ __('admin.choose') }}
                  </a>
              </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ old('photo') }}">
          </div>
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">{{ __('admin.status') }} <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">{{ __('admin.active') }}</option>
              <option value="inactive">{{ __('admin.inactive') }}</option>
          </select>
          @error('status')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
       
           <button class="btn btn-success" type="submit">{{ __('admin.submit') }}</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "{{ __('admin.write_description') }}",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
