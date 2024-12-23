@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.add_product') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">{{ __('admin.title') }} <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="{{ __('admin.enter_title') }}"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">{{ __('admin.summary') }} <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">{{ __('admin.description') }}</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="is_featured">{{ __('admin.is_featured') }}</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> {{ __('admin.yes') }}                        
        </div>

        <div class="form-group">
          <label for="cat_id">{{ __('admin.category') }} <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">{{ __('admin.select_category') }}</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">{{ __('admin.sub_category') }}</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">{{ __('admin.select_category') }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">{{ __('admin.price') }} (NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="{{ __('admin.enter_price') }}"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">{{ __('admin.discount') }} (%)</label>
          <input id="discount" type="number" value="0" name="discount" min="0" max="100" placeholder="{{ __('admin.enter_discount') }}"  value="{{old('discount')}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="size">{{ __('admin.size') }}</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">{{ __('admin.select_size') }}</option>
              <option value="S">{{ __('admin.small') }} (S)</option>
              <option value="M">{{ __('admin.medium') }} (M)</option>
              <option value="L">{{ __('admin.large') }} (L)</option>
              <option value="XL">{{ __('admin.extra_large') }} (XL)</option>
          </select>
        </div>

        <div class="form-group">
          <label for="brand_id">{{ __('admin.brand') }}</label>
          <select name="brand_id" class="form-control">
              <option value="">{{ __('admin.select_brand') }}</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">{{ __('admin.condition') }}</label>
          <select name="condition" class="form-control">
              <option value="">{{ __('admin.select_condition') }}</option>
              <option value="default">{{ __('admin.default') }}</option>
              <option value="new">{{ __('admin.new') }}</option>
              <option value="hot">{{ __('admin.hot') }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">{{ __('admin.quantity') }} <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="{{ __('admin.enter_quantity') }}"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">{{ __('admin.photo') }} <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> {{ __('admin.choose') }}
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">{{ __('admin.status') }} <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">{{ __('admin.active') }}</option>
              <option value="inactive">{{ __('admin.inactive') }}</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
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
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "{{ __('admin.write_short_description') }}",
        tabsize: 2,
        height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "{{ __('admin.write_detail_description') }}",
        tabsize: 2,
        height: 150
      });
    });

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    if(cat_id !=null){
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          var html_option="<option value=''>----{{ __('admin.select_sub_category') }}----</option>"
          if(response.status){
            var data=response.data;
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
          } else {
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
  })
</script>

@endpush
