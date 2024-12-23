@extends('backend.layouts.master')
@section('title', __('admin.brand_create_title'))
@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.add_brand') }}</h5>
    <div class="card-body">
        <form method="post" action="{{ route('brand.store') }}">
            @csrf
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">{{ __('admin.title') }} <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="{{ __('admin.enter_title') }}" value="{{ old('title') }}" class="form-control">
                @error('title')
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
                <button type="reset" class="btn btn-warning">{{ __('admin.reset') }}</button>
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
            placeholder: "{{ __('admin.write_short_description') }}",
            tabsize: 2,
            height: 150
        });
    });
</script>
@endpush