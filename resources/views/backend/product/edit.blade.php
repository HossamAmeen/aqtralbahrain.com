@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.edit_product') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">{{ __('admin.title') }} <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="{{ __('admin.enter_title') }}"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">{{ __('admin.summary') }} <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">{{ __('admin.description') }}</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="is_featured">{{ __('admin.is_featured') }}</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> {{ __('admin.yes') }}                        
        </div>

        <div class="form-group">
          <label for="cat_id">{{ __('admin.category') }} <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">{{ __('admin.select_category') }}</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        @php 
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
        @endphp

        <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">{{ __('admin.sub_category') }}</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">{{ __('admin.select_sub_category') }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">{{ __('admin.price') }} (NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="{{ __('admin.enter_price') }}"  value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">{{ __('admin.discount') }} (%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="{{ __('admin.enter_discount') }}"  value="{{$product->discount}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="size">{{ __('admin.size') }}</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">{{ __('admin.select_size') }}</option>
              @foreach($items as $item)              
                @php 
                $data=explode(',',$item->size);
                @endphp
              <option value="S"  @if( in_array( "S",$data ) ) selected @endif>{{ __('admin.small') }}</option>
              <option value="M"  @if( in_array( "M",$data ) ) selected @endif>{{ __('admin.medium') }}</option>
              <option value="L"  @if( in_array( "L",$data ) ) selected @endif>{{ __('admin.large') }}</option>
              <option value="XL"  @if( in_array( "XL",$data ) ) selected @endif>{{ __('admin.extra_large') }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="brand_id">{{ __('admin.brand') }}</label>
          <select name="brand_id" class="form-control">
              <option value="">{{ __('admin.select_brand') }}</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">{{ __('admin.condition') }}</label>
          <select name="condition" class="form-control">
              <option value="">{{ __('admin.select_condition') }}</option>
              <option value="default" {{(($product->condition=='default')? 'selected':'')}}>{{ __('admin.default') }}</option>
              <option value="new" {{(($product->condition=='new')? 'selected':'')}}>{{ __('admin.new') }}</option>
              <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>{{ __('admin.hot') }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">{{ __('admin.quantity') }} <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="{{ __('admin.enter_quantity') }}"  value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">{{ __('admin.photo') }} <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> {{ __('admin.choose') }}
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">{{ __('admin.status') }} <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>{{ __('admin.active') }}</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>{{ __('admin.inactive') }}</option>
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
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail Description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>

<script>
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Select any one--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
</script>
@endpush