@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.edit_shipping') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('shipping.update',$shipping->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">{{ __('admin.type') }} <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="type" placeholder="{{ __('admin.enter_type') }}" value="{{$shipping->type}}" class="form-control">
        @error('type')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>     
        
        <div class="form-group">
          <label for="price" class="col-form-label">{{ __('admin.price') }} <span class="text-danger">*</span></label>
        <input id="price" type="number" name="price" placeholder="{{ __('admin.enter_price') }}" value="{{$shipping->price}}" class="form-control">
        @error('price')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>        
        
        <div class="form-group">
          <label for="status" class="col-form-label">{{ __('admin.status') }} <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($shipping->status=='active') ? 'selected' : '')}}>{{ __('admin.active') }}</option>
            <option value="inactive" {{(($shipping->status=='inactive') ? 'selected' : '')}}>{{ __('admin.inactive') }}</option>
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "{{ __('admin.write_short_description') }}",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush